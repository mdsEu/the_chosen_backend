<?php
/**
 * Genesis Blocks Homepage layout for Monochrome Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_monochrome_layout_homepage',
	'collection' => [
		'slug'                   => 'monochrome',
		'label'                  => esc_html__( 'Monochrome', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_monochrome_section_hero_header',
		'gpb_monochrome_section_title_and_text_columns',
		'gpb_monochrome_section_title_and_logos',
		'gpb_monochrome_section_blog_posts',
		'gpb_monochrome_section_call_to_action',
	],
	'name'       => esc_html__( 'Monochrome Homepage', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'blog', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'blog', 'genesis-page-builder' ),
		esc_html__( 'homepage', 'genesis-page-builder' ),
		esc_html__( 'button', 'genesis-page-builder' ),
		esc_html__( 'monochrome', 'genesis-page-builder' ),
		esc_html__( 'monochrome homepage', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_layout_homepage.jpg',
];
