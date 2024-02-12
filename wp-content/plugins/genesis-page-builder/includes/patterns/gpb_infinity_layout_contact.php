<?php
/**
 * Genesis Blocks Contact layout for Infinity Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_infinity_layout_contact',
	'collection' => [
		'slug'                   => 'infinity',
		'label'                  => esc_html__( 'Infinity', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_infinity_section_text_and_image_columns_dark',
		'gpb_infinity_section_contact_info',
		'gpb_infinity_section_map_location',
		'gpb_infinity_section_about_text_with_background_three',
	],
	'name'       => esc_html__( 'Infinity Contact', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'contact', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'contact', 'genesis-page-builder' ),
		esc_html__( 'directions', 'genesis-page-builder' ),
		esc_html__( 'map', 'genesis-page-builder' ),
		esc_html__( 'infinity', 'genesis-page-builder' ),
		esc_html__( 'infinity contact', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/infinity/gpb_infinity_layout_contact.jpg',
];
