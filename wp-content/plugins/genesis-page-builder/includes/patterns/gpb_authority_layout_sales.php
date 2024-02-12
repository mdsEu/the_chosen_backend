<?php
/**
 * Genesis Blocks Sales layout for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_authority_layout_sales',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_authority_section_banner',
		'gpb_authority_section_sales_cta',
		'gpb_authority_section_feature_boxes',
		'gpb_authority_section_pricing_table',
		'gpb_authority_section_text_with_button',
		'gpb_authority_section_contact_info',
	],
	'name'       => esc_html__( 'Authority Sales', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'service', 'genesis-page-builder' ),
		esc_html__( 'sales', 'genesis-page-builder' ),
		esc_html__( 'pricing', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority sales', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_layout_sales.jpg',
];
