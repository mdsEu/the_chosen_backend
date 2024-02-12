<?php
/**
 * Genesis Blocks Features Page layout for Tangerine Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_layout_tangerine_features__2020_6_4',
	'collection' => [
		'slug'                   => 'tangerine',
		'label'                  => esc_html__( 'Tangerine', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_tangerine_section_hero_header_2',
		'gpb_tangerine_features_square__2020_6_4',
		'gpb_tangerine_features_column__2020_6_4',
		'gpb_section_tangerine_feature_device__2020_10_29',
		'gpb_tangerine_features_contact__2020_6_4',
	],
	'name'       => esc_html__( 'Tangerine Features Page', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'hero', 'genesis-page-builder' ),
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'button', 'genesis-page-builder' ),
		esc_html__( 'features', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'tangerine', 'genesis-page-builder' ),
		esc_html__( 'tangerine features', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/tangerine/gpb_tangerine_layout_features_page.jpg',
];
