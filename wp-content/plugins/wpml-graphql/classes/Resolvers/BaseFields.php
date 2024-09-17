<?php

namespace WPML\GraphQL\Resolvers;

use WPML\GraphQL\Helpers;

abstract class BaseFields {

	/** @var Helpers */
	public $helpers;

	public function __construct( Helpers $helpers ) {
		$this->helpers = $helpers;
	}

}
