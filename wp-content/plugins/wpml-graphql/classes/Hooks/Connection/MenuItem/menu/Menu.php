<?php

namespace WPML\GraphQL\Hooks\Connection\MenuItem\menu;

use WPGraphQL\Data\Connection\MenuConnectionResolver;
use WPGraphQL\Model\MenuItem;
use WPML\GraphQL\Hooks\Connection\Base;

class Menu extends Base {

	const PARENT_TYPE = 'nav_menu_item';

	/**
	 * @param MenuItem $menuItem
	 *
	 * @return string|null
	 */
	private function getParentLanguage( $menuItem ) {
		if ( ! $menuItem instanceof MenuItem ) {
			return null;
		}

		return apply_filters(
			'wpml_element_language_code',
			null,
			[ 'element_id' => $menuItem->menuItemId, 'element_type' => self::PARENT_TYPE ]
		);
	}

	/**
	 * @param MenuItem                             $menuItem
	 * @param array<string,mixed>                  $args
	 * @param \WPGraphQL\AppContext                $context
	 * @param \GraphQL\Type\Definition\ResolveInfo $info
	 *
	 * @return \GraphQL\Deferred
	 */
	public function resolveReplacement( $menuItem, $args, $context, $info ) {
		$originalResolve = $this->originalResolve;

		if ( ! $menuItem instanceof MenuItem ) {
			return $originalResolve( $menuItem, $args, $context, $info );
		}

		$language = $this->getParentLanguage( $menuItem );
		if ( ! $language ) {
			return $originalResolve( $menuItem, $args, $context, $info );
		}

		$currentLanguage = $this->helpers->getCurrentLanguage();

		$this->helpers->setCurrentLanguage( $language );

		$resolver = new MenuConnectionResolver( $menuItem, $args, $context, $info );
		$resolver->set_query_arg( 'include', $menuItem->menuDatabaseId );

		$resolve = $resolver->one_to_one()->get_connection();
		$this->helpers->setCurrentLanguage( $currentLanguage );

		return $resolve;
	}

}
