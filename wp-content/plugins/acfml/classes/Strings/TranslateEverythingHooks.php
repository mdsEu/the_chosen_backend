<?php

namespace ACFML\Strings;

use WPML\LIB\WP\Hooks;
use function WPML\FP\spreadArgs;

class TranslateEverythingHooks implements \IWPML_Backend_Action, \IWPML_Frontend_Action {

	public function add_hooks() {
		Hooks::onFilter( 'wpml_get_automatic_packages' )
			->then( spreadArgs( [ $this, 'registerStringPackagesKindSlugs' ] ) );
	}

	/**
	 * @param array $slugs
	 *
	 * @return array
	 */
	public function registerStringPackagesKindSlugs( $slugs ) {
		$kinds = [
			Package::FIELD_GROUP_PACKAGE_KIND_SLUG,
			Package::CPT_PACKAGE_KIND_SLUG,
			Package::TAXONOMY_PACKAGE_KIND_SLUG,
			Package::OPTION_PAGE_PACKAGE_KIND_SLUG,
		];

		if ( ! is_array( $slugs ) ) {
			return $kinds;
		}

		return array_merge( $slugs, $kinds );
	}
}
