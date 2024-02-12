<?php
/**
 * Genesis Blocks Media layout for Monochrome Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_monochrome_layout_media',
	'collection' => [
		'slug'                   => 'monochrome',
		'label'                  => esc_html__( 'Monochrome', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => [
		'gpb_monochrome_section_large_video',
		'gpb_monochrome_section_frequently_asked',
		'gpb_monochrome_section_image_gallery',
		'gpb_monochrome_section_call_to_action',
	],
	'name'       => esc_html__( 'Monochrome Media', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'portfolio', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'portfolio', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'gallery', 'genesis-page-builder' ),
		esc_html__( 'video', 'genesis-page-builder' ),
		esc_html__( 'monochrome', 'genesis-page-builder' ),
		esc_html__( 'monochrome media', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_layout_media.jpg',
];
