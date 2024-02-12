<?php

namespace WPML\GraphQL\Hooks\ObjectEntity;

use WPML\LIB\WP\Hooks;
use function WPML\FP\spreadArgs;
use WPML\GraphQL\Helpers;
use WPML\GraphQL\Hooks\ObjectType\LanguageType;
use WPML\GraphQL\Resolvers\TermFields;

// TODO Skip query results in hidden languages when filtering by all languages
// TODO Adjust children node resolvers; see \WPGraphQL\Registry\Utils\TermObject::get_connections
// TODO Adjust parent node resolvers; see \WPGraphQL\Registry\Utils\TermObject::get_connections
// TODO Adjust ancestors node resolvers; see \WPGraphQL\Registry\Utils\TermObject::get_connections
// TODO Adjust content node resolvers; see \WPGraphQL\Registry\Utils\TermObject::get_connections
// TODO Adjust post type resolvers; see \WPGraphQL\Registry\Utils\TermObject::get_connections

class TermObject extends BaseObject {

	// phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
	public function __construct(
		TermFields $fieldsResolver,
		Helpers $helpers
	) {
		parent::__construct( $fieldsResolver, $helpers );
	}

	/**
	 * Register filters and fields for all registered taxonomies
	 *
	 * @see BaseObject::manageFieldsAndDefineFilters
	 */
	protected function manageFieldsAndDefineFilters() {
		foreach ( $this->helpers->getGraphqlAllowedTaxonomies('objects') as $taxonommyObject ) {
			if ( apply_filters( 'wpml_is_translated_taxonomy', false, $taxonommyObject->name ) ) {
				$graphQlSingleName = $taxonommyObject->graphql_single_name;

				$this->registerLanguageFilter( $graphQlSingleName );
				$this->manageFields( $graphQlSingleName );
			}
		}
	}

	/**
	 * @see BaseObject::applyLanguageFilter
	 */
	protected function applyLanguageFilter() {
		Hooks::onFilter( 'graphql_map_input_fields_to_get_terms', 10, 2 )
			->then( spreadArgs( function( $queryArgs, $whereArgs ) {
				$selectedLanguage = $this->helpers->getArr( LanguageType::FILTER_NAME, $whereArgs );

				if ( is_null( $selectedLanguage ) ) {
					return $queryArgs;
				}
		
				if ( 'all' === $selectedLanguage ) {
					$queryArgs[ 'wpml_skip_filters' ] = true;
				}

				return $this->setLanguageFromQueryArgs( $queryArgs, $whereArgs );
			} ) );
	}

}
