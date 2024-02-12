<?php

namespace Wpe_Content_Engine\Helper\Sync\Entity\Wordpress;

use ErrorException;
use WP_Error;
use WP_Post;
use WP_Term;
use Wpe_Content_Engine\Helper\Acf_Support\Acf;
use Wpe_Content_Engine\Helper\Constants\Post_Type;
use Wpe_Content_Engine\Helper\Constants\Post_Status;
use Wpe_Content_Engine\Helper\Data_Life_Cycle;
use Wpe_Content_Engine\Helper\Logging\Server_Log_Info;
use Wpe_Content_Engine\WPSettings;

class Post extends WP_Entity {

	/**
	 * @param int      $post_id Post ID.
	 * @param WP_Post  $post Post.
	 * @param Acf|null $acf_info TODO: gonna be used in ORN-512.
	 * @throws ErrorException Exception.
	 */
	public function upsert( int $post_id, WP_Post $post, ?Acf $acf_info = null ) {
		if ( ! $this->is_allowed( $post ) ) {
			return;
		}

		// If this is a revision, get real post ID.
		// @codingStandardsIgnoreLine
		if ( $parent_id = wp_is_post_revision( $post_id ) ) {
			$post_id = $parent_id;
		}

		$query = <<<'GRAPHQL'
        mutation syncPost(
          $wpIdBigInt: BigInt!
          $wpAuthorUserId: Int!
          $wpFeaturedImageId: Int
          $wpFeaturedImageUrl: String
          $published_at: DateTime!
          $published_at_local: DateTime!
          $updatedAt: DateTime!
          $updatedAtLocal: DateTime!
          $slug: String!
          $content: String!
          $title: String!
          $excerpt: String!
          $password: String!
          $urlToPing: String!
          $pinged: String!
          $contentFiltered: String!
          $urlPath: String!
          $menuOrder: Int!
          $commentCount: Int!
          $status: String!
          $postType: String!
          $tags : [SyncTermInputForPost!]
          $categories : [SyncTermInputForPost!]
          $acf: JSON
        ) {
          syncPost(
            wpIdBigInt: $wpIdBigInt
            data: {
              wpAuthorUserId: $wpAuthorUserId
              wpFeaturedImageId: $wpFeaturedImageId
              wpFeaturedImageUrl: $wpFeaturedImageUrl
              published_at: $published_at
              published_at_local: $published_at_local
              updatedAt: $updatedAt
              updatedAtLocal: $updatedAtLocal
              slug: $slug
              content: $content
              title: $title
              excerpt: $excerpt
              password: $password
              urlToPing: $urlToPing
              pinged: $pinged
              contentFiltered: $contentFiltered
              urlPath: $urlPath
              menuOrder: $menuOrder
              commentCount: $commentCount
              status: $status
              postType: $postType
              tags: $tags
              categories: $categories
              acf: $acf
            }
          ) {
                status
                message
          }
        }
        GRAPHQL;

		$graphql_vars = array(
			'wpIdBigInt'         => $post_id,
			'wpAuthorUserId'     => (int) $post->post_author,
			'wpFeaturedImageId'  => null,
			'wpFeaturedImageUrl' => null,
			'published_at'       => $post->post_date,
			'published_at_local' => $post->post_date_gmt,
			'updatedAt'          => $post->post_modified,
			'updatedAtLocal'     => $post->post_modified_gmt,
			'slug'               => $post->post_name,
			'content'            => $post->post_content,
			'title'              => $post->post_title,
			'excerpt'            => $post->post_excerpt,
			'password'           => $post->post_password,
			'urlToPing'          => $post->to_ping,
			'pinged'             => $post->pinged,
			'contentFiltered'    => $post->post_content_filtered,
			'urlPath'            => $this->calculate_url_path( $post ),
			'menuOrder'          => $post->menu_order,
			'commentCount'       => (int) $post->comment_count,
			'status'             => Data_Life_Cycle::map_status( $post->post_status, $post->post_password ),
			'postType'           => $post->post_type,
			'tags'               => $this->extract_terms_slug( get_the_tags( $post_id ) ),
			'categories'         => $this->extract_terms_slug( get_the_category( $post_id ) ),
			'acf'                => isset( $acf_info ) ? $acf_info->get_data() : array(),
		);

		$wpe_content_engine_options = $this->settings->get( WPSettings::WPE_CONTENT_ENGINE_OPTION_NAME ); // Array of All Options.

		return $this->client->query(
			$wpe_content_engine_options['url'] ?? '',
			$query,
			$graphql_vars,
			$wpe_content_engine_options['access_token'],
			( new Server_Log_Info() )->get_data()
		);
	}

