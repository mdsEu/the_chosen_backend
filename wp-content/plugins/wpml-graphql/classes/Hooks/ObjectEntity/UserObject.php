<?php

namespace WPML\GraphQL\Hooks\ObjectEntity;

use WPML\GraphQL\Helpers;
use WPML\GraphQL\Resolvers\UserFields;

class UserObject extends BaseObject {

	const FILTER_FROM_TYPE = 'User';

	/** @var UserFields */
	public $fieldsResolver;

	/** @var Helpers */
	public $helpers;

	public function __construct(
		UserFields $fieldsResolver,
		Helpers $helpers
	) {
		$this->fieldsResolver = $fieldsResolver;
		$this->helpers        = $helpers;
	}

	/**
	 * @see BaseObject::registerObjectFieldsAndFilters
	 */
	public function registerObjectFieldsAndFilters() {
		foreach ( $this->helpers->getGraphqlAllowedPostTypes() as $postTypeObject ) {
			if ( apply_filters( 'wpml_is_translated_post_type', false, $postTypeObject->name ) ) {
				$graphQlSingleName = $postTypeObject->graphql_single_name;

				$this->registerLanguageFilter( $graphQlSingleName, self::FILTER_FROM_TYPE );
			}
		}
		$this->registerLanguageFilter( 'Comment', self::FILTER_FROM_TYPE );
	}

}
