<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://developers.wpengine.com/
 * @since             1.0.0
 * @package           Wpe_Content_Engine
 *
 * @wordpress-plugin
 * Plugin Name:       Atlas Search
 * Plugin URI:        https://developers.wpengine.com/
 * Description:       Searching WordPress data with Atlas Search.
 * Version:           0.2.13
 * Author:            WP Engine
 * Author URI:        https://wpengine.com/
 * Requires at least: 5.7
 * Requires PHP:      7.4
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       atlas-search
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
use Wpe_Content_Engine\WPSettings;
use Wpe_Content_Engine\Helper\Sync\GraphQL;

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ATLAS_SEARCH_VERSION', '0.2.13' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpe-content-engine-activator.php
 */
function activate_wpe_content_engine() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpe-content-engine-activator.php';
	Wpe_Content_Engine_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpe-content-engine-deactivator.php
 */
function deactivate_wpe_content_engine() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpe-content-engine-deactivator.php';
	Wpe_Content_Engine_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpe_content_engine' );
register_deactivation_hook( __FILE__, 'deactivate_wpe_content_engine' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpe-content-engine.php';

// Path definitions for the atlas search settings page.
define( 'ATLAS_SEARCH_SETTINGS_PAGE_PATH', plugin_dir_path( __FILE__ ) . '/includes/atlas-search-settings/' );
define( 'ATLAS_SEARCH_ASSET_MANIFEST', ATLAS_SEARCH_SETTINGS_PAGE_PATH . '/build/asset-manifest.json' );

require_once ATLAS_SEARCH_SETTINGS_PAGE_PATH . 'settings-callbacks.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpe_content_engine() {
	require_once plugin_dir_path( __FILE__ ) . 'settings-interface.php';
	require_once plugin_dir_path( __FILE__ ) . 'wp-settings.php';
	require_once plugin_dir_path( __FILE__ ) . '/helper/client-interface.php';
	require_once plugin_dir_path( __FILE__ ) . '/helper/sync/graphql/client.php';

	$client = new GraphQL\Client( Wpe_Content_Engine::get_plugin_name(), Wpe_Content_Engine::get_version() );
	$plugin = new Wpe_Content_Engine( new WPSettings(), $client );
	$plugin->run();
}

run_wpe_content_engine();
