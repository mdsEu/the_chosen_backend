<?php

namespace WPML\GraphQL\Resolvers;

use WPML\LIB\WP\Hooks;
use WPGraphQL\AppContext;
use GraphQL\Type\Definition\ResolveInfo;
use WPML\GraphQL\Helpers;

abstract class BaseFields {

	/** @var Helpers */
	public $helpers;

	public function __construct( Helpers $helpers ) {
		$this->helpers = $helpers;
	}

}
