<?php
/**
 * Plugin Name: WPML GraphQL
 * Description: Enables WPML support for WPGraphQL
 * Author: OnTheGoSystems
 * Author URI: http://www.onthegosystems.com
 * Version: 1.0.0
 * Plugin Slug: wpml-graphql
 *
 * @package wpml/graphql
 */

if ( defined( 'WPML_GRAPHQL_VERSION' ) ) {
	return;
}

define( 'WPML_GRAPHQL_VERSION', '1.0.0' );
define( 'WPML_GRAPHQL_PATH', __DIR__ );
define( 'WPML_GRAPHQL_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );

if ( ! class_exists( 'WPML_Core_Version_Check' ) ) {
	require_once WPML_GRAPHQL_PATH . '/vendor/wpml-shared/wpml-lib-dependencies/src/dependencies/class-wpml-core-version-check.php';
}

if ( ! WPML_Core_Version_Check::is_ok( WPML_GRAPHQL_PATH . '/wpml-dependencies.json' ) ) {
	return;
}

require_once WPML_GRAPHQL_PATH . '/vendor/autoload.php';

add_action( 'wpml_loaded', 'wpmlGraphqlLoader' );

function wpmlGraphqlLoader() {
	if ( ! class_exists( 'WPGraphQL' ) ) {
		return;
	}

	$actions_filters_loader = new \WPML_Action_Filter_Loader();
	$actions_filters_loader->load( [ \WPML\GraphQL\Loader::class ] );
}
