<?php

namespace WPML\GraphQL\Hooks\ObjectType;

use WPML\LIB\WP\Hooks;

class LanguageType implements \IWPML_Frontend_Action {

	const TYPE_NAME          = 'Language';
	const FILTER_NAME        = 'language';

	CONST ID_FIELD_TYPE      = 'ID';
	const MAIN_FIELD_TYPE    = 'String';

	public function add_hooks() {
		Hooks::onAction( 'graphql_register_types' )
			->then( [ $this, 'registerLanguageObjectTypeAndFilter' ] );
	}

	/**
	 * Register the 'language' object type and define its fields
	 * Register a filter by 'language' with LanguageCodeFilterEnum values in content nodes
	 *
	 * @return void
	 */
	public function registerLanguageObjectTypeAndFilter() {
		register_graphql_object_type( self::TYPE_NAME, [
			'description' => __( 'Language', 'wp-graphql-wpml' ),
			'fields'      => [
				'id'               => [
					'type'        => [
						'non_null' => self::ID_FIELD_TYPE,
					],
					'description' => __( 'Language ID', 'wp-graphql-wpml' ),
				],
				'code'             => [
					'type'        => [
						'non_null' => self::MAIN_FIELD_TYPE,
					],
					'description' => __( 'Language code', 'wp-graphql-wpml' ),
				],
				'language_code'    => [
					'type'        => [
						'non_null' => self::MAIN_FIELD_TYPE,
					],
					'description' => __( 'Language code', 'wp-graphql-wpml' ),
				],
				'native_name'      => [
					'type'        => self::MAIN_FIELD_TYPE,
					'description' => __( 'Language name in its own language', 'wp-graphql-wpml' ),
				],
				'translated_name'  => [
					'type'        => self::MAIN_FIELD_TYPE,
					'description' => __( 'Language name in the default language', 'wp-graphql-wpml' ),
				],
				'default_locale'   => [
					'type'        => self::MAIN_FIELD_TYPE,
					'description' => __( 'Language default locale', 'wp-graphql-wpml' ),
				],
				'url'              => [
					'type'        => self::MAIN_FIELD_TYPE,
					'description' => __( 'Language front page URL', 'wp-graphql-wpml' ),
				],
				'country_flag_url' => [
					'type'        => self::MAIN_FIELD_TYPE,
					'description' => __( 'Language country flag URL', 'wp-graphql-wpml' ),
				],
			],
		]);

		register_graphql_field(
			'RootQueryToContentNodeConnectionWhereArgs',
			self::FILTER_NAME,
			[
				'type'        => self::MAIN_FIELD_TYPE,
				'description' => __( 'Filter content nodes by language code', 'wp-graphql-wpml' ),
			]
		);
	}

}
