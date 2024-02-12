<?php
/**
 * Settings for the General Settings tab.
 *
 * @package Genesis\PageBuilder\Settings
 */

namespace Genesis\PageBuilder\Settings;

add_action( 'init', __NAMESPACE__ . '\register_general_settings' );
/**
 * Registers the General Settings.
 *
 * @since 1.2.0
 */
function register_general_settings() {
	register_setting(
		'genesis_blocks_global_settings',
		'genesis_pro_subscription_key',
		[
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_key',
			'show_in_rest'      => true,
			'default'           => '',
		]
	);
}

add_action( 'admin_init', __NAMESPACE__ . '\register_general_section_and_fields', 2 );
/**
 * Registers the General Settings tab and fields.
 *
 * @since 1.2.0
 */
function register_general_section_and_fields() {
	add_settings_section(
		'genesis_blocks_settings_general_section',
		__( 'General', 'genesis-page-builder' ),
		null, // Rendering is handled by React, not WordPress.
		'genesis_blocks_global_settings'
	);

	// Adds the Subscription Key field.
	add_settings_field(
		'genesis_pro_subscription_key',
		__( 'Subscription Key', 'genesis-page-builder' ),
		null, // Rendering is handled by React, not WordPress.
		'genesis_blocks_global_settings',
		'genesis_blocks_settings_general_section',
		[
			'help' => __( 'Your subscription key is used to check for updates to Genesis Pro. Find it in your Genesis Pro account.', 'genesis-page-builder' ),
			'type' => 'text',
		]
	);
}
