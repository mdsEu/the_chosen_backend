<?php

namespace WPML\GraphQL\Hooks\Query;

use WPML\GraphQL\Helpers;
use WPML\GraphQL\Hooks\ObjectType\LanguageType;
use WPML\LIB\WP\Hooks;
use function WPML\FP\spreadArgs;


class LanguageFilter implements \IWPML_Frontend_Action, \IWPML_DIC_Action {

	const WP_QUERY_SKIP_WPML_FILTERS_ARGUMENT      = 'suppress_wpml_where_and_join_filter';
	const WP_TERM_QUERY_SKIP_WPML_FILTERS_ARGUMENT = 'wpml_skip_filters';
	const WP_COMMENT_QUERY_SKIP_WPML_FILTER        = 'wpml_is_comment_query_filtered';

	/** @var Helpers */
	public $helpers;

	public function __construct( Helpers $helpers ) {
		$this->helpers = $helpers;
	}

	public function add_hooks() {
		$callbacks = [
			'wp_query' => function( &$queryArgs ) {
				$queryArgs[ self::WP_QUERY_SKIP_WPML_FILTERS_ARGUMENT ] = true;
			},
			'get_terms' => function( &$queryArgs ) {
				$queryArgs[ self::WP_TERM_QUERY_SKIP_WPML_FILTERS_ARGUMENT ] = true;
			},
			'wp_comment_query' => function( &$queryArgs ) {
				Hooks::onFilter( self::WP_COMMENT_QUERY_SKIP_WPML_FILTER )->then( '__return_false' );
			},
		];

		foreach ( $callbacks as $filterSuffix => $callbackForAllLanguages ) {
			Hooks::onFilter( 'graphql_map_input_fields_to_' . $filterSuffix, 10, 2 )
			->then( spreadArgs( function( $queryArgs, $whereArgs ) use( $callbackForAllLanguages ) {
				$selectedLanguage = $this->helpers->getArr( LanguageType::FILTER_NAME, $whereArgs );

				if ( is_null( $selectedLanguage ) ) {
					return $queryArgs;
				}

				if ( 'all' === $selectedLanguage ) {
					$callbackForAllLanguages( $queryArgs );
				} else if ( ! $this->helpers->isActiveLanguage( $selectedLanguage ) ) {
					throw new \Exception('Filtering by a non-active language');
				}

				$this->helpers->setCurrentLanguage( $selectedLanguage );

				return $queryArgs;
			} ) );
		}
	}

}
