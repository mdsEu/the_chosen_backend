<?php

namespace WPML\GraphQL\Hooks\ObjectEntity;

use WPML\GraphQL\Helpers;
use WPML\GraphQL\Resolvers\TermFields;

// TODO Skip query results in hidden languages when filtering by all languages

class TermObject extends BaseObject {

	// phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
	public function __construct(
		TermFields $fieldsResolver,
		Helpers $helpers
	) {
		parent::__construct( $fieldsResolver, $helpers );
	}

	/**
	 * @see BaseObject::registerObjectFieldsAndFilters
	 */
	public function registerObjectFieldsAndFilters() {
		foreach ( $this->helpers->getGraphqlAllowedTaxonomies() as $taxonommyObject ) {
			if ( apply_filters( 'wpml_is_translated_taxonomy', false, $taxonommyObject->name ) ) {
				$graphQlSingleName = $taxonommyObject->graphql_single_name;

				$this->registerLanguageFilter( $graphQlSingleName );
				$this->manageFields( $graphQlSingleName );
			}
		}
	}

}
