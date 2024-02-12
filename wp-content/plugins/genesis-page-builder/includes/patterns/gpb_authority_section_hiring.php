<?php
/**
 * Genesis Blocks Hiring section for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_authority_section_hiring',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#333333\",\"customBackgroundColor\":\"#ffffff\",\"className\":\"gpb-authority-section-hiring \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-authority-section-hiring gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#ffffff;color:#333333\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"columnsGap\":3,\"columnMaxWidth\":1200} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-2 gb-2-col-equal gb-columns-center\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-3 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"style\":{\"typography\":{\"fontSize\":12},\"color\":{\"text\":\"#000cff\"}},\"className\":\"is-style-gpb-capital-text\"} -->
<h2 class=\"is-style-gpb-capital-text has-text-color\" style=\"color:#000cff;font-size:12px\">We’re hiring!</h2>
<!-- /wp:heading -->

<!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":40,\"lineHeight\":\"1.2\"},\"color\":{\"text\":\"#111111\"}}} -->
<h3 class=\"has-text-color\" style=\"color:#111111;font-size:40px;line-height:1.2\">Check out our job listings and send us your resume.</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Start a fulfilling career with our team of talented entrepreneurial instructors. We are now hiring multiple positions.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class=\"wp-block-buttons\"><!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"background\":\"#000cff\",\"text\":\"#ffffff\"}},\"className\":\"is-style-fill\"} -->
<div class=\"wp-block-button is-style-fill\"><a class=\"wp-block-button__link has-text-color has-background no-border-radius\" style=\"background-color:#000cff;color:#ffffff\">Apply Now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:spacer {\"height\":35} -->
<div style=\"height:35px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph -->
<p><strong>Marketing Director</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Marketing directors are responsible for their company's marketing and communications strategies, as well as overall branding and image.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {\"style\":{\"color\":{\"text\":\"#000cff\"}}} -->
<p class=\"has-text-color\" style=\"color:#000cff\"><a href=\"#\">View Job Description</a></p>
<!-- /wp:paragraph -->

<!-- wp:separator {\"customColor\":\"#eeeeee\",\"className\":\"is-style-wide\"} -->
<hr class=\"wp-block-separator has-text-color has-background is-style-wide\" style=\"background-color:#eeeeee;color:#eeeeee\"/>
<!-- /wp:separator -->

<!-- wp:paragraph -->
<p><strong>UX Designer</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>User experience (UX) refers to any interaction a user has with a product or service. UX design considers each and every element that shapes this experience.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {\"style\":{\"color\":{\"text\":\"#000cff\"}}} -->
<p class=\"has-text-color\" style=\"color:#000cff\"><a href=\"#\">View Job Description</a></p>
<!-- /wp:paragraph -->

<!-- wp:separator {\"customColor\":\"#eeeeee\",\"className\":\"is-style-wide\"} -->
<hr class=\"wp-block-separator has-text-color has-background is-style-wide\" style=\"background-color:#eeeeee;color:#eeeeee\"/>
<!-- /wp:separator -->

<!-- wp:paragraph -->
<p><strong>Full Stack Developer</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>A full stack developer is a web developer or engineer who works with both the front and back ends of a website or application.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {\"style\":{\"color\":{\"text\":\"#000cff\"}}} -->
<p class=\"has-text-color\" style=\"color:#000cff\"><a href=\"#\">View Job Description</a></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Authority Hiring', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'team', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'columns', 'genesis-page-builder' ),
		esc_html__( 'hiring', 'genesis-page-builder' ),
		esc_html__( 'help wanted', 'genesis-page-builder' ),
		esc_html__( 'team', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority hiring', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_section_hiring.jpg',
];
