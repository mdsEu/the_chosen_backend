<?php
/**
 * Genesis Blocks Numbered List section for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_authority_section_numbered_list',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"align\":\"full\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#333333\",\"customBackgroundColor\":\"#ffffff\",\"columnMaxWidth\":1200,\"className\":\"gpb-authority-section-numbered-list is-style-gpb-authority-right-background \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-authority-section-numbered-list is-style-gpb-authority-right-background gb-layout-columns-2 gb-2-col-equal gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#ffffff;color:#333333\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"style\":{\"typography\":{\"lineHeight\":\"1.2\",\"fontSize\":12},\"color\":{\"text\":\"#000cff\"}},\"className\":\"is-style-gpb-capital-text\"} -->
<h2 class=\"is-style-gpb-capital-text has-text-color\" style=\"color:#000cff;font-size:12px;line-height:1.2\">How it Works.</h2>
<!-- /wp:heading -->

<!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":40,\"lineHeight\":\"1.2\"},\"color\":{\"text\":\"#111111\"}}} -->
<h3 class=\"has-text-color\" style=\"color:#111111;font-size:40px;line-height:1.2\">We guide you through the complex process of launching &amp; marketing a website.</h3>
<!-- /wp:heading -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"paddingLeft\":28} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-1 one-column\" style=\"padding-left:28px\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:list {\"ordered\":true,\"className\":\"gpb-number-list\"} -->
<ol class=\"gpb-number-list\"><li><strong>Get Started</strong><br>Join our weekly webinars &amp; roundtable events.</li><li><strong>Dig in</strong><br>Dive deep with 120+ written &amp; video lessons.</li><li><strong>Create</strong><br>Follow step-by-step product &amp; website checklists.</li><li><strong>Launch</strong><br>Take your product live and spread the word.</li></ol>
<!-- /wp:list -->

<!-- wp:spacer {\"height\":30} -->
<div style=\"height:30px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
<!-- /wp:spacer --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:image {\"align\":\"center\",\"id\":730,\"width\":380,\"sizeSlug\":\"large\",\"linkDestination\":\"none\",\"className\":\"is-style-gpb-border is-style-gpb-shadow\"} -->
<div class=\"wp-block-image is-style-gpb-border is-style-gpb-shadow\"><figure class=\"aligncenter size-large is-resized\"><img src=\"https://demo.studiopress.com/page-builder/authority/ebook-cover-marketing.jpg\" alt=\"\" class=\"wp-image-730\" width=\"380\" title=\"\"/></figure></div>
<!-- /wp:image --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Authority Numbered List', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'image', 'genesis-page-builder' ),
		esc_html__( 'book', 'genesis-page-builder' ),
		esc_html__( 'course', 'genesis-page-builder' ),
		esc_html__( 'list', 'genesis-page-builder' ),
		esc_html__( 'numbered list', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority numbered list', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_section_numbered_list.jpg',
];
