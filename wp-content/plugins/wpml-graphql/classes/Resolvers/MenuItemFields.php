<?php

namespace WPML\GraphQL\Resolvers;

use WPGraphQL\AppContext;
use WPGraphQL\Model\MenuItem;
use WPGraphQL\Model\Model;
use GraphQL\Type\Definition\ResolveInfo;
use WPML\GraphQL\Resolvers\Interfaces\LanguageFields;
use WPML\GraphQL\Resolvers\Interfaces\ModelFields;

class MenuItemFields extends BaseFields implements LanguageFields, ModelFields {

	const MODEL_OBJECT            = 'MenuItemObject';
	const NAV_MENU_TAXONOMY       = 'nav_menu';
	const NAV_MENU_ITEM_POST_TYPE = 'nav_menu_item';

	/**
	 * Resolve language field
	 *
	 * @param Model       $menuItem
	 * @param mixed[]     $args
	 * @param AppContext  $context
	 * @param ResolveInfo $info
	 *
	 * @return null|mixed[]
	 */
	public function resolveLanguageField(
		Model $menuItem,
		$args,
		AppContext $context,
		ResolveInfo $info
	) {
		if ( ! $menuItem instanceof MenuItem ) {
			return null;
		}
		$fields = array_keys( $info->getFieldSelection() );

		if ( empty( $fields ) ) {
			return null;
		}

		$languageData = $this->helpers->getElementLanguageData( $menuItem->databaseId, self::NAV_MENU_ITEM_POST_TYPE );

		if ( ! $languageData ) {
			return null;
		}

		return $this->helpers->filterFields( $languageData, $fields );
	}

	/**
	 * Resolve language code field
	 *
	 * @param Model $menuItem
	 *
	 * @return null|string
	 */
	public function resolveLanguageCodeField( Model $menuItem ) {
		if ( ! $menuItem instanceof MenuItem ) {
			return null;
		}

		return $this->helpers->getElementLanguageCode( $menuItem->databaseId, self::NAV_MENU_ITEM_POST_TYPE );
	}

	/**
	 * @param mixed[]              $fields
	 * @param string               $modelName
	 * @param mixed[]|object|mixed $data
	 *
	 * @return mixed[]
	 */
	public function adjustModelFields( $fields, $modelName, $data ) {
		if ( self::MODEL_OBJECT !== $modelName ) {
			return $fields;
		}

		$currentLanguage = $this->helpers->getCurrentLanguage();
		$languageCode    = apply_filters( 'wpml_element_language_code', null, [
			'element_id'   => $data->ID,
			'element_type' => $data->post_type,
		]);

		$fields['locations'] = function() use ( $data, $currentLanguage, $languageCode ) {
			$this->helpers->setCurrentLanguage( $languageCode );

			$menus = wp_get_object_terms( $data->ID, self::NAV_MENU_TAXONOMY );
			if ( is_wp_error( $menus ) ) {
				throw new \Exception( esc_html( $menus->get_error_message() ) );
			}

			$menuDatabaseId = ! empty( $menus[0]->term_id ) ? $menus[0]->term_id : null;

			if ( ! $menuDatabaseId ) {
				return null;
			}

			$menuLocations = $this->helpers->getMenuLocations();
			if ( empty( $menuLocations ) || ! is_array( $menuLocations ) ) {
				return null;
			}

			$locations = [];
			foreach ( $menuLocations as $location => $id ) {
				if ( absint( $id ) === ( $menuDatabaseId ) ) {
					$locations[] = $location;
				}
			}

			$this->helpers->setCurrentLanguage( $currentLanguage );

			if ( empty( $locations ) ) {
				return null;
			}

			return $locations;
		};

		$fields['uri'] = function() use ( $data, $currentLanguage, $languageCode ) {
			$this->helpers->setCurrentLanguage( $languageCode );

			if ( 'post_type' === $data->type ) {
				$link = get_permalink( $data->object_id );
			} else {
				$link = $data->url;
			}

			$uri = ! empty( $link ) ? str_ireplace( home_url(), '', $link ) : null;

			$this->helpers->setCurrentLanguage( $currentLanguage );

			return $uri;
		};

		$fields['url'] = function() use ( $data, $currentLanguage, $languageCode ) {
			$this->helpers->setCurrentLanguage( $languageCode );

			if ( 'post_type' === $data->type ) {
				$link = get_permalink( $data->object_id );
			} else {
				return $data->url;
			}

			$this->helpers->setCurrentLanguage( $currentLanguage );

			return $link ?: null;
		};

		return $fields;
	}

}
