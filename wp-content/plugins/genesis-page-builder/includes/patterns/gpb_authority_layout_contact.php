<?php
/**
 * Genesis Blocks Contact layout for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_authority_layout_contact',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_authority_section_banner',
		'gpb_authority_section_contact_info_and_map',
		'gpb_authority_section_testimonials',
		'gpb_authority_section_hiring',
	],
	'name'       => esc_html__( 'Authority Contact', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'contact', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'contact', 'genesis-page-builder' ),
		esc_html__( 'hiring', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority contact', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_layout_contact.jpg',
];
