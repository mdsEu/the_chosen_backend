<?php
/**
 * Genesis Blocks Homepage Alt layout for Monochrome Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_monochrome_layout_homepage_alternative',
	'collection' => [
		'slug'                   => 'monochrome',
		'label'                  => esc_html__( 'Monochrome', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_monochrome_section_hero_header',
		'gpb_monochrome_section_text_and_image_columns',
		'gpb_monochrome_section_title_and_text_columns_dark',
		'gpb_monochrome_section_big_testimonial',
		'gpb_monochrome_section_title_and_numbers',
		'gpb_monochrome_section_call_to_action',
	],
	'name'       => esc_html__( 'Monochrome Homepage Alt', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'testimonial', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'numbers', 'genesis-page-builder' ),
		esc_html__( 'homepage', 'genesis-page-builder' ),
		esc_html__( 'button', 'genesis-page-builder' ),
		esc_html__( 'monochrome', 'genesis-page-builder' ),
		esc_html__( 'monochrome homepage alternative', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_layout_homepage_alternative.jpg',
];
