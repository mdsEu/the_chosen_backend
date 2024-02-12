<?php

namespace WPML\GraphQL\Resolvers\Interfaces;

use WPGraphQL\AppContext;
use GraphQL\Type\Definition\ResolveInfo;
use WPGraphQL\Model\Model;

interface LanguageFields {

	/**
	 * Resolve language field
	 *
	 * @param Model       $model
	 * @param mixed[]     $args
	 * @param AppContext  $context
	 * @param ResolveInfo $info
	 *
	 * @return null|mixed[]
	 */
	public function resolveLanguageField(
		Model $model,
		$args,
		AppContext $context,
		ResolveInfo $info
	);

	/**
	 * Resolve language code field
	 *
	 * @param Model $model
	 *
	 * @return null|string
	 */
	public function resolveLanguageCodeField( Model $model );

}
