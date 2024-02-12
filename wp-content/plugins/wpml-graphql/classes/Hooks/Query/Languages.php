<?php

namespace WPML\GraphQL\Hooks\Query;

use WPML\LIB\WP\Hooks;
use WPML\GraphQL\Helpers;
use WPML\GraphQL\Hooks\ObjectType\LanguageType;
use WPML\GraphQL\Resolvers\QueryFields;

class Languages implements \IWPML_Frontend_Action, \IWPML_DIC_Action {

	const LANGUAGES_QUERY_SLUG        = 'languages';
	const DEFAULT_LANGUAGE_QUERY_SLUG = 'defaultLanguage';

	/** @var QueryFields */
	public $fieldsResolver;

	/** @var Helpers */
	public $helpers;

	public function __construct(
		QueryFields $fieldsResolver,
		Helpers $helpers
	) {
		$this->fieldsResolver = $fieldsResolver;
		$this->helpers = $helpers;

		$this->helpers->getAvailableLanguages();
	}

	public function add_hooks() {
		Hooks::onAction( 'graphql_register_types' )
			->then( [ $this, 'registerLanguageQueries' ] );
	}

	/**
	 * Register root Query to get all available languages, and the default language
	 *
	 * @return void
	 */
	public function registerLanguageQueries() {
		register_graphql_field( 'RootQuery', self::LANGUAGES_QUERY_SLUG, [
			'type'        => [ 'list_of' => LanguageType::TYPE_NAME ],
			'description' => __( 'List registered languages', 'wp-graphql-wpml' ),
			'resolve'     => [ $this->fieldsResolver, 'resolveLanguagesQuery' ],
		]);

		register_graphql_field( 'RootQuery', self::DEFAULT_LANGUAGE_QUERY_SLUG, [
			'type'        => LanguageType::TYPE_NAME,
			'description' => __( 'Get default language', 'wp-graphql-wpml' ),
			'resolve'     => [ $this->fieldsResolver, 'resolveDefaultLanguageQuery' ],
		]);
	}

}
