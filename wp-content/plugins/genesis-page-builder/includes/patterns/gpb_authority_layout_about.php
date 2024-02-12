<?php
/**
 * Genesis Blocks About layout for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_authority_layout_about',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
		'thumbnail'              => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_layout_homepage.jpg',
	],
	'content'    => [
		'gpb_authority_section_banner',
		'gpb_authority_section_about_us',
		'gpb_authority_section_team_members',
		'gpb_authority_section_logo_list_two',
		'gpb_authority_section_two_column_text_with_buttons',
		'gpb_authority_section_contact_info',
	],
	'name'       => esc_html__( 'Authority About', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'team', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'about', 'genesis-page-builder' ),
		esc_html__( 'team', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority about', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_layout_about.jpg',
];
