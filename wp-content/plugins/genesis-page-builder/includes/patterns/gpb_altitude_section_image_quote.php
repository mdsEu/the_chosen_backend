<?php
/**
 * Genesis Blocks Image Quote section for Altitude Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_altitude_section_image_quote',
	'collection' => [
		'slug'                   => 'altitude',
		'label'                  => esc_html__( 'Altitude', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"backgroundImgURL\":\"https://demo.studiopress.com/page-builder/altitude/altitude-bg-2.jpg\",\"backgroundDimRatio\":50,\"focalPoint\":{\"x\":\"0.50\",\"y\":\"0.50\"},\"columns\":1,\"layout\":\"gb-1-col-equal\",\"columnsGap\":3,\"align\":\"full\",\"paddingTop\":6,\"paddingRight\":1,\"paddingBottom\":6,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#ffffff\",\"customBackgroundColor\":\"#000000\",\"columnMaxWidth\":872,\"className\":\"gpb-altitude-section-image-quote\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-altitude-section-image-quote gb-layout-columns-1 gb-1-col-equal gb-has-background-dim gb-has-background-dim-50 gb-background-cover gb-background-no-repeat gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:6em;padding-right:1em;padding-bottom:6em;padding-left:1em;background-color:#000000;color:#ffffff;background-image:url(https://demo.studiopress.com/page-builder/altitude/altitude-bg-2.jpg);background-position:50% 50%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-3 gb-is-responsive-column\" style=\"max-width:872px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"color\":{\"text\":\"#ffffff\"},\"typography\":{\"fontSize\":18}}} -->
<h2 class=\"has-text-align-center has-text-color\" style=\"color:#ffffff;font-size:18px\">Happy Customers<br></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":52,\"lineHeight\":\"1.2\"},\"color\":{\"text\":\"#ffffff\"}}} -->
<p class=\"has-text-align-center has-text-color\" style=\"color:#ffffff;font-size:52px;line-height:1.2\"><strong>\"I vouch for it.</strong><br><strong>I trust my business to it.\"</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"color\":{\"text\":\"#ffffff\"}}} -->
<p class=\"has-text-align-center has-text-color\" style=\"color:#ffffff\">—Phil Conners</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Altitude Image Quote', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'testimonial', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'quote', 'genesis-page-builder' ),
		esc_html__( 'testimonial', 'genesis-page-builder' ),
		esc_html__( 'altitude', 'genesis-page-builder' ),
		esc_html__( 'altitude image quote', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/altitude/gpb_altitude_section_image_quote.jpg',
];
