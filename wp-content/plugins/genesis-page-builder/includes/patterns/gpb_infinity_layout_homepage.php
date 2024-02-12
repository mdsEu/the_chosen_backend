<?php
/**
 * Genesis Blocks Homepage layout for Infinity Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_infinity_layout_homepage',
	'collection' => [
		'slug'                   => 'infinity',
		'label'                  => esc_html__( 'Infinity', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_infinity_section_hero_header',
		'gpb_infinity_section_about_text_with_button',
		'gpb_infinity_section_about_text_with_background',
		'gpb_infinity_section_feature_boxes',
		'gpb_infinity_section_about_text_with_background_two',
		'gpb_infinity_section_team_members',
		'gpb_infinity_section_about_text_with_background_three',
	],
	'name'       => esc_html__( 'Infinity Homepage', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'hero', 'genesis-page-builder' ),
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'infinity', 'genesis-page-builder' ),
		esc_html__( 'infinity homepage', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/infinity/gpb_infinity_layout_homepage.jpg',
];
