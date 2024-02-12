<?php
/**
 * Genesis Blocks Homepage layout for Altitude Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_altitude_layout_homepage',
	'collection' => [
		'slug'                   => 'altitude',
		'label'                  => esc_html__( 'Altitude', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_altitude_section_hero_header',
		'gpb_altitude_section_website_preview',
		'gpb_altitude_section_features_dark',
		'gpb_altitude_section_pricing_table',
		'gpb_altitude_section_image_quote',
		'gpb_altitude_section_frequently_asked',
		'gpb_altitude_section_call_to_action',
	],
	'name'       => esc_html__( 'Altitude Homepage', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'testimonial', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'homepage', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'landing page', 'genesis-page-builder' ),
		esc_html__( 'altitude', 'genesis-page-builder' ),
		esc_html__( 'altitude homepage', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/altitude/gpb_altitude_layout_homepage.jpg',
];
