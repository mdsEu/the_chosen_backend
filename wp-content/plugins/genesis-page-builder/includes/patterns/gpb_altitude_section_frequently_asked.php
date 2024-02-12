<?php
/**
 * Genesis Blocks Frequently Asked section for Altitude Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_altitude_section_frequently_asked',
	'collection' => [
		'slug'                   => 'altitude',
		'label'                  => esc_html__( 'Altitude', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":6,\"paddingRight\":1,\"paddingBottom\":6,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#1f1f1f\",\"customBackgroundColor\":\"#ffffff\",\"columnMaxWidth\":1200,\"className\":\"gpb-altitude-section-frequently-asked\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-altitude-section-frequently-asked gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:6em;padding-right:1em;padding-bottom:6em;padding-left:1em;background-color:#ffffff;color:#1f1f1f\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-container {\"containerMarginBottom\":5,\"containerMaxWidth\":700} -->
<div style=\"margin-bottom:5%\" class=\"wp-block-genesis-blocks-gb-container gb-block-container\"><div class=\"gb-container-inside\"><div class=\"gb-container-content\" style=\"max-width:700px\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"color\":{\"text\":\"#1f1f1f\"},\"typography\":{\"fontSize\":48,\"lineHeight\":\"1.2\"}}} -->
<h2 class=\"has-text-align-center has-text-color\" style=\"color:#1f1f1f;font-size:48px;line-height:1.2\">Frequently Asked</h2>
<!-- /wp:heading --></div></div></div>
<!-- /wp:genesis-blocks/gb-container -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"marginBottom\":3,\"marginUnit\":\"%\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-2 gb-2-col-equal\" style=\"margin-bottom:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"style\":{\"typography\":{\"fontSize\":22},\"color\":{\"text\":\"#1f1f1f\"}}} -->
<h3 class=\"has-text-align-center has-text-color\" style=\"color:#1f1f1f;font-size:22px\"><strong>Do you offer support during this course?</strong></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Of course! We have a team of friendly experts ready to answer your questions and solve any problems that may come along. Simply use the support form in your customer portal, or send us an email.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"style\":{\"typography\":{\"fontSize\":22},\"color\":{\"text\":\"#1f1f1f\"}}} -->
<h3 class=\"has-text-align-center has-text-color\" style=\"color:#1f1f1f;font-size:22px\"><strong>Do you provide telephone support?</strong></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">We do not offer telephone support. In our experience, the written record created by a text-based ticketing system solves problems efficiently and effectively, and archives those solutions for future reference in a way that telephone conversations cannot.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"style\":{\"typography\":{\"fontSize\":22},\"color\":{\"text\":\"#1f1f1f\"}}} -->
<h3 class=\"has-text-align-center has-text-color\" style=\"color:#1f1f1f;font-size:22px\"><strong>Will you teach me how to use it?</strong></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Yes, owners have immediate access to the Knowledge Base (directly from your interface). Plus, you’ll have access to webinars, Walk-Throughs to guide you step-by-step, as well as video training.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {\"textAlign\":\"center\",\"level\":3,\"style\":{\"typography\":{\"fontSize\":22},\"color\":{\"text\":\"#1f1f1f\"}}} -->
<h3 class=\"has-text-align-center has-text-color\" style=\"color:#1f1f1f;font-size:22px\"><strong>Do I get community support?</strong></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Absolutely! You’ll have immediate access to our technical support staff through our Get Help form in your website. In addition, you’ll receive access to peer-to-peer support from other owners through our forums.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Altitude Frequently Asked', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'FAQ', 'genesis-page-builder' ),
		esc_html__( 'frequently asked', 'genesis-page-builder' ),
		esc_html__( 'altitude', 'genesis-page-builder' ),
		esc_html__( 'altitude frequently asked', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/altitude/gpb_altitude_section_frequently_asked.jpg',
];
