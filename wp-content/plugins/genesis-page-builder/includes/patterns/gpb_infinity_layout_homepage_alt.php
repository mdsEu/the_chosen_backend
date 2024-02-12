<?php
/**
 * Genesis Blocks Homepage Alt layout for Infinity Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_infinity_layout_homepage_alt',
	'collection' => [
		'slug'                   => 'infinity',
		'label'                  => esc_html__( 'Infinity', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_infinity_section_hero_header_left_text',
		'gpb_infinity_section_two_column_features',
		'gpb_infinity_section_two_column_text_with_image',
		'gpb_infinity_section_quote_with_background',
		'gpb_infinity_section_text_and_image_columns',
		'gpb_infinity_section_video_and_text',
	],
	'name'       => esc_html__( 'Infinity Homepage Alt', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'hero', 'genesis-page-builder' ),
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'infinity', 'genesis-page-builder' ),
		esc_html__( 'infinity homepage alt', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/infinity/gpb_infinity_layout_homepage_alt.jpg',
];
