<?php
/**
 * Genesis Blocks Colorful Quote section for Altitude Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_altitude_section_colorful_quote',
	'collection' => [
		'slug'                   => 'altitude',
		'label'                  => esc_html__( 'Altitude', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:cover {\"customOverlayColor\":\"#0680a2\",\"minHeight\":132,\"minHeightUnit\":\"px\",\"align\":\"full\",\"className\":\"gpb-altitude-section-colorful-quote\"} -->
<div class=\"wp-block-cover alignfull has-background-dim gpb-altitude-section-colorful-quote\" style=\"background-color:#0680a2;min-height:132px\"><div class=\"wp-block-cover__inner-container\"><!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"paddingTop\":3,\"paddingRight\":1,\"paddingBottom\":3,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#ffffff\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-1 one-column gb-has-custom-text-color\" style=\"padding-top:3em;padding-right:1em;padding-bottom:3em;padding-left:1em;color:#ffffff\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":18},\"color\":{\"text\":\"#ffffff\"}}} -->
<h2 class=\"has-text-align-center has-text-color\" style=\"color:#ffffff;font-size:18px\">Happy Customers</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":52,\"lineHeight\":\"1.2\"}}} -->
<p class=\"has-text-align-center\" style=\"font-size:52px;line-height:1.2\"><strong>\"I vouch for it.<br>I trust my business to it.\"</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":18},\"color\":{\"text\":\"#ffffff\"}}} -->
<p class=\"has-text-align-center has-text-color\" style=\"color:#ffffff;font-size:18px\">– Phil Conners</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:cover -->",
	'name'       => esc_html__( 'Altitude Colorful Quote', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'team', 'genesis-page-builder' ),
		esc_html__( 'testimonial', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'agency', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'quote', 'genesis-page-builder' ),
		esc_html__( 'text', 'genesis-page-builder' ),
		esc_html__( 'altitude', 'genesis-page-builder' ),
		esc_html__( 'altitude colorful quote', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/altitude/gpb_altitude_section_colorful_quote.jpg',
];
