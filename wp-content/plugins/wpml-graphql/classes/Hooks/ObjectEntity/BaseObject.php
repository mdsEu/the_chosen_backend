<?php

namespace WPML\GraphQL\Hooks\ObjectEntity;

use WPML\LIB\WP\Hooks;
use function WPML\FP\spreadArgs;
use WPML\GraphQL\Helpers;
use WPML\GraphQL\Hooks\ObjectType\LanguageType;
use WPML\GraphQL\Resolvers\BaseFields as FieldsResolver;
use WPML\GraphQL\Resolvers\Interfaces\LanguageFields;
use WPML\GraphQL\Resolvers\Interfaces\TranslationFields;
use WPML\GraphQL\Resolvers\Interfaces\ModelFields;

abstract class BaseObject implements \IWPML_Frontend_Action, \IWPML_DIC_Action {

	const LANGUAGE_FIELD_NAME      = 'language';
	const LANGUAGE_CODE_FIELD_NAME = 'languageCode';
	const TRID_FIELD_NAME          = 'translationGroupId';
	const TRID_FIELD_TYPE          = 'ID';
	const TRANSLATIONS_FIELD_NAME  = 'translations';

	const ADJUST_MODEL_FIELDS_PRIORITY   = 99;
	const ADJUST_MODEL_FIELDS_ARGS_COUNT = 3;

	/** @var FieldsResolver */
	public $fieldsResolver;

	/** @var Helpers */
	public $helpers;

	public function __construct(
		FieldsResolver $fieldsResolver,
		Helpers $helpers
	) {
		$this->fieldsResolver = $fieldsResolver;
		$this->helpers        = $helpers;
	}

	public function add_hooks() {
		Hooks::onAction( 'graphql_register_types' )
			->then( [ $this, 'registerObjectFieldsAndFilters' ] );
		
		if ( $this->fieldsResolver instanceof ModelFields ) {
			Hooks::onFilter(
				'graphql_model_prepare_fields',
				self::ADJUST_MODEL_FIELDS_PRIORITY,
				self::ADJUST_MODEL_FIELDS_ARGS_COUNT
			)->then( spreadArgs( [ $this->fieldsResolver, 'adjustModelFields' ] ) );
		}
	}

	/**
	 * Register 'language' and 'translations' fields for objects,
	 * and apply filters by language
	 *
	 * @return void
	 */
	public function registerObjectFieldsAndFilters() {
		$this->manageFieldsAndDefineFilters();
		$this->applyLanguageFilter();
	}

	/**
	 * Manage 'language' and 'translations' fields for objects,
	 * and define filters by language
	 *
	 * @return void
	 */
	abstract protected function manageFieldsAndDefineFilters();


	/**
	 * Apply filters by language
	 *
	 * @return void
	 */
	abstract protected function applyLanguageFilter();

	/**
	 * Register a filter by language given a GraphQL type single name
	 *
	 * @param string $graphQlSingleName Usually, a capitalized version of a post type, taxonomy or 'Comment'.
	 *
	 * @return void
	 */
	protected function registerLanguageFilter( $graphQlSingleName ) {
		$graphQlType = ucfirst( $graphQlSingleName );
		register_graphql_fields(
			"RootQueryTo${graphQlType}ConnectionWhereArgs",
			[
				LanguageType::FILTER_NAME => [
					'type'        => LanguageType::MAIN_FIELD_TYPE,
					'description' => sprintf(
						__( "Filter %s objects by language code", 'wp-graphql-wpml' ),
						$graphQlType
					),
				],
			]
		);
	}

	/**
	 * Resolve the object fields, implemented by object type
	 *
	 * @param string $graphQlSingleName Usually, a capitalized version of a post type, taxonomy or 'Comment'.
	 *
	 * @return void
	 */
	protected function manageFields( $graphQlSingleName ) {
		$graphQlType = ucfirst( $graphQlSingleName );

		if ( $this->fieldsResolver instanceof LanguageFields ) {
			register_graphql_field(
				$graphQlSingleName,
				self::LANGUAGE_FIELD_NAME,
				[
					'type'        => LanguageType::TYPE_NAME,
					'description' => sprintf(
						__( "%s language", 'wp-graphql-wpml' ),
						$graphQlType
					),
					'resolve'     => [ $this->fieldsResolver, 'resolveLanguageField' ],
				]
			);
			register_graphql_field(
				$graphQlSingleName,
				self::LANGUAGE_CODE_FIELD_NAME,
				[
					'type'        => LanguageType::MAIN_FIELD_TYPE,
					'description' => sprintf(
						__( "%s language code", 'wp-graphql-wpml' ),
						$graphQlType
					),
					'resolve'     => [ $this->fieldsResolver, 'resolveLanguageCodeField' ],
				]
			);
		}

		if ( $this->fieldsResolver instanceof TranslationFields ) {
			register_graphql_field(
				$graphQlSingleName,
				self::TRID_FIELD_NAME,
				[
					'type'        => self::TRID_FIELD_TYPE,
					'description' => sprintf(
						__( "%s translation group ID", 'wp-graphql-wpml' ),
						$graphQlType
					),
					'resolve'     => [ $this->fieldsResolver, 'resolveTranslationGroupIdField' ],
				]
			);
			register_graphql_field(
				$graphQlSingleName,
				self::TRANSLATIONS_FIELD_NAME,
				[
					'type'        => [
						'list_of' => $graphQlType,
					],
					'description' => sprintf(
						__( "%s translations", 'wp-graphql-wpml' ),
						$graphQlType
					),
					'resolve'     => [ $this->fieldsResolver, 'resolveTranslationsField' ],
				]
			);
		}
	}

	/**
	 * Set the current language based on the query 'where' filters
	 *
	 * @param mixed[] $queryArgs
	 * @param mixed[] $whereArgs
	 *
	 * @return mixed[]
	 */
	public function setLanguageFromQueryArgs( $queryArgs, $whereArgs ) {
		$selectedLanguage = $this->helpers->getArr( LanguageType::FILTER_NAME, $whereArgs );

		if ( is_null( $selectedLanguage ) ) {
			return $queryArgs;
		}

		if ( 'all' === $selectedLanguage ) {
			$queryArgs['suppress_wpml_where_and_join_filter'] = true;
			return $queryArgs;
		}

		if ( ! $this->helpers->isActiveLanguage( $selectedLanguage ) ) {
			throw new \Exception('Filtering by a non-active language');
		}

		$this->helpers->setCurrentLanguage( $selectedLanguage );

		return $queryArgs;
	}

}
