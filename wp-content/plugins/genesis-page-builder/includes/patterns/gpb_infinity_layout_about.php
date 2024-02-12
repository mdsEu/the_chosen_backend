<?php
/**
 * Genesis Blocks About layout for Infinity Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_infinity_layout_about',
	'collection' => [
		'slug'                   => 'infinity',
		'label'                  => esc_html__( 'Infinity', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
		'thumbnail'              => 'https://demo.studiopress.com/page-builder/infinity/gpb_infinity_layout_homepage.jpg',
	],
	'content'    => [
		'gpb_infinity_section_team_members',
		'gpb_infinity_section_two_column_features_dark',
		'gpb_infinity_section_two_column_text_with_image',
		'gpb_infinity_section_about_text_with_background',
		'gpb_infinity_section_contact_info',
	],
	'name'       => esc_html__( 'Infinity About', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'team', 'genesis-page-builder' ),
		esc_html__( 'portfolio', 'genesis-page-builder' ),
		esc_html__( 'agency', 'genesis-page-builder' ),
		esc_html__( 'contact', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'team', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'contact', 'genesis-page-builder' ),
		esc_html__( 'infinity', 'genesis-page-builder' ),
		esc_html__( 'infinity about', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/infinity/gpb_infinity_layout_about.jpg',
];
