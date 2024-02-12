<?php

namespace WPML\GraphQL\Resolvers;

use WPGraphQL\AppContext;
use GraphQL\Type\Definition\ResolveInfo;

class QueryFields extends BaseFields {

	/**
	 * Resolve the \WPML\GraphQL\Hooks\Query\Languages::LANGUAGES_QUERY_SLUG query
	 *
	 * @param mixed       $source
	 * @param mixed[]     $args
	 * @param AppContext  $context
	 * @param ResolveInfo $info
	 *
	 * @return array[]
	 */
	public function resolveLanguagesQuery( $source, $args, $context, $info ) {
		$resolved_languages = [];
		$fields             = array_keys( $info->getFieldSelection() );

		if ( empty( $fields ) ) {
			return $resolved_languages;
		}

		$languages = $this->helpers->getAvailableLanguages();

		foreach ( $languages as $lang ) {
			$resolved_languages[] = $this->helpers->filterFields( $lang, $fields );
		}

		return $resolved_languages;
	}

	/**
	 * Resolve the \WPML\GraphQL\Hooks\Query\Languages::DEFAULT_LANGUAGE_QUERY_SLUG query
	 *
	 * @param mixed       $source
	 * @param mixed[]     $args
	 * @param AppContext  $context
	 * @param ResolveInfo $info
	 *
	 * @return array
	 */
	public function resolveDefaultLanguageQuery( $source, $args, $context, $info ) {
		$fields = array_keys( $info->getFieldSelection() );

		if ( empty( $fields ) ) {
			return [];
		}

		$defaultLang = $this->helpers->getDefaultLanguage();

		if ( empty( $defaultLang ) ) {
			return [];
		}

		$languages       = $this->helpers->getAvailableLanguages();
		$defaultLangData = $this->helpers->getArr( $defaultLang, $languages );

		if ( empty( $defaultLangData ) ) {
			return [];
		}

		$defaultLanguage = $this->helpers->filterFields( $defaultLangData, $fields );

		return $defaultLanguage;
	}

}
