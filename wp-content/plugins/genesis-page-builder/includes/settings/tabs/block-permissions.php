<?php
/**
 * Settings for the Block Permissions tab.
 *
 * @package Genesis\PageBuilder\Settings
 */

namespace Genesis\PageBuilder\Settings;

add_action( 'admin_init', __NAMESPACE__ . '\register_block_permissions_section_and_fields', 30 );
/**
 * Registers setting sections and fields for the Block Permissions tab.
 *
 * @since 1.2.0
 */
function register_block_permissions_section_and_fields() {
	// Registers the general settings tab on the Genesis Blocks admin page.
	add_settings_section(
		'genesis_blocks_settings_block_permissions_section',
		__( 'Block Permissions', 'genesis-page-builder' ),
		null, // Rendering is handled by React, not WordPress.
		'genesis_blocks_global_settings'
	);

	add_settings_field(
		'genesis_blocks_block_permissions_intro',
		__( 'Block Permissions', 'genesis-page-builder' ),
		null, // Rendering is handled by React, not WordPress.
		'genesis_blocks_global_settings',
		'genesis_blocks_settings_block_permissions_section',
		[
			// phpcs:ignore WordPress.WP.I18n.NoHtmlWrappedStrings -- passing to React to render.
			'content' => '<h2>' . __( 'Block Permissions Settings', 'genesis-page-builder' ) . '</h2><p>' . __( 'Choose which Genesis Pro block settings can be controlled by different user roles.', 'genesis-page-builder' ) . ' <a target="_blank" rel="noopener noreferrer" href="https://developer.wpengine.com/genesis-pro/genesis-page-builder/block-permissions/">' . __( 'View Documentation', 'genesis-page-builder' ) . '</a></p>',
			'type'    => 'html',
		]
	);
}

add_action( 'rest_api_init', __NAMESPACE__ . '\\update_block_permissions' );
/**
 * Registers the REST route to update block permission settings.
 *
 * Expects a JSON object holding objects representing block settings and the
 * permission for each role. `true` means the role can access the named setting
 * for that block:
 *
 * {
 *    "genesis-blocks/gb-accordion": {
 *        "gb_accordion_accordionFontSize": {
 *            "administrator": true,
 *            "editor": true,
 *            "author": true,
 *            "contributor": true,
 *            "subscriber": true
 *        }
 *        // More block settings...
 *    }
 *    // More blocks...
 * }
 *
 * @since 1.2.0
 */
function update_block_permissions() {
	\register_rest_route(
		'genesis-page-builder/v1',
		'/block-permissions',
		[
			'methods'             => 'PUT',
			'callback'            => function( $request ) {
				$block_permissions = $request->get_json_params();
				$sanitized         = sanitize_permissions( $block_permissions );

				update_option( 'genesis_page_builder_block_settings_permissions', $sanitized );

				return wp_json_encode( esc_html__( 'option updated', 'genesis-page-builder' ) );
			},
			'permission_callback' => function() {
				return current_user_can( 'manage_options' );
			},
		]
	);
}

/**
 * Sanitizes permissions by casting all to boolean values.
 *
 * @since 1.2.0
 *
 * @param array $blocks Blocks with block settings and permitted roles.
 * @return array Sanitized block permissions.
 */
function sanitize_permissions( $blocks ) {
	if ( ! is_array( $blocks ) ) {
		return [];
	}

	foreach ( $blocks as $block => $settings ) {
		foreach ( $settings as $setting => $permissions ) {
			$blocks[ $block ][ $setting ] = array_map( 'boolval', $blocks[ $block ][ $setting ] );
		}
	}

	return $blocks;
}
