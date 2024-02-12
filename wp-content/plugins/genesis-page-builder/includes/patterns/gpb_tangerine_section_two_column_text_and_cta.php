<?php
/**
 * Genesis Blocks Two Column Text and CTA section for Tangerine Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_section_tangerine_two_column_text_with_cta',
	'collection' => [
		'slug'                   => 'tangerine',
		'label'                  => esc_html__( 'Tangerine', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":6,\"paddingRight\":2,\"paddingBottom\":5,\"paddingLeft\":2,\"paddingUnit\":\"em\",\"customTextColor\":\"#272c30\",\"customBackgroundColor\":\"#ffffff\",\"className\":\"gpb-tangerine-section-two-column-text-and-cta \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-tangerine-section-two-column-text-and-cta gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color alignfull\" style=\"padding-top:6em;padding-right:2em;padding-bottom:5em;padding-left:2em;background-color:#ffffff;color:#272c30\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"columnsGap\":3,\"align\":\"full\",\"columnMaxWidth\":1200} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-2 gb-2-col-equal gb-columns-center alignfull\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-3 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"top\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-top\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"style\":{\"typography\":{\"fontSize\":44},\"color\":{\"text\":\"#272c30\"}}} -->
<h2 class=\"has-text-color\" style=\"color:#272c30;font-size:44px\">We don't just do amazing work for our clients.<br><strong>We believe in them</strong>.</h2>
<!-- /wp:heading --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"top\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-top\"><div class=\"gb-block-layout-column-inner\"><!-- wp:paragraph -->
<p>Put simply, our passion is you. We want to see you succeed in your business, your goals, and your dreams. Because when you succeed, so do we. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>For that reason, the clients we take on are the best of the best; the dreamers, the inventors, the game changers. </p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->

<!-- wp:genesis-blocks/gb-spacer {\"spacerHeight\":56} -->
<div style=\"color:#ddd\" class=\"wp-block-genesis-blocks-gb-spacer gb-block-spacer gb-divider-solid gb-divider-size-1\"><hr style=\"height:56px\"/></div>
<!-- /wp:genesis-blocks/gb-spacer -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-1 one-column\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column {\"textAlign\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\" style=\"text-align:center\"><!-- wp:buttons {\"contentJustification\":\"center\"} -->
<div class=\"wp-block-buttons is-content-justification-center\"><!-- wp:button {\"style\":{\"color\":{\"background\":\"#ea533c\",\"text\":\"#ffffff\"}}} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-text-color has-background\" style=\"background-color:#ea533c;color:#ffffff\">Let's make it happen together, today.</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Tangerine Two Column Text and CTA', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'text columns', 'genesis-page-builder' ),
		esc_html__( 'button', 'genesis-page-builder' ),
		esc_html__( 'cta', 'genesis-page-builder' ),
		esc_html__( 'text', 'genesis-page-builder' ),
		esc_html__( 'tangerine', 'genesis-page-builder' ),
		esc_html__( 'tangerine two column text with cta', 'genesis-page-builder' ),
		esc_html__( 'tangerine cta', 'genesis-page-builder' ),
		esc_html__( 'tangerine text columns', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/tangerine/gpb_tangerine_section_two_column_text_and_cta.jpg',
];
