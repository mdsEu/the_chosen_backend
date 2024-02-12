<?php
/**
 * Genesis Blocks About layout for Tangerine Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_layout_tangerine_about_page',
	'collection' => [
		'slug'                   => 'tangerine',
		'label'                  => esc_html__( 'Tangerine', 'genesis-page-builder' ),
		'thumbnail'              => 'https://demo.studiopress.com/page-builder/tangerine/gpb_tangerine_layout_homepage.jpg',
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_section_tangerine_avatar_intro__2020_08_27',
		'gpb_section_tangerine_team__2020_08_26',
		'gpb_tangerine_features_column__2020_6_4',
		'gpb_section_tangerine_hiring__2020_8_27',
	],
	'name'       => esc_html__( 'Tangerine About', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'team', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'about', 'genesis-page-builder' ),
		esc_html__( 'hiring', 'genesis-page-builder' ),
		esc_html__( 'team', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'hero', 'genesis-page-builder' ),
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'button', 'genesis-page-builder' ),
		esc_html__( 'tangerine', 'genesis-page-builder' ),
		esc_html__( 'tangerine about', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/tangerine/gpb_tangerine_layout_about.jpg',
];
