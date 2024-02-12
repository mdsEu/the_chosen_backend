<?php

namespace Wpe_Content_Engine\Helper\Search;

use ErrorException;
use \Exception as Exception;
use WP_Query;
use Wpe_Content_Engine\Helper\Logging\Debug_Logger;
use Wpe_Content_Engine\Helper\Client_Interface;
use Wpe_Content_Engine\Settings_Interface;
use Wpe_Content_Engine\WPSettings;
use Wpe_Content_Engine\Helper\Logging\Server_Log_Info;

/**
 * @package    Wpe_Content_Engine
 * @subpackage Wpe_Content_Engine/public
 */
class Search {

	const NEW_NAMING_MAPPING = array(
		'title'              => 'post_title',
		'content'            => 'post_content',
		'excerpt'            => 'post_excerpt',
		'author.displayName' => 'post_author.display_name',
	);

	/**
	 * The client of this plugin.
	 *
	 * @access   private
	 * @var      Client_Interface $client
	 */
	private Client_Interface $client;

	/**
	 * The various settings needed for search.
	 *
	 * @access   private
	 * @var      Settings_Interface $settings
	 */
	private Settings_Interface $settings;

	/**
	 * The search configuration set by the client.
	 *
	 * @var Search_Config $search_config
	 */
	private Search_Config $search_config;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param Client_Interface   $client Client Interface.
	 * @param Settings_Interface $settings Settings Interface.
	 * @param Search_Config      $search_config Search Config.
	 * @since 2.18.0
	 */
	public function __construct(
		Client_Interface $client,
		Settings_Interface $settings,
		Search_Config $search_config
	) {
		$this->client        = $client;
		$this->settings      = $settings;
		$this->search_config = $search_config;
	}

	/**
	 * @param string      $search_query Search Query.
	 * @param array       $order_by Search order definition.
	 * @param int         $limit Page limit.
	 * @param int         $offset Page offset.
	 * @param array|null  $search_fields Fields to scope the search in on.
	 * @param bool        $fuzzy for fuzzy search toggle.
	 * @param int         $fuzzy_distance for fuzzy typos allowable per word.
	 * @param string|null $filter for adding additional filters to query.
	 * @return array[]
	 * @throws ErrorException Throws exception.
	 */
	public function search_content_engine( string $search_query, array $order_by, int $limit = 10, int $offset = 0, array $search_fields = null, bool $fuzzy = true, int $fuzzy_distance = 1, ?string $filter = null ) {
		$graphql_query = <<<'GRAPHQL'
			query Search(
			$query: String!
			$filter: String
			$orderBy: [OrderBy!]
			$offset: Int
			$limit: Int
			$fields: [SearchField!]
			$tolerance: SearchOption
				) {
				find(
					query: $query
					filter: $filter
					orderBy: $orderBy
					offset: $offset
					limit: $limit
					fields: $fields
					tolerance: $tolerance
				) {
					total
					documents {
						id
					}
				}
			}
		GRAPHQL;

		$tolerance = $fuzzy ?
			array(
				'name'          => 'fuzzy',
				'fuzzyDistance' => $fuzzy_distance,
			) : array( 'name' => 'stemming' );

		$graphql_vars = array(
			'query'     => $search_query,
			'orderBy'   => $order_by,
			'offset'    => $offset,
			'limit'     => $limit,
			'fields'    => $search_fields,
			'tolerance' => $tolerance,
		);

		if ( ! empty( $filter ) ) {
			$graphql_vars['filter'] = $filter;
		}

		$wpe_content_engine_options = $this->settings->get( WPSettings::WPE_CONTENT_ENGINE_OPTION_NAME ); // Array of All Options.

		$response = $this->client->query(
			str_replace( 'sync', 'sites', $wpe_content_engine_options['url'] ),
			$graphql_query,
			$graphql_vars,
			null,
			( new Server_Log_Info() )->get_data()
		);
		return array( 'result' => $response['data']['find'] ?? array() );
	}

	private function is_graphql_request(): bool {
		return isset( $_REQUEST['graphql'] );
	}

