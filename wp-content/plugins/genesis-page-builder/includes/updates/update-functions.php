<?php
/**
 * Handles communicating with the WPE product update API
 * and saving the data for WordPress to use for plugin updates.
 *
 * @package Genesis\PageBuilder\PluginUpdates
 */

namespace Genesis\PageBuilder\PluginUpdates;

use stdClass;
use function Genesis\PageBuilder\main_plugin_file;

defined( 'WPINC' || die );

add_filter( 'pre_set_site_transient_update_plugins', __NAMESPACE__ . '\check_for_updates' );
/**
 * Checks the WPE plugin info API for new versions of the plugin
 * and returns the data required to update this plugin.
 *
 * @param object $data WordPress update object.
 *
 * @return object $data An updated object if an update exists, default object if not.
 */
function check_for_updates( $data ) {

	// No update object exists. Return early.
	if ( empty( $data ) ) {
		return $data;
	}

	$response = get_product_info();

	if ( empty( $response->requires_at_least ) || empty( $response->stable_tag ) ) {
		return $data;
	}

	$current_plugin_data = get_plugin_data( main_plugin_file() );
	$meets_wp_req        = version_compare( get_bloginfo( 'version' ), $response->requires_at_least, '>=' );

	// Only update the response if there's a newer version, otherwise WP shows an update notice for the same version.
	if ( $meets_wp_req && version_compare( $current_plugin_data['Version'], $response->stable_tag, '<' ) ) {
		$response->plugin                                        = plugin_basename( main_plugin_file() );
		$data->response[ plugin_basename( main_plugin_file() ) ] = $response;
	}

	return $data;
}

add_action( 'add_option_genesis_pro_subscription_key', __NAMESPACE__ . '\validate_subscription_key' );
add_action( 'update_option_genesis_pro_subscription_key', __NAMESPACE__ . '\validate_subscription_key' );
/**
 * Gets a new validation result for the subscription key, and stores it.
 *
 * @param string $option_name The option name being created or changed.
 */
function validate_subscription_key( $option_name ) {
	unset( $option_name );

	// So get_plugin_data() is always defined.
	include_once ABSPATH . 'wp-admin/includes/plugin.php';

	delete_transient( 'genesis_page_builder_product_info' );
	get_product_info();
}

add_filter( 'plugins_api', __NAMESPACE__ . '\custom_plugins_api', 10, 3 );
/**
 * Returns a custom API response for updating the plugin
 * and for displaying information about it in wp-admin.
 *
 * The `plugins_api` filter is documented in `wp-admin/includes/plugin-install.php`.
 *
 * @param false|object|array $api The result object or array. Default false.
 * @param string             $action The type of information being requested from the Plugin Installation API.
 * @param object             $args Plugin API arguments.
 *
 * @return false|stdClass $api Plugin API arguments.
 */
function custom_plugins_api( $api, $action, $args ) {

	if ( empty( $args->slug ) || $args->slug !== dirname( plugin_basename( main_plugin_file() ) ) ) {
		return $api;
	}

	/**
	 * Information from the product info service API.
	 *
	 * @var stdClass $product_info
	 */
	$product_info = get_product_info();

	if ( empty( $product_info ) || is_wp_error( $product_info ) ) {
		return $api;
	}

	$current_plugin_data = get_plugin_data( main_plugin_file() );
	$meets_wp_req        = version_compare( get_bloginfo( 'version' ), $product_info->requires_at_least, '>=' );

	$api                        = new stdClass();
	$api->author                = 'Genesis Blocks Pro';
	$api->homepage              = 'https://studiopress.com';
	$api->name                  = $product_info->name;
	$api->requires              = isset( $product_info->requires_at_least ) ? $product_info->requires_at_least : $current_plugin_data['RequiresWP'];
	$api->sections['changelog'] = isset( $product_info->sections->changelog ) ? $product_info->sections->changelog : '<h4>1.0</h4><ul><li>Initial release.</li></ul>';
	$api->slug                  = $args->slug;

	// Only pass along the update info if the requirements are met and there's actually a newer version.
	if ( $meets_wp_req && version_compare( $current_plugin_data['Version'], $product_info->stable_tag, '<' ) ) {
		$api->version       = $product_info->stable_tag;
		$api->download_link = $product_info->download_link;
	}

	return $api;
}

