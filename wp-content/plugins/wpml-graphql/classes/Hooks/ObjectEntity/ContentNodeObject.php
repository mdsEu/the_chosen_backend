<?php

namespace WPML\GraphQL\Hooks\ObjectEntity;

use WPML\GraphQL\Helpers;
use WPML\GraphQL\Resolvers\ContentNodeFields;

class ContentNodeObject extends BaseObject {

	const OBJECT_TYPE = 'ContentNode';

	// phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
	public function __construct(
		ContentNodeFields $fieldsResolver,
		Helpers $helpers
	) {
		parent::__construct( $fieldsResolver, $helpers );
	}

	/**
	 * @see BaseObject::registerObjectFieldsAndFilters
	 */
	public function registerObjectFieldsAndFilters() {
		$this->registerLanguageFilter( self::OBJECT_TYPE );
		$this->manageFields( self::OBJECT_TYPE );
	}

}
