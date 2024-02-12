<?php

namespace WPML\WPSEO\Terms;

use WPML\Element\API\Translations;
use WPML\FP\Fns;
use WPML\FP\Maybe;
use WPML\FP\Obj;
use WPML\LIB\WP\Hooks;
use WPSEO_Taxonomy_Meta;
use function WPML\FP\spreadArgs;

class AdminHooks implements \IWPML_Backend_Action {

	public function add_hooks() {
		Hooks::onAction( 'created_term', 10, 3 )
			->then( spreadArgs( [ $this, 'copyOnceTermMeta' ] ) );
	}

	/**
	 * @param int    $termId
	 * @param int    $ttId
	 * @param string $taxonomy
	 *
	 * @return void
	 */
	public function copyOnceTermMeta( $termId, $ttId, $taxonomy ) {
		$disableTermAdjustId = Fns::always( true );

		add_filter( 'wpml_disable_term_adjust_id', $disableTermAdjustId );

		$wpSeoTaxonomyMeta = WPSEO_Taxonomy_Meta::get_instance();

		// $getTermByElement :: object -> \WP_Term|false
		$getTermByElement = function( $translationElement ) use ( $taxonomy ) {
			return get_term_by( 'term_taxonomy_id', $translationElement->element_id, $taxonomy );
		};

		// $getOriginalMeta :: \WP_Term -> array
		$getOriginalMeta = function( $originalTerm ) use ( $wpSeoTaxonomyMeta, $taxonomy ) {
			return $wpSeoTaxonomyMeta->get_term_meta( $originalTerm, $taxonomy );
		};

		// $filterValuesToCopyOnce :: array -> array
		$filterValuesToCopyOnce = Obj::pick( self::getKeysToCopyOnce() );

		// $setTranslationMeta :: array -> void
		$setTranslationMeta = function( $filteredMeta ) use ( $wpSeoTaxonomyMeta, $termId, $taxonomy ) {
			$wpSeoTaxonomyMeta->set_values( $termId, $taxonomy, $filteredMeta );
		};

		Maybe::fromNullable( Translations::getOriginal( $ttId, "tax_$taxonomy" ) )
			->map( $getTermByElement )
			->map( $getOriginalMeta )
			->map( $filterValuesToCopyOnce )
			->map( $setTranslationMeta );

		remove_filter( 'wpml_disable_term_adjust_id', $disableTermAdjustId );
	}

	/**
	 * @return array
	 */
	private static function getKeysToCopyOnce() {
		$keys = [
			'wpseo_noindex',
			'wpseo_opengraph-image',
			'wpseo_opengraph-image-id',
			'wpseo_twitter-image',
			'wpseo_twitter-image-id',
		];

		/**
		 * Allows to extend the keys to copy once for the Yoast term meta.
		 *
		 * @since 2.1.0
		 *
		 * @param array $keys Default keys to copy once.
		 */
		return (array) apply_filters( 'wpmlseo_yoast_term_meta_keys_to_copy_once', $keys );
	}
}
