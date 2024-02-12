<?php

namespace WPML\GraphQL\Hooks\ObjectEntity;

use WPML\LIB\WP\Hooks;
use function WPML\FP\spreadArgs;
use WPML\GraphQL\Helpers;
use WPML\GraphQL\Resolvers\PostFields;

// TODO Review comments resolvers; see \WPGraphQL\Registry\Utils\PostObject::get_connections
// TODO Review preview resolvers; see \WPGraphQL\Registry\Utils\PostObject::get_connections
// TODO Review revisions resolvers; see \WPGraphQL\Registry\Utils\PostObject::get_connections
// TODO Adjust taxonomy resolvers; see \WPGraphQL\Registry\Utils\PostObject::get_connections
// TODO Adjust taxonomy node resolvers; see \WPGraphQL\Registry\Utils\PostObject::get_connections

class PostObject extends BaseObject {

	// phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
	public function __construct(
		PostFields $fieldsResolver,
		Helpers $helpers
	) {
		parent::__construct( $fieldsResolver, $helpers );
	}

	/**
	 * Register filters and fields for all registered post types
	 *
	 * @see BaseObject::manageFieldsAndDefineFilters
	 */
	protected function manageFieldsAndDefineFilters() {
		foreach ( $this->helpers->getGraphqlAllowedPostTypes('objects') as $postTypeObject ) {
			if ( apply_filters( 'wpml_is_translated_post_type', false, $postTypeObject->name ) ) {
				$graphQlSingleName = $postTypeObject->graphql_single_name;

				$this->registerLanguageFilter( $graphQlSingleName );
				$this->manageFields( $graphQlSingleName );
			}
		}
	}

	/**
	 * @see BaseObject::applyLanguageFilter
	 */
	protected function applyLanguageFilter() {
		Hooks::onFilter( 'graphql_map_input_fields_to_wp_query', 10, 2 )
			->then( spreadArgs( [ $this, 'setLanguageFromQueryArgs' ] ) );
	}
	
}
