<?php
/**
 * Genesis Blocks Contact Page layout for Tangerine Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_tangerine_layout_contact_page',
	'collection' => [
		'slug'                   => 'tangerine',
		'label'                  => esc_html__( 'Tangerine', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_tangerine_section_hero_header_3',
		'gpb_section_tangerine_column_text__2020_08_27',
		'gpb_section_tangerine_features_faq__2020_8_26',
		'gpb_tangerine_contact__2020_6_4',
	],
	'name'       => esc_html__( 'Tangerine Contact Page', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'contact', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'contact', 'genesis-page-builder' ),
		esc_html__( 'hours', 'genesis-page-builder' ),
		esc_html__( 'directions', 'genesis-page-builder' ),
		esc_html__( 'map', 'genesis-page-builder' ),
		esc_html__( 'tangerine', 'genesis-page-builder' ),
		esc_html__( 'tangerine contact', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/tangerine/gpb_tangerine_layout_contact_page.jpg',
];
