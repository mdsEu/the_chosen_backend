<?php
/**
 * Genesis Blocks Pricing layout for Altitude Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_altitude_layout_pricing',
	'collection' => [
		'slug'                   => 'altitude',
		'label'                  => esc_html__( 'Altitude', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_altitude_section_pricing_table',
		'gpb_altitude_section_frequently_asked',
		'gpb_altitude_section_product_video',
		'gpb_altitude_section_colorful_quote',
		'gpb_altitude_section_features_light',
	],
	'name'       => esc_html__( 'Altitude Pricing', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'pricing', 'genesis-page-builder' ),
		esc_html__( 'pricing table', 'genesis-page-builder' ),
		esc_html__( 'testimonial', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'altitude', 'genesis-page-builder' ),
		esc_html__( 'altitude pricing', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/altitude/gpb_altitude_layout_pricing.jpg',
];
