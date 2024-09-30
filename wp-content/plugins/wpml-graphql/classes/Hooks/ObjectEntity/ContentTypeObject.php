<?php

namespace WPML\GraphQL\Hooks\ObjectEntity;

use WPML\GraphQL\Helpers;
use WPML\GraphQL\Resolvers\PostFields;

class ContentTypeObject extends BaseObject {

	const OBJECT_TYPE      = 'ContentNode';
	const FILTER_FROM_TYPE = 'ContentType';

	// phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
	public function __construct(
		PostFields $fieldsResolver,
		Helpers $helpers
	) {
		parent::__construct( $fieldsResolver, $helpers );
	}

	/**
	 * @see BaseObject::registerObjectFieldsAndFilters
	 */
	public function registerObjectFieldsAndFilters() {
		$this->registerLanguageFilter( self::OBJECT_TYPE, self::FILTER_FROM_TYPE );
	}

}
