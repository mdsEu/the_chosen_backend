<?php
/**
 * Genesis Blocks Contact layout for Monochrome Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_monochrome_layout_contact',
	'collection' => [
		'slug'                   => 'monochrome',
		'label'                  => esc_html__( 'Monochrome', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
		'thumbnail'              => 'https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_layout_homepage.jpg',
	],
	'content'    => [
		'gpb_monochrome_section_map_and_contact',
		'gpb_monochrome_section_frequently_asked',
	],
	'name'       => esc_html__( 'Monochrome Contact', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'contact', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'contact', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'map', 'genesis-page-builder' ),
		esc_html__( 'directions', 'genesis-page-builder' ),
		esc_html__( 'hours', 'genesis-page-builder' ),
		esc_html__( 'monochrome', 'genesis-page-builder' ),
		esc_html__( 'monochrome contact', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_layout_contact.jpg',
];