	/**
	 * TODO: This is disabled because of ORN-205. We can take a look post Q2
	 *  to see if this is really needed or needs to be removed
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post Post.
	 * @throws ErrorException Exception.
	 */
	public function delete( int $post_id, WP_Post $post ) {
		if ( ! $this->is_allowed( $post ) ) {
			return;
		}

		$query = <<<'GRAPHQL'
        mutation PostDelete($wpId: Int!) {
          postDelete(wpId: $wpId) {
            status
            message
          }
        }
        GRAPHQL;

		$wpe_content_engine_options = $this->settings->get( WPSettings::WPE_CONTENT_ENGINE_OPTION_NAME ); // Array of All Options.
		$url                        = $wpe_content_engine_options['url']; // Url.
		$access_token               = $wpe_content_engine_options['access_token']; // Access Token.

		$this->client->query( $url, $query, array( 'wpId' => $post_id ), $access_token );
	}


	/**
	 * @param WP_Term[]|false|WP_Error $terms Terms.
	 * @return array
	 */
	private function extract_terms_slug( $terms ): array {
		if ( empty( $terms ) || $terms instanceof WP_Error ) {
			return array();
		}

		$result = array();
		foreach ( $terms as $term ) {
			$result[] = array( 'slug' => $term->slug );
		}

		return $result;
	}

	/**
	 * @param WP_Post $post Post.
	 * @return bool
	 */
	private function is_allowed( WP_Post $post ): bool {
		$allowed_post_types = array( Post_Type::POST, Post_Type::PAGE );

		if ( ! in_array( $post->post_type, $allowed_post_types ) ) {
			return false;
		}

		if ( Post_Status::AUTO_DRAFT === $post->post_status ) {
			return false;
		}

		if ( '' === $post->post_name ) {
			return false;
		}

		return true;
	}

	/**
	 * @param WP_Post $post Post.
	 * @return string|null
	 */
	private function calculate_url_path( WP_Post $post ): ?string {
		// TODO: ORN-259
		// We need to stop the wpe-headless plugin from
		// rewriting the url to include the Front-end site URL.
		if ( function_exists( 'wpe_headless_post_link' ) ) {
			remove_filter( 'post_link', 'wpe_headless_post_link', 10 );
		}

		$uri = $this->get_link( $post );

		// TODO: ORN-259
		// After we're done we need to re-hook the wpe-headless plugin
		// so that it continues to rewrite url's in other contexts.
		if ( function_exists( 'wpe_headless_post_link' ) ) {
			add_filter( 'post_link', 'wpe_headless_post_link', 10 );
		}

		if ( true === $this->is_front_page( $post ) ) {
			return '/';
		}

		return ! empty( $uri ) ? str_ireplace( home_url(), '', untrailingslashit( $uri ) ) : null;
	}

	/**
	 * @param WP_Post $post Post.
	 * @return bool
	 */
	private function is_front_page( WP_Post $post ): bool {
		if ( 'page' !== $post->post_type || 'page' !== get_option( 'show_on_front' ) ) {
			return false;
		}
		if ( absint( get_option( 'page_on_front', 0 ) ) === $post->ID ) {
			return true;
		}

		return false;
	}

	/**
	 * @param WP_Post $post Post.
	 * @return bool
	 */
	private function is_preview( WP_Post $post ): bool {
		if ( $this->is_revision( $post ) ) {
			$revisions = wp_get_post_revisions(
				$this->get_parent_database_id( $post ),
				array(
					'posts_per_page' => 1,
					'fields'         => 'ids',
					'check_enabled'  => false,
				)
			);

			if ( in_array( $post->ID, array_values( $revisions ), true ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * @param WP_Post $post Post.
	 * @return int|null
	 */
	private function get_parent_database_id( WP_Post $post ): ?int {
		return ! empty( $this->data->post_parent ) ? absint( $post->post_parent ) : null;
	}

	/**
	 * @param WP_Post $post Post.
	 * @return false|string|\WP_Error|null
	 */
	private function get_link( WP_Post $post ) {
		$link = get_permalink( $post->ID );

		if ( $this->is_preview( $post ) ) {
			$link = get_preview_post_link( $this->get_parent_database_id( $post ) );
		} elseif ( $this->is_revision( $post ) ) {
			$link = get_permalink( $post->ID );
		}

		return ! empty( $link ) ? $link : null;

	}

	/**
	 * @param WP_Post $post Post.
	 * @return bool
	 */
	private function is_revision( WP_Post $post ): bool {
		return 'revision' === $post->post_type;
	}
}
