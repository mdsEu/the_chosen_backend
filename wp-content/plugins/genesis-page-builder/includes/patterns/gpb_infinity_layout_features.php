<?php
/**
 * Genesis Blocks Features layout for Infinity Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_infinity_layout_features',
	'collection' => [
		'slug'                   => 'infinity',
		'label'                  => esc_html__( 'Infinity', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_infinity_section_headline_text_and_buttons',
		'gpb_infinity_section_feature_boxes_dark',
		'gpb_infinity_section_video_and_text',
		'gpb_infinity_section_about_text_with_background_two',
		'gpb_infinity_section_quote',
	],
	'name'       => esc_html__( 'Infinity Features', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'hero', 'genesis-page-builder' ),
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'infinity', 'genesis-page-builder' ),
		esc_html__( 'infinity features', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/infinity/gpb_infinity_layout_features.jpg',
];
