<?php

namespace WPML\GraphQL\Hooks\Connection\Menu\menuItems;

use WPGraphQL\Data\Connection\MenuItemConnectionResolver;
use WPGraphQL\Model\Menu;
use WPML\GraphQL\Hooks\Connection\Base;
use WPML\GraphQL\Hooks\Query\LanguageFilter;

class MenuItem extends Base {

	const PARENT_TYPE = 'nav_menu';

	/**
	 * @param Menu $menu
	 *
	 * @return string|null
	 */
	private function getParentLanguage( $menu ) {
		if ( ! $menu instanceof Menu ) {
			return null;
		}

		return apply_filters(
			'wpml_element_language_code',
			null,
			[ 'element_id' => $menu->menuId, 'element_type' => self::PARENT_TYPE ]
		);
	}

	/**
	 * @param Menu                                 $menu
	 * @param array<string,mixed>                  $args
	 * @param \WPGraphQL\AppContext                $context
	 * @param \GraphQL\Type\Definition\ResolveInfo $info
	 *
	 * @return \GraphQL\Deferred
	 */
	public function resolveReplacement( $menu, $args, $context, $info ) {
		$originalResolve = $this->originalResolve;

		if ( ! $menu instanceof Menu ) {
			return $originalResolve( $menu, $args, $context, $info );
		}

		$language = $this->getParentLanguage( $menu );
		if ( ! $language ) {
			return $originalResolve( $menu, $args, $context, $info );
		}

		$currentLanguage = $this->helpers->getCurrentLanguage();

		$this->helpers->setCurrentLanguage( $language );

		$resolver = new MenuItemConnectionResolver( $menu, $args, $context, $info );
		$resolver->set_query_arg(
			'tax_query',
			[
				[
					'taxonomy'         => 'nav_menu',
					'field'            => 'term_id',
					'terms'            => (int) $menu->menuId,
					'include_children' => true,
					'operator'         => 'IN',
				],
			]
		);
		$resolver->set_query_arg( LanguageFilter::WP_QUERY_SKIP_WPML_FILTERS_ARGUMENT, true );

		$resolve = $resolver->get_connection();
		$this->helpers->setCurrentLanguage( $currentLanguage );

		return $resolve;
	}

}
