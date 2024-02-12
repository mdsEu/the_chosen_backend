<?php
/**
 * Genesis Blocks Homepage Alternative layout for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_authority_layout_homepage_alternative',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_authority_section_banner',
		'gpb_authority_section_header_cta',
		'gpb_authority_section_logo_list_two',
		'gpb_authority_section_start_text',
		'gpb_authority_section_lesson_plan',
		'gpb_authority_section_testimonials',
		'gpb_authority_section_numbered_list',
		'gpb_authority_section_feature_boxes',
		'gpb_authority_section_headline_text_and_buttons',
	],
	'name'       => esc_html__( 'Authority Homepage Alternative', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'service', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'homepage', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority homepage alternative', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_layout_homepage_alternative.jpg',
];
