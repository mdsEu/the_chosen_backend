<?php
/**
 * Genesis Blocks Headline Text and Buttons section for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_authority_section_headline_text_and_buttons',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"customTextColor\":\"#333333\",\"customBackgroundColor\":\"#f4f4f4\",\"className\":\"gpb-authority-section-headline-text-and-buttons \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-authority-section-headline-text-and-buttons gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color alignfull\" style=\"background-color:#f4f4f4;color:#333333\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-columns {\"focalPoint\":{\"x\":\"0.50\",\"y\":\"0.50\"},\"columns\":1,\"layout\":\"gb-1-col-equal\",\"columnsGap\":3,\"align\":\"full\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#333333\",\"customBackgroundColor\":\"#f4f4f4\",\"columnMaxWidth\":872} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-1 gb-1-col-equal gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#f4f4f4;color:#333333;background-position:50% 50%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-3 gb-is-responsive-column\" style=\"max-width:872px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":40,\"lineHeight\":\"1.2\"},\"color\":{\"text\":\"#000cff\"}}} -->
<h2 class=\"has-text-align-center has-text-color\" style=\"color:#000cff;font-size:40px;line-height:1.2\">Ready to take your next step?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Grow your audience and build a profitable online business.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {\"contentJustification\":\"center\"} -->
<div class=\"wp-block-buttons is-content-justification-center\"><!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"text\":\"#ffffff\",\"background\":\"#000cff\"}}} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-text-color has-background no-border-radius\" style=\"background-color:#000cff;color:#ffffff\">Learn More</a></div>
<!-- /wp:button -->

<!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"text\":\"#ffffff\",\"background\":\"#333333\"}},\"className\":\"is-style-fill\"} -->
<div class=\"wp-block-button is-style-fill\"><a class=\"wp-block-button__link has-text-color has-background no-border-radius\" style=\"background-color:#333333;color:#ffffff\">Get Started Today</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"customTextColor\":\"#ffffff\",\"customBackgroundColor\":\"#000cff\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color alignfull\" style=\"background-color:#000cff;color:#ffffff\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:paragraph -->
<p></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Authority Headline Text and Buttons', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'service', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'call to action', 'genesis-page-builder' ),
		esc_html__( 'cta', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority headline text and buttons', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_section_headline_text_and_buttons.jpg',
];
