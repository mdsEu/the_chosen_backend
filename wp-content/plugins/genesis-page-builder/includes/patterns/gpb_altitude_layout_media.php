<?php
/**
 * Genesis Blocks Media layout for Altitude Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_altitude_layout_media',
	'collection' => [
		'slug'                   => 'altitude',
		'label'                  => esc_html__( 'Altitude', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_altitude_section_video_header',
		'gpb_altitude_section_colorful_quote',
		'gpb_altitude_section_features_light',
		'gpb_altitude_section_text_image_columns',
		'gpb_altitude_section_tablet_and_call_to_action',
	],
	'name'       => esc_html__( 'Altitude Media', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'agency', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'video', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'agency', 'genesis-page-builder' ),
		esc_html__( 'altitude', 'genesis-page-builder' ),
		esc_html__( 'altitude media', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/altitude/gpb_altitude_layout_media.jpg',
];
