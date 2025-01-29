<?php

namespace WPML\GraphQL\Resolvers;

use WPGraphQL\AppContext;
use WPGraphQL\Model\Menu;
use WPGraphQL\Model\Model;
use GraphQL\Type\Definition\ResolveInfo;
use WPML\GraphQL\Resolvers\Interfaces\LanguageFields;
use WPML\GraphQL\Resolvers\Interfaces\ModelFields;

class MenuFields extends BaseFields implements LanguageFields, ModelFields {

	const MODEL_OBJECT      = 'MenuObject';
	const NAV_MENU_TAXONOMY = 'nav_menu';

	/**
	 * Resolve language field
	 *
	 * @param Model       $menu
	 * @param mixed[]     $args
	 * @param AppContext  $context
	 * @param ResolveInfo $info
	 *
	 * @return null|mixed[]
	 */
	public function resolveLanguageField(
		Model $menu,
		$args,
		AppContext $context,
		ResolveInfo $info
	) {
		if ( ! $menu instanceof Menu ) {
			return null;
		}
		$fields = array_keys( $info->getFieldSelection() );

		if ( empty( $fields ) ) {
			return null;
		}

		$languageData = $this->helpers->getElementLanguageData( $menu->menuId, self::NAV_MENU_TAXONOMY );

		if ( ! $languageData ) {
			return null;
		}

		return $this->helpers->filterFields( $languageData, $fields );
	}

	/**
	 * Resolve language code field
	 *
	 * @param Model $menu
	 *
	 * @return null|string
	 */
	public function resolveLanguageCodeField( Model $menu ) {
		if ( ! $menu instanceof Menu ) {
			return null;
		}

		return $this->helpers->getElementLanguageCode( $menu->menuId, self::NAV_MENU_TAXONOMY );
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
			'element_id'   => $data->term_id,
			'element_type' => $data->taxonomy,
		]);

		$fields['locations'] = function() use ( $data, $currentLanguage, $languageCode ) {
			$this->helpers->setCurrentLanguage( $languageCode );

			$menuLocations = $this->helpers->getMenuLocations();
			if ( empty( $menuLocations ) || ! is_array( $menuLocations ) ) {
				return null;
			}

			$locations = [];
			foreach ( $menuLocations as $location => $id ) {
				if ( absint( $id ) === ( $data->term_id ) ) {
					$locations[] = $location;
				}
			}

			$this->helpers->setCurrentLanguage( $currentLanguage );

			if ( empty( $locations ) ) {
				return null;
			}

			return $locations;
		};

		return $fields;
	}

}
