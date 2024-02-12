<?php
/**
 * Genesis Blocks Product Page layout for Tangerine Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_layout_tangerine_product__2020_08_28',
	'collection' => [
		'slug'                   => 'tangerine',
		'label'                  => esc_html__( 'Tangerine', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_section_tangerine_hero_cta__2020_08_26',
		'gpb_section_tangerine_column_text__2020_08_27',
		'gpb_section_tangerine_feature_devices__2020_08_28',
		'gpb_section_tangerine_text_columns_with_background',
		'gpb_section_tangerine_features_pricing__2020_8_24',
		'gpb_section_tangerine_features_avatar_testimonial__2020_8_27',
	],
	'name'       => esc_html__( 'Tangerine Product Page', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'hero', 'genesis-page-builder' ),
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'button', 'genesis-page-builder' ),
		esc_html__( 'tangerine', 'genesis-page-builder' ),
		esc_html__( 'tangerine product', 'genesis-page-builder' ),
		esc_html__( 'tangerine product page', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/tangerine/gpb_tangerine_layout_product_page.jpg',
];
