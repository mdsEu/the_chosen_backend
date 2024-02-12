<?php
/**
 * Genesis Blocks About layout for Altitude Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'layout',
	'key'        => 'gpb_altitude_layout_about',
	'collection' => [
		'slug'                   => 'altitude',
		'label'                  => esc_html__( 'Altitude', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
		'thumbnail'              => 'https://demo.studiopress.com/page-builder/altitude/gpb_altitude_layout_homepage.jpg',
	],
	'content'    => [
		'gpb_altitude_section_text_image_columns_dark',
		'gpb_altitude_section_team_members',
		'gpb_altitude_section_feature_text_boxes',
		'gpb_altitude_section_contact_info',
	],
	'name'       => esc_html__( 'Altitude About', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'team', 'genesis-page-builder' ),
		esc_html__( 'features', 'genesis-page-builder' ),
		esc_html__( 'contact', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'homepage', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'landing page', 'genesis-page-builder' ),
		esc_html__( 'altitude', 'genesis-page-builder' ),
		esc_html__( 'altitude about', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/altitude/gpb_altitude_layout_about.jpg',
];
