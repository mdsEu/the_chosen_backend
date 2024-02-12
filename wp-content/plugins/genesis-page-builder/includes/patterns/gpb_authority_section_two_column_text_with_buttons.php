<?php
/**
 * Genesis Blocks Two Column Text with Buttons section for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_authority_section_two_column_text_with_buttons',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#333333\",\"customBackgroundColor\":\"#f4f4f4\",\"columnMaxWidth\":1200,\"className\":\"gpb-authority-section-two-column-text-with-buttons \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-authority-section-two-column-text-with-buttons gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#f4f4f4;color:#333333\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"left\",\"style\":{\"typography\":{\"fontSize\":40,\"lineHeight\":\"1.2\"},\"color\":{\"text\":\"#111111\"}}} -->
<h2 class=\"has-text-align-left has-text-color\" style=\"color:#111111;font-size:40px;line-height:1.2\">What We Do</h2>
<!-- /wp:heading -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-2 gb-2-col-equal\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"left\",\"level\":3,\"style\":{\"typography\":{\"fontSize\":22},\"color\":{\"text\":\"#111111\"}}} -->
<h3 class=\"has-text-align-left has-text-color\" style=\"color:#111111;font-size:22px\">Marketing and Content</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"left\"} -->
<p class=\"has-text-align-left\">If you're a creative entrepreneur and serious about building your business, it's time to take the next step. We will guide you through all the comprehensive concepts, tactics and strategies you will need to succeed online.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"left\",\"level\":3,\"style\":{\"typography\":{\"fontSize\":22},\"color\":{\"text\":\"#111111\"}}} -->
<h3 class=\"has-text-align-left has-text-color\" style=\"color:#111111;font-size:22px\">Support when you need it</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"left\"} -->
<p class=\"has-text-align-left\">This program is delivered in self-paced format, along with optional webinars, 1-1 strategic planning sessions, and Q&amp;A sessions that allow you to interact with the instructor, ask questions, and get individual attention.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->

<!-- wp:spacer {\"height\":50} -->
<div style=\"height:50px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
<!-- /wp:spacer -->

<!-- wp:buttons {\"contentJustification\":\"left\"} -->
<div class=\"wp-block-buttons is-content-justification-left\"><!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"text\":\"#ffffff\",\"background\":\"#000cff\"}}} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-text-color has-background no-border-radius\" style=\"background-color:#000cff;color:#ffffff\">Get Started</a></div>
<!-- /wp:button -->

<!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"text\":\"#ffffff\",\"background\":\"#333333\"}}} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-text-color has-background no-border-radius\" style=\"background-color:#333333;color:#ffffff\">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Authority Two Column Text with Buttons', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'features', 'genesis-page-builder' ),
		esc_html__( 'columns', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority two column text with buttons', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_section_two_column_text_with_buttons.jpg',
];
