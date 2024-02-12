<?php
/**
 * Genesis Blocks Homepage Alternative layout for Altitude Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_altitude_layout_homepage_alternative',
	'collection' => [
		'slug'                   => 'altitude',
		'label'                  => esc_html__( 'Altitude', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_altitude_section_tablet_and_call_to_action',
		'gpb_altitude_section_product_video',
		'gpb_altitude_section_website_preview_dark',
		'gpb_altitude_section_feature_text_boxes',
		'gpb_altitude_section_avatar_and_testimonial',
		'gpb_altitude_section_pricing_table',
	],
	'name'       => esc_html__( 'Altitude Homepage Alternative', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'portfolio', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'features', 'genesis-page-builder' ),
		esc_html__( 'homepage', 'genesis-page-builder' ),
		esc_html__( 'tablet', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'agency', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'altitude', 'genesis-page-builder' ),
		esc_html__( 'altitude homepage alternative', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/altitude/gpb_altitude_layout_homepage_alternative.jpg',
];
