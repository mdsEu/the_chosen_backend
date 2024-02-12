<?php

namespace WPML\WPSEO\PrimaryCategory;

class Hooks implements \IWPML_Frontend_Action, \IWPML_Backend_Action {

	const META_KEYS_MAPPING = [
		'_yoast_wpseo_primary_category'    => 'category',
		'_yoast_wpseo_primary_product_cat' => 'product_cat',
	];

	/**
	 * Add hooks.
	 */
	public function add_hooks() {
		add_filter( 'get_post_metadata', [ $this, 'translateTermId' ], 20, 4 );
	}

	/**
	 * Removes hooks (to avoid loops).
	 */
	public function remove_hooks() {
		remove_filter( 'get_post_metadata', [ $this, 'translateTermId' ], 20 );
	}

	/**
	 * Translates the primary category ID.
	 *
	 * @param string $value
	 * @param int    $postId
	 * @param string $key
	 * @param bool   $single
	 *
	 * @return Indexable
	 */
	public function translateTermId( $value, $postId, $key, $single ) {
		if ( in_array( $key, array_keys( self::META_KEYS_MAPPING ), true ) ) {
			$this->remove_hooks();
			$value = get_post_meta( $postId, $key, true );
			$this->add_hooks();

			$args     = [
				'element_id'   => $postId,
				'element_type' => get_post_type( $postId ),
			];
			$language = apply_filters( 'wpml_element_language_code', false, $args );
			$value    = apply_filters( 'wpml_object_id', $value, self::META_KEYS_MAPPING[ $key ], true, $language );

			if ( ! $single ) {
				$value = [ $value ];
			}
		}

		return $value;
	}
}
