<?php

namespace WPML\GraphQL\Resolvers\Interfaces;

use WPGraphQL\Model\Model;

interface TranslationFields extends LanguageFields {

	/**
	 * Resolve translation group id field
	 *
	 * @param Model $model
	 *
	 * @return null|int
	 */
	public function resolveTranslationGroupIdField( Model $model );

	/**
	 * Resolve translations field
	 *
	 * @param Model $model
	 *
	 * @return null|mixed[]
	 */
	public function resolveTranslationsField( Model $model );

}
