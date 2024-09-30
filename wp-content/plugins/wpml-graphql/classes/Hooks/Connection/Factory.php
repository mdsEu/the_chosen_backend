<?php

namespace WPML\GraphQL\Hooks\Connection;

use WPML\FP\Obj;
use WPML\LIB\WP\Hooks;
use function WPML\FP\spreadArgs;
use WPML\GraphQL\Helpers;

class Factory implements \IWPML_Frontend_Action, \IWPML_DIC_Action {

	/** @var Helpers */
	public $helpers;

	/** @var array|null */
	private $graphQLPostTypes;

	/** @var array|null */
	private $graphQLTaxonomies;

	public function __construct( Helpers $helpers ) {
		$this->helpers = $helpers;
	}

	public function add_hooks() {
		Hooks::onFilter( 'graphql_wp_connection_type_config' )
			->then( spreadArgs( [ $this, 'applyConnectionLanguage' ] ) );
	}

	/**
	 * @return array
	 */
	private function getGraphQLPostTypes() {
		if ( null === $this->graphQLPostTypes ) {
			$this->graphQLPostTypes = [];
			$allowedObjects         = $this->helpers->getGraphqlAllowedPostTypes();
			foreach ( $allowedObjects as $objectType ) {
				$this->graphQLPostTypes[ $objectType->graphql_single_name ] = [
					'single' => $objectType->graphql_single_name,
					'plural' => $objectType->graphql_plural_name,
					'name'   => $objectType->name,
				];
			}
		}
		return $this->graphQLPostTypes;
	}

	/**
	 * @return array
	 */
	private function getConnectionPostTypes() {
		$graphQLObjects = $this->getGraphQLPostTypes();
		return array_map( 'ucfirst', array_keys( $graphQLObjects ) );
	}

	/**
	 * @return array
	 */
	private function getGraphQLTaxonomies() {
		if ( null === $this->graphQLTaxonomies ) {
			$this->graphQLTaxonomies = [];
			$allowedObjects         = $this->helpers->getGraphqlAllowedTaxonomies();
			foreach ( $allowedObjects as $objectType ) {
				$this->graphQLTaxonomies[ $objectType->graphql_single_name ] = [
					'single' => $objectType->graphql_single_name,
					'plural' => $objectType->graphql_plural_name,
					'name'   => $objectType->name,
				];
			}
		}
		return $this->graphQLTaxonomies;
	}

	/**
	 * @return array
	 */
	private function getConnectionTaxonomies() {
		$graphQLObjects = $this->getGraphQLTaxonomies();
		return array_map( 'ucfirst', array_keys( $graphQLObjects ) );
	}

	/**
	 * @param array $config
	 *
	 * @return array
	 */
	public function applyConnectionLanguage( $config ) {
		$fromType      = $this->helpers->getArr( 'fromType', $config );
		$fromFieldName = $this->helpers->getArr( 'fromFieldName', $config );
		$toType        = $this->helpers->getArr( 'toType', $config );

		$connectionClass = sprintf(
			'\%s\%s\%s\%s',
			__NAMESPACE__,
			$fromType,
			$fromFieldName,
			$toType
		);

		if ( class_exists( $connectionClass ) ) {
			$originalResolve   = $config['resolve'];
			$connection        = new $connectionClass( $this->helpers, $originalResolve );
			$config['resolve'] = [ $connection, 'resolveReplacement' ];
			return $config;
		}

		$graphQLTaxonomies   = $this->getGraphQLTaxonomies();
		$connectionPostTypes = $this->getConnectionPostTypes();

		if (
			$fromFieldName === Obj::path( [ $toType, 'plural' ], $graphQLTaxonomies )
			&& in_array( $fromType, $connectionPostTypes, true )
		) {
			$originalResolve   = $config['resolve'];
			$connection        = new \WPML\GraphQL\Hooks\Connection\PostType\terms\Taxonomy( $this->helpers, $originalResolve, Obj::path( [ $toType, 'name' ], $graphQLTaxonomies ) );
			$config['resolve'] = [ $connection, 'resolveReplacement' ];
			return $config;
		}

		if (
			'comments' === $fromFieldName
			&& 'Comment' === $toType
			&& in_array( $fromType, $connectionPostTypes, true )
		) {
			$originalResolve   = $config['resolve'];
			$connection        = new \WPML\GraphQL\Hooks\Connection\PostType\comments\Comment( $this->helpers, $originalResolve, Obj::path( [ $toType, 'name' ], $graphQLTaxonomies ) );
			$config['resolve'] = [ $connection, 'resolveReplacement' ];
			return $config;
		}

		$graphQLPostTypes     = $this->getGraphQLPostTypes();
		$connectionTaxonomies = $this->getConnectionTaxonomies();

		if (
			$fromFieldName === Obj::path( [ $toType, 'plural' ], $graphQLPostTypes )
			&& in_array( $fromType, $connectionTaxonomies, true )
		) {
			$originalResolve   = $config['resolve'];
			$connection        = new \WPML\GraphQL\Hooks\Connection\Taxonomy\assignedTo\PostType( $this->helpers, $originalResolve, Obj::path( [ $toType, 'name' ], $graphQLPostTypes ) );
			$config['resolve'] = [ $connection, 'resolveReplacement' ];
			return $config;
		}

		return $config;
	}

}
