<?php
/**
 * Genesis Blocks Map Location section for Infinity Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_infinity_section_map_location',
	'collection' => [
		'slug'                   => 'infinity',
		'label'                  => esc_html__( 'Infinity', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"focalPoint\":{\"x\":\"0.50\",\"y\":\"0.50\"},\"columns\":1,\"layout\":\"gb-1-col-equal\",\"columnsGap\":3,\"align\":\"full\",\"paddingTop\":6,\"paddingRight\":1,\"paddingBottom\":6,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#1f1f1f\",\"customBackgroundColor\":\"#f5f5f5\",\"columnMaxWidth\":1200,\"className\":\"gpb-infinity-section-map-location \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-infinity-section-map-location gb-layout-columns-1 gb-1-col-equal gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:6em;padding-right:1em;padding-bottom:6em;padding-left:1em;background-color:#f5f5f5;color:#1f1f1f;background-position:50% 50%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-3 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":48,\"lineHeight\":\"1.2\"},\"color\":{\"text\":\"#1f1f1f\"}}} -->
<h2 class=\"has-text-align-center has-text-color\" style=\"color:#1f1f1f;font-size:48px;line-height:1.2\">Where To Find Us</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">We’re centrally located in the heart of the tech district. Come find us!</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {\"height\":20} -->
<div style=\"height:20px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
<!-- /wp:spacer -->

<!-- wp:html -->
<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3470.5670865756474!2d-95.09152774886842!3d29.558099181973784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86409da671292593%3A0xf684f098a7237a30!2sNASA+Mission+Control+Center!5e0!3m2!1sen!2sus!4v1560875318343!5m2!1sen!2sus\" width=\"100%\" height=\"560\" frameborder=\"0\" style=\"border:0\" allowfullscreen=\"\"></iframe>
<!-- /wp:html --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Infinity Map Location', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'contact', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'map', 'genesis-page-builder' ),
		esc_html__( 'directions', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'infinity', 'genesis-page-builder' ),
		esc_html__( 'infinity map location', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/infinity/gpb_infinity_section_map_location.jpg',
];