	public function is_html_search( $post_types ): bool {
		return empty( $post_types ) && ! $this->is_graphql_request();
	}

	private function is_admin_search_request(): bool {
		return ( is_admin() && ! $this->is_graphql_request() );
	}

	private function add_debug_message( string $message ) {
		if ( function_exists( 'graphql_debug' ) ) {
			graphql_debug(
				$message,
				array(
					'version' => ATLAS_SEARCH_VERSION,
					'type'    => 'ATLAS_SEARCH_DEBUG',
				),
			);
		}

		// Query monitor log for HTML search.
		do_action( 'qm/info', $message );
	}

	/**
	 * Extracts post types from passed in $query_vars['post_type']
	 *
	 * @param string|array $post_type The post type(s) to extract.
	 * @return array An array of post types.
	 */
	public function extract_post_types( $post_type ) {
		return array_values( ! is_array( $post_type ) ? array( $post_type ) : $post_type );
	}

		/**
		 * Get posts from Content Engine using the search method
		 *
		 * @param array|null $posts Array of posts.
		 * @param WP_Query   $query WP_Query instance.
		 * @return array|null
		 * @since 2.18.0
		 */
	public function get_ce_posts( ?array $posts, WP_Query $query ) {
		// This overrides the post list behavior on WP Admin
		// This is not directly tied to search
		// this affects WP_Query.

		// Check if we should turn off Atlas Search.
		if (
		! $query->is_search ||
		$this->is_admin_search_request()
		) {
			$query->content_engine_search_success = false;
			return $posts;
		}

		$query_vars = $query->query;
		if ( empty( $query_vars['post_type'] ) || 'any' === $query_vars['post_type'] ) {
			$query_vars['post_type'] = array();
		}

		$post_types    = $this->extract_post_types( $query_vars['post_type'] );
		$config        = $this->search_config->get_config( true );
		$fuzzy_config  = $config['fuzzy'];
		$search_fields = $this->get_search_fields( $post_types, $config['models'] );
		$order_by      = array(
			array(
				'field'     => 'published_at',
				'direction' => 'desc',
			),
		);

		if ( 0 === count( $search_fields ) ) {
			return array();
		}

		$page_number    = $query->get( 'paged', 0 );
		$posts_per_page = $query->get( 'posts_per_page', 10 );
		$query_offset   = $query->get( 'offset', false );
		$offset         = false !== $query_offset ? $query_offset : self::get_offset( $page_number, $posts_per_page );
		$filter         = $this->generate_filters( $post_types );

		try {
			// Reach out to content engine.
			$ce_results = $this->search_content_engine(
				$query->query['s'],
				$order_by,
				$posts_per_page,
				$offset,
				$search_fields,
				$fuzzy_config['enabled'],
				$fuzzy_config['distance'],
				$filter,
			);
		} catch ( Exception $e ) {
			$message = 'Search call to Atlas Search was not successful, falling back to default search.';
			( new Debug_Logger() )->log( $message . " {$e->__toString()}" );
			$this->add_debug_message( $message );
			return $posts;
		}

		$this->add_debug_message( 'Search Provided by Atlas Search.' );

		// Pick out the hits.
		$hits = $ce_results['result']['documents'];

		// setup for found documents.
		$found_documents = $ce_results['result']['total'];
		// set the amount of records found for this page.
		$query->found_posts = $found_documents;
		// set num_posts for found_posts hook.
		$query->num_posts = $found_documents;
		// setup pagination.
		$query->max_num_pages = ceil( $found_documents / $posts_per_page );
		// set that the search was a success to be used later.
		$query->content_engine_search_success = true;

		// format strategy.
		$fields = $query->get( 'fields', '' );

		switch ( $fields ) {
			case 'ids':
				$result_posts = $this->format_hits_as_ids( $hits );
				break;

			case 'id=>parent':
				$result_posts = $this->format_hits_as_id_parents( $hits );
				break;

			default:
				$result_posts = $this->format_hits_as_ids( $hits );
				break;
		}

		return $result_posts;
	}