/**
 * Fetches and returns the plugin info from the WPE product info API.
 *
 * @return stdClass
 */
function get_product_info() {
	$option_name_api_error       = 'genesis_page_builder_product_info_api_error';
	$transient_name_product_info = 'genesis_page_builder_product_info';
	$current_plugin_data         = get_plugin_data( main_plugin_file() );

	// Check for a cached response before making an API call.
	$response = get_transient( $transient_name_product_info );

	if ( false === $response ) {

		$request_args = [
			'timeout'    => ( ( defined( 'DOING_CRON' ) && DOING_CRON ) ? 30 : 3 ),
			'user-agent' => 'WordPress/' . get_bloginfo( 'version' ) . '; ' . get_bloginfo( 'url' ),
			'body'       => [
				'version' => $current_plugin_data['Version'],
			],
		];

		$sub_key  = sanitize_key( get_option( 'genesis_pro_subscription_key', '' ) );
		$response = wp_remote_get( "https://wp-product-info.wpesvc.net/v1/plugins/genesis-page-builder/subscriptions/{$sub_key}", $request_args );

		if ( empty( $sub_key ) ) {
			update_option( $option_name_api_error, 'no-key', false );
			$response = new stdClass();
			set_transient( $transient_name_product_info, $response, MINUTE_IN_SECONDS * 5 );
			return $response;
		}

		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

			// Save the error code so we can use it elsewhere to display messages.
			if ( is_wp_error( $response ) ) {
				update_option( $option_name_api_error, $response->get_error_code(), false );
			} else {
				$response_body = json_decode( wp_remote_retrieve_body( $response ), false );
				$error_code    = ! empty( $response_body->error_code ) ? $response_body->error_code : 'unknown';
				update_option( $option_name_api_error, $error_code, false );
			}

			// Cache an empty object for 5 minutes to give the product info API time to recover.
			$response = new stdClass();

			set_transient( $transient_name_product_info, $response, MINUTE_IN_SECONDS * 5 );

			return $response;
		}

		// Delete any existing API error codes since we have a valid API response.
		delete_option( $option_name_api_error );

		$response = json_decode( wp_remote_retrieve_body( $response ) );

		$response->name = isset( $response->name ) ? $response->name : 'Genesis Blocks Pro';

		$response->stable_tag = isset( $response->stable_tag ) ? $response->stable_tag : $current_plugin_data['Version'];

		$response->new_version = $response->stable_tag;

		$response->download_link = isset( $response->download_link ) ? $response->download_link : '';

		$response->package = $response->download_link;

		$response->slug = 'genesis-page-builder';

		// Cache the response for 12 hours.
		set_transient( $transient_name_product_info, $response, HOUR_IN_SECONDS * 12 );
	}

	return $response;
}

/**
 * Checks for plugin update API errors and shows
 * a message on the Plugins page if errors exist.
 */
add_action(
	'load-plugins.php',
	function() {

		if ( empty( get_option( 'genesis_page_builder_product_info_api_error', false ) ) ) {
			return;
		}

		add_action(
			'admin_notices',
			function() {
				$plugin_basename = plugin_basename( \Genesis\PageBuilder\main_plugin_file() );
				remove_action( "after_plugin_row_{$plugin_basename}", 'wp_plugin_update_row' );
				add_action( "after_plugin_row_{$plugin_basename}", __NAMESPACE__ . '\show_plugin_row_notice', 10, 2 );
			}
		);
	},
	0
);

/**
 * Checks for plugin update API errors and shows
 * a message on the Dashboard > Updates page if errors exist.
 */
add_action(
	'load-update-core.php',
	function() {
		$api_error = get_option( 'genesis_page_builder_product_info_api_error', false );
		if ( empty( $api_error ) ) {
			return;
		}

		add_action(
			'admin_notices',
			function() use ( $api_error ) {
				echo wp_kses_post( sprintf( '<div class="error"><p>%s</p></div>', api_error_notice_text( $api_error ) ) );
			}
		);
	},
	0
);

/**
 * Shows a notice on the Plugins page when there is an
 * issue with the subscription key and/or update service.
 *
 * @param string $plugin_file Path to the plugin file relative to the plugins directory.
 * @param array  $plugin_data An array of plugin data.
 */
