<?php

namespace WPML\GraphQL\Hooks\ObjectEntity;

use WPGraphQL\Data\Connection\AbstractConnectionResolver;
use WPGraphQL\Data\Connection\MenuItemConnectionResolver;
use WPML\GraphQL\Helpers;
use WPML\GraphQL\Hooks\Query\LanguageFilter;
use WPML\GraphQL\Resolvers\MenuItemFields;
use WPML\LIB\WP\Hooks;
use function WPML\FP\spreadArgs;

class MenuItemObject extends BaseObject {

	const OBJECT_TYPE = 'MenuItem';
	const MODEL_NAME  = 'MenuItemObject';

	const NAV_MENU_TAXONOMY           = 'nav_menu';
	const NAV_MENU_TAXONOMY_WPML_TYPE = 'tax_nav_menu';
	const NAV_MENU_ITEM_POST_TYPE     = 'nav_menu_item';

	// phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
	public function __construct(
		MenuItemFields $fieldsResolver,
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

		Hooks::onFilter( 'graphql_connection_pre_get_query', 10, 2 )
			->then( spreadArgs( [ $this, 'maybeReplaceQuery' ] ) );

		Hooks::onFilter( 'graphql_data_is_private', 10, 3 )
			->then( spreadArgs( [ $this, 'isPrivate' ] ) );
	}

	/**
	 * @param null                       $outcome
	 * @param AbstractConnectionResolver $connectionResolver
	 *
	 * @return \WP_Query|null
	 */
	public function maybeReplaceQuery( $outcome, $connectionResolver ) {
		if ( ! $connectionResolver instanceof MenuItemConnectionResolver ) {
			return $outcome;
		}

		$queryArgs  = $connectionResolver->get_query_args();
		$postTypes  = $this->helpers->getArr( 'post_type', $queryArgs );
		$taxQueries = $this->helpers->getArr( 'tax_query', $queryArgs );

		if ( 'all' !== $this->helpers->getArr( 'language', $queryArgs ) ) {
			return $outcome;
		}
		if ( ! is_array( $postTypes ) || ! is_array( $taxQueries ) ) {
			return $outcome;
		}
		if ( ! in_array( self::NAV_MENU_ITEM_POST_TYPE, $postTypes, true ) ) {
			return $outcome;
		}

		$navMenuTaxQueries = array_filter( $taxQueries, function( $taxQueryArgs ) {
			return (
				self::NAV_MENU_TAXONOMY === $this->helpers->getArr( 'taxonomy', $taxQueryArgs )
				&& 'term_id' === $this->helpers->getArr( 'field', $taxQueryArgs )
				&& false === $this->helpers->getArr( 'include_children', $taxQueryArgs )
				&& 'IN' === $this->helpers->getArr( 'operator', $taxQueryArgs )
				&& is_array( $this->helpers->getArr( 'terms', $taxQueryArgs ) )
				&& ! empty( $this->helpers->getArr( 'terms', $taxQueryArgs ) )
			);
		} );

		foreach ( $navMenuTaxQueries as $menuQueryIndex => $menuQueryArgs ) {
			$locations    = $this->helpers->getArr( 'terms', $menuQueryArgs );
			$newLocations = [];

			array_walk( $locations, function( $termId, $termIdKey ) use ( &$newLocations ) {
				$trId                = apply_filters( 'wpml_element_trid', null, $termId, self::NAV_MENU_TAXONOMY_WPML_TYPE );
				$termTranslations    = apply_filters( 'wpml_get_element_translations', NULL, $trId, self::NAV_MENU_TAXONOMY_WPML_TYPE );
				$termTranslationsIds = wp_list_pluck( $termTranslations, 'term_id' );
				$newLocations        = array_merge( $newLocations, $termTranslationsIds );
			} );

			$newLocations                                       = array_unique( array_merge( $locations, $newLocations ) );
			$queryArgs['tax_query'][ $menuQueryIndex ]['terms'] = $newLocations;
		}

		/**
		 * @param array $args
		 *
		 * @return array
		 */
		$skipFiltersInTaxQuery = function( $args ) {
			$args[ LanguageFilter::WP_TERM_QUERY_SKIP_WPML_FILTERS_ARGUMENT ] = true;
			return $args;
		};

		add_filter( 'get_terms_args', $skipFiltersInTaxQuery, 1 );
		$outcome = new \WP_Query( $queryArgs );
		remove_filter( 'get_terms_args', $skipFiltersInTaxQuery, 1 );

		return $outcome;
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

		$menus = wp_get_object_terms( $data->ID, self::NAV_MENU_TAXONOMY, [ 'fields' => 'ids' ] );
		if ( empty( $menus ) ) {
			return $isPrivate;
		}
		if ( is_wp_error( $menus ) ) {
			throw new \Exception( esc_html( sprintf( __( 'No menus could be found for menu item %s', 'wp-graphql' ), $data->ID ) ) );
		}

		$locations = $this->helpers->getMenuLocations();
		if ( empty( $locations ) ) {
			return $isPrivate;
		}

		$locationIds    = array_values( $locations );
		$originalMenuId = (int) apply_filters(
			'wpml_original_element_id',
			null,
			$menus[0],
			self::NAV_MENU_TAXONOMY_WPML_TYPE
		);

		if ( ! in_array( $originalMenuId, $locationIds, true ) ) {
			return true;
		}

		return false;
	}

}
