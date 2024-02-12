<?php
/**
 * Genesis Blocks Homepage layout for Tangerine Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_layout_tangerine__2020_6_4',
	'collection' => [
		'slug'                   => 'tangerine',
		'label'                  => esc_html__( 'Tangerine', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_section_tangerine_hero_header__2020_10_28',
		'gpb_tangerine_features__2020_6_4',
		'gpb_section_tangerine_team__2020_10_29',
		'gpb_tangerine_list__2020_6_4',
		'gpb_tangerine_services__2020_6_4',
		'gpb_tangerine_contact__2020_6_4',
	],
	'name'       => esc_html__( 'Tangerine Homepage', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'portfolio', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'designer', 'genesis-page-builder' ),
		esc_html__( 'homepage', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'hero', 'genesis-page-builder' ),
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'button', 'genesis-page-builder' ),
		esc_html__( 'tangerine', 'genesis-page-builder' ),
		esc_html__( 'tangerine homepage', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/tangerine/gpb_tangerine_layout_homepage.jpg',
];
