<?php

namespace Wpe_Content_Engine\Helper\Sync\Entity\Wordpress;

use ErrorException;
use Wpe_Content_Engine\Helper\Logging\Server_Log_Info;
use Wpe_Content_Engine\WPSettings;

class Term extends WP_Entity {


	public const TAXONOMY_NAME_CATEGORY = 'category';
	public const TAXONOMY_NAME_POST_TAG = 'post_tag';
	/**
	 * @param int    $term_id Term ID.
	 * @param int    $tt_id TT ID.
	 * @param string $taxonomy_name Taxonomy.
	 * @throws ErrorException Exception.
	 */
	public function upsert( int $term_id, int $tt_id, string $taxonomy_name ) {
		if ( ! $this->is_allowed( $taxonomy_name ) ) {
			return;
		}

		$query = <<<'GRAPHQL'
				mutation syncTerm(
					$name: String!
					$slug: String!
					$wpId: Int!
					$description: String!          
					$taxonomyName: String!
					$wpParentTermId: Int!
				) {
					syncTaxonomy(
						data: {
							name: $taxonomyName
						}
					) {
						status
						message
					}
					
					syncTerm(
						taxonomy: $taxonomyName
						data: {
							name: $name
							slug: $slug
							description: $description
							wpId: $wpId
							wpParentTermId: $wpParentTermId
						}
					) {
						status
						message
					}
				}
				GRAPHQL;

		$term         = get_term( $term_id );
		$graphql_vars = array(
			'name'           => $term->name,
			'wpId'           => $term->term_id,
			'wpParentTermId' => $term->parent,
			'slug'           => $term->slug,
			'description'    => $term->description,
			'taxonomyName'   => $taxonomy_name,
		);

		$wpe_content_engine_options = $this->settings->get( WPSettings::WPE_CONTENT_ENGINE_OPTION_NAME ); // Array of All Options.

		$this->client->query(
			$wpe_content_engine_options['url'],
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
	 * @param int    $term_id Term ID.
	 * @param string $taxonomy_name Taxonomy Name.
	 * @throws ErrorException Exception.
	 */
	public function delete( int $term_id, string $taxonomy_name ) {
		if ( ! $this->is_allowed( $taxonomy_name ) ) {
			return;
		}

		$query = <<<'GRAPHQL'
			mutation DeleteTerm($taxonomy: String!, $name: String!) {
				termDelete(name: $name, taxonomy: $taxonomy) {
					status
					message
				}
			}
		GRAPHQL;

		$term = get_term( $term_id );

		$graphql_vars = array(
			'name'     => $term->name,
			'taxonomy' => $taxonomy_name,
		);

		$wpe_content_engine_options = $this->settings->get( WPSettings::WPE_CONTENT_ENGINE_OPTION_NAME ); // Array of All Options.

		$this->client->query(
			$wpe_content_engine_options['url'],
			$query,
			$graphql_vars,
			$wpe_content_engine_options['access_token']
		);
	}

	/**
	 * @param string $taxonomy_name Taxonomy Name.
	 * @return bool
	 */
	private function is_allowed( string $taxonomy_name ): bool {
		$allowed_taxonomies = array( self::TAXONOMY_NAME_CATEGORY, self::TAXONOMY_NAME_POST_TAG );

		if ( ! in_array( $taxonomy_name, $allowed_taxonomies ) ) {
			return false;
		}

		return true;
	}
}
