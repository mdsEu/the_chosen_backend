<?php

namespace WPML\GraphQL\Hooks\Connection;

use WPML\GraphQL\Helpers;
use WPML\GraphQL\Hooks\Query\LanguageFilter;

abstract class Base {

	/** @var Helpers */
	public $helpers;

	/**
	 * @var callable(mixed $root,array<string,mixed> $args,\WPGraphQL\AppContext $context,\GraphQL\Type\Definition\ResolveInfo $info):mixed
	 */
	protected $originalResolve;

	/** @var string */
	protected $connectedTypeName;

	public function __construct( Helpers $helpers, $originalResolve, $connectedTypeName = '' ) {
		$this->helpers           = $helpers;
		$this->originalResolve   = $originalResolve;
		$this->connectedTypeName = $connectedTypeName;
	}

	/**
	 * @param \WPGraphQL\Model\Model               $root
	 * @param array<string,mixed>                  $args
	 * @param \WPGraphQL\AppContext                $context
	 * @param \GraphQL\Type\Definition\ResolveInfo $info
	 *
	 * @return \GraphQL\Deferred
	 */
	abstract public function resolveReplacement( $root, $args, $context, $info );

}
