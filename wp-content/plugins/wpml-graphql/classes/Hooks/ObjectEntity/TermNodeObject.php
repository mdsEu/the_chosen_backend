<?php

namespace WPML\GraphQL\Hooks\ObjectEntity;

use WPML\GraphQL\Helpers;
use WPML\GraphQL\Resolvers\TermFields;

// TODO Skip query results in hidden languages when filtering by all languages

class TermNodeObject extends BaseObject {

	const OBJECT_TYPE = 'TermNode';

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
		$this->registerLanguageFilter( self::OBJECT_TYPE );
		$this->manageFields( self::OBJECT_TYPE );
	}

}