function show_plugin_row_notice( $plugin_file, $plugin_data ) {

	$api_error = get_option( 'genesis_page_builder_product_info_api_error', false );

	if ( empty( $api_error ) ) {
		return;
	}

	echo '<tr class="plugin-update-tr active" id="genesis-page-builder-update" data-slug="genesis-page-builder" data-plugin="genesis-page-builder/genesis-page-builder.php">';
	echo '<td colspan="3" class="plugin-update">';
	echo '<div class="update-message notice inline notice-error notice-alt"><p>' . wp_kses_post( api_error_notice_text( $api_error ) ) . '</p></div>';
	echo '</td>';
	echo '</tr>';
}

/**
 * Returns the text to be displayed to the user based on the
 * error code received from the Product Info Service API.
 *
 * @param string $reason The reason/error code received the API.
 *
 * @return string
 */
function api_error_notice_text( $reason ) {

	switch ( $reason ) {
		case 'key-unknown':
			/* translators: %1$s: Link to account portal. %2$s: The text that is linked. */
			return sprintf( __( 'The subscription key you entered in the Genesis Pro settings appears to be invalid or is not associated with this product. Please verify the key you have saved there matches the key in your <a href="%1$s" target="_blank" rel="noreferrer noopener">%2$s</a>.', 'genesis-page-builder' ), 'https://my.wpengine.com/products/genesis_pro', esc_html__( 'WP Engine Account Portal', 'genesis-page-builder' ) );

		case 'key-invalid':
			/* translators: %1$s: Link to account portal. %2$s: The text that is linked. */
			return sprintf( __( 'The subscription key you entered in the Genesis Pro settings is invalid. Get your subscription key in the <a href="%1$s" target="_blank" rel="noreferrer noopener">%2$s</a>.', 'genesis-page-builder' ), 'https://my.wpengine.com/products/genesis_pro', esc_html__( 'WP Engine Account Portal', 'genesis-page-builder' ) );

		case 'key-deleted':
			/* translators: %1$s: Link to account portal. %2$s: The text that is linked. */
			return sprintf( __( 'Your subscription key was regenerated in the <a href="%1$s" target="_blank" rel="noreferrer noopener">%2$s</a> but was not updated in the Genesis Pro settings page. Update your subscription key in the Genesis Pro settings to receive updates.', 'genesis-page-builder' ), 'https://my.wpengine.com/products/genesis_pro', esc_html__( 'WP Engine Account Portal', 'genesis-page-builder' ) );

		case 'no-key':
			return sprintf(
				/* translators: %1$s: Link to the settings page. %2$s: The settings page text that is linked. */
				__( 'There is no Genesis Pro subscription key entered. To get updates and the latest features, please enter your subscription key in the <a href="%1$s" target="_blank" rel="noreferrer noopener">%2$s</a>.', 'genesis-page-builder' ),
				esc_url(
					admin_url(
						add_query_arg(
							[ 'page' => 'genesis-blocks-settings' ],
							'admin.php'
						)
					)
				),
				esc_html__( 'Genesis Blocks settings', 'genesis-page-builder' )
			);

		case 'subscription-expired':
			/* translators: %1$s: Link to account portal. %2$s: The text that is linked. */
			return sprintf( __( 'Your Genesis Pro subscription has expired. <a href="%1$s" target="_blank" rel="noreferrer noopener">%2$s</a> now.', 'genesis-page-builder' ), 'https://my.wpengine.com/modify_plan', esc_html__( 'Renew', 'genesis-page-builder' ) );

		case 'subscription-notfound':
			return __( 'A valid subscription for your subscription key was not found. Please contact support.', 'genesis-page-builder' );

		case 'product-unknown':
			return __( 'The product you requested information for is unknown. Please contact support.', 'genesis-page-builder' );

		default:
			/* translators: %1$s: Link to account portal. %2$s: The text that is linked. */
			return sprintf( __( 'There was an unknown error connecting to the update service. Please ensure the key you have saved in the Genesis Pro settings page matches the key in your <a href="%1$s" target="_blank" rel="noreferrer noopener">%2$s</a>. This issue could be temporary. Please contact support if this error persists.', 'genesis-page-builder' ), 'https://my.wpengine.com/products/genesis_pro', esc_html__( 'WP Engine Account Portal', 'genesis-page-builder' ) );
	}
}
