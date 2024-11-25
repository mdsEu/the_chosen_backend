<?php

namespace WPML\GraphQL\Hooks\ObjectEntity;

use WPGraphQL\Data\Connection\AbstractConnectionResolver;
use WPGraphQL\Data\Connection\MenuConnectionResolver;
use WPML\GraphQL\Helpers;
use WPML\GraphQL\Resolvers\MenuFields;
use WPML\LIB\WP\Hooks;
use function WPML\FP\spreadArgs;

class MenuObject extends BaseObject {

	const OBJECT_TYPE = 'Menu';
	const MODEL_NAME  = 'MenuObject';

	const NAV_MENU_TAXONOMY           = 'nav_menu';
	const NAV_MENU_TAXONOMY_WPML_TYPE = 'tax_nav_menu';

	// phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
	public function __construct(
		MenuFields $fieldsResolver,
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

		Hooks::onFilter( 'pre_wpml_is_translated_taxonomy', 10, 2 )
			->then( spreadArgs( [ $this, 'makeMenusTranslatable' ] ) );

		Hooks::onFilter( 'graphql_connection_pre_get_query', 10, 2 )
			->then( spreadArgs( [ $this, 'setLanguageBeforeQuery' ] ) );

		Hooks::onFilter( 'graphql_connection_query', 10, 2 )
			->then( spreadArgs( [ $this, 'maybeIncludeAllMenus' ] ) );

		Hooks::onFilter( 'theme_mod_nav_menu_locations' )
			->then( spreadArgs( [$this, 'translateLocations' ] ) );

		Hooks::onFilter( 'graphql_data_is_private', 10, 3 )
			->then( spreadArgs( [ $this, 'isPrivate' ] ) );
	}

	/**
	 * @param bool   $result
	 * @param string $taxonomy
	 *
	 * @return bool
	 */
	public function makeMenusTranslatable( $result, $taxonomy ) {
		if ( self::NAV_MENU_TAXONOMY !== $taxonomy ) {
			return $result;
		}
		if ( ! is_graphql_request() ) {
			return $result;
		}
		return true;
	}

	/**
	 * @param null                       $result
	 * @param AbstractConnectionResolver $connectionResolver
	 *
	 * @return null
	 */
	public function setLanguageBeforeQuery( $result, $connectionResolver ) {
		if ( ! $connectionResolver instanceof MenuConnectionResolver ) {
			return $result;
		}

		$queryArgs = $connectionResolver->get_query_args();
		$language  = $this->helpers->getArr( 'language', $queryArgs );
		if (
			self::NAV_MENU_TAXONOMY === $this->helpers->getArr( 'taxonomy', $queryArgs )
			&& $language
		) {
			$this->helpers->setCurrentLanguage( $language );
		}
		return $result;
	}

	/**
	 * @param \WP_Term_Query             $query
	 * @param AbstractConnectionResolver $connectionResolver
	 *
	 * @return \WP_Term_Query
	 */
	public function maybeIncludeAllMenus( $query, $connectionResolver ) {
		if ( ! $query instanceof \WP_Term_Query ) {
			return $query;
		}
		if ( ! $connectionResolver instanceof MenuConnectionResolver ) {
			return $query;
		}

		if ( empty( $query->terms ) ) {
			return $query;
		}

		$queryArgs = $connectionResolver->get_query_args();

		if ( self::NAV_MENU_TAXONOMY !== $this->helpers->getArr( 'taxonomy', $queryArgs ) ) {
			return $query;
		}
		if ( 'all' !== $this->helpers->getArr( 'language', $queryArgs ) ) {
			return $query;
		}

		$newTermIds = [];

		array_walk( $query->terms, function( $termId, $termIdKey ) use ( &$newTermIds ) {
			$trId                = apply_filters( 'wpml_element_trid', null, $termId, self::NAV_MENU_TAXONOMY_WPML_TYPE );
			$termTranslations    = $translations = apply_filters( 'wpml_get_element_translations', NULL, $trId, self::NAV_MENU_TAXONOMY_WPML_TYPE );
			$termTranslationsIds = wp_list_pluck( $termTranslations, 'term_id' );
			$newTermIds          = array_merge( $newTermIds, $termTranslationsIds );
		} );

		$newTermIds                   = array_unique( array_merge( $query->terms, $newTermIds ) );
		$query->terms                 = $newTermIds;
		$query->query_vars['include'] = $newTermIds;

		return $query;
	}

	/**
	 * @param mixed $themeLocations
	 *
	 * @return mixed
	 */
	public function translateLocations( $themeLocations ) {
		if ( false === (bool) $themeLocations ) {
			return $themeLocations;
		}
		$language = apply_filters( 'wpml_current_language', null );
		if ( $language ) {
			foreach ( (array) $themeLocations as $location => $menuId ) {
				$themeLocations[ $location ] = apply_filters( 'wpml_object_id', $menuId, self::NAV_MENU_TAXONOMY, true, $language );
			}
		}

		return $themeLocations;
	}

	/**
	 * @param bool   $isPrivate
	 * @param string $modelName
	 * @param mixed  $data
	 *
	 * @return bool
	 */
	public function isPrivate( $isPrivate, $modelName, $data ) {
		if ( self::MODEL_NAME !== $modelName ) {
			return $isPrivate;
		}

		if ( false === $isPrivate ) {
			return $isPrivate;
		}

		$locations = $this->helpers->getMenuLocations();
		if ( empty( $locations ) ) {
			return $isPrivate;
		}

		$locationIds       = array_values( $locations );
		$originalElementId = (int) apply_filters( 'wpml_original_element_id', null, $data->term_id, self::NAV_MENU_TAXONOMY_WPML_TYPE );
		if ( ! in_array( $originalElementId, $locationIds, true ) ) {
			return true;
		}

		return false;
	}

}
