<?php

namespace WPML\GraphQL\Hooks;

use WPML\LIB\WP\Hooks;
use function WPML\FP\spreadArgs;

class Modifiers implements \IWPML_Frontend_Action {

	public function add_hooks() {
		Hooks::onFilter( 'wpml_is_redirected' )
			->then( spreadArgs( function( $is_redirect ) {
				if ( is_graphql_request() ) {
					return false;
				}
				return $is_redirect;
			} ) );

		Hooks::onFilter( 'wpml_disable_term_adjust_id' )
			->then( spreadArgs( function( $state ) {
				if ( is_graphql_request() ) {
					return true;
				}
				return $state;
			} ) );

		Hooks::onFilter( 'wpml_pre_parse_query' )
			->then( spreadArgs( function( $query ) {
				if ( is_graphql_request() ) {
					$clonedQuery = clone $query;
					return $clonedQuery;
				}
				return $query;
			} ) );
	}

}
