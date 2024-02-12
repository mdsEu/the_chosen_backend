<?php
/**
 * Genesis Blocks Homepage layout for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_authority_layout_homepage',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_authority_section_banner',
		'gpb_authority_section_text_and_image_opt_in',
		'gpb_authority_section_logo_list',
		'gpb_authority_section_start_text',
		'gpb_authority_section_cta_one',
		'gpb_authority_section_quote',
		'gpb_authority_section_cta_two',
		'gpb_authority_section_quote',
		'gpb_authority_section_cta_three',
		'gpb_authority_section_blog_posts',
		'gpb_authority_section_headline_text_and_buttons',
	],
	'name'       => esc_html__( 'Authority Homepage', 'genesis-page-builder' ),
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
		esc_html__( 'authority homepage', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_layout_homepage.jpg',
];