	/**
	 * Generates filters.
	 *
	 * @param array $post_types Post types - could be empty array.
	 * @return string|null Filter string or null.
	 */
	public function generate_filters( array $post_types ): ?string {
		if ( empty( $post_types ) ) {
			return null;
		}
		$types_str = implode( ',', $post_types );

		return "post_type:{$types_str} OR postType:{$types_str}";
	}

	/**
	 * @param array $post_types Post types.
	 * @param array $models_config Configuration of mdels.
	 * @return array
	 */
	public function get_search_fields( array $post_types, array $models_config ): array {
		$fields = array();
		// If there are no post types passed in assume all post types should be selected.
		if ( 0 === count( $post_types ) ) {
			foreach ( $models_config as $post_type => $post_type_config ) {
				$post_types[] = $post_type;
			}
		}

		foreach ( $post_types as $post_type ) {
			$config_for_post_type = $models_config[ $post_type ];
			foreach ( $config_for_post_type as $key => $value ) {
				$weight      = $value['weight'];
				$flat_fields = array_column( $fields, 'weight', 'name' );
				if ( true === $value['searchable'] && ! array_key_exists( $key, $flat_fields ) ) {
					$fields[] = array(
						'name'   => $key,
						'weight' => $weight,
					);
					if ( $value['has_sub_fields'] ) {
						$fields[] = array(
							'name'   => "$key.*",
							'weight' => $weight,
						);
					}
					if ( array_key_exists( $key, self::NEW_NAMING_MAPPING ) ) {
						$mapped_key = self::NEW_NAMING_MAPPING[ $key ];
						$fields[]   = array(
							'name'   => $mapped_key,
							'weight' => $weight,
						);
						if ( $value['has_sub_fields'] ) {
							$fields[] = array(
								'name'   => "$mapped_key.*",
								'weight' => $weight,
							);
						}
					}
				}
			}
		}

		return $fields;
	}

	protected function format_hits_as_id_parents( $hits ): array {
		$result_posts = array();

		foreach ( $hits as $hit ) {
			$source = $hit['_source'];

			$post_data = (object) array(
				'ID'                    => $source['wpId'],
				'post_parent'           => $source['slug'],
				'content_engine_search' => true,
			);

			$result_posts[] = $post_data;
		}
		return $result_posts;
	}

	protected function format_hits_as_ids( $hits ): array {
		$result_posts = array();

		foreach ( $hits as &$hit ) {
			if ( isset( $hit ) ) {
				$result_posts[] = $hit['id'];
			}
		}

		return $result_posts;
	}

	protected function format_hits_as_posts( $hits ): array {
		$result_posts = array();

		foreach ( $hits as &$hit ) {
			$source = $hit['_source'];

			$post_data = (object) array(
				'ID'                    => isset( $source['wpId'] ) ? $source['wpId'] : $source['id'],
				'post_name'             => $source['slug'],
				'post_title'            => $source['title'],
				'post_content'          => $source['content'],
				'post_excerpt'          => $source['excerpt'],
				'post_status'           => isset( $source['status'] ) ? $source['status'] : $source['post_status'],
				'post_author'           => $source['author']['wpId'],
				'post_type'             => isset( $source['postType'] ) ? $source['postType'] : $source['post_type'],
				'content_engine_search' => true,
			);

			$result_posts[] = $post_data;
		}

		return $result_posts;
	}

	/**
	 * Set the found_posts variable on WP_Query.
	 *
	 * @param int      $found_posts Number of found posts.
	 * @param WP_Query $query Query object.
	 * @since 2.18.0
	 * @return int
	 */
	public function found_posts( $found_posts, $query ) {
		if ( ( isset( $query->content_engine_search_success ) && false === $query->content_engine_search_success ) ) {
			return $found_posts;
		}

		return $query->num_posts;
	}

	/**
	 * @param int $page_number Page number.
	 * @param int $posts_per_page Posts per page.
	 * @return int
	 */
	public static function get_offset( int $page_number, int $posts_per_page ): int {
		return $page_number > 0 ? ( $page_number - 1 ) * $posts_per_page : $page_number;
	}

}
