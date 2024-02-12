<?php
/**
 * Genesis Blocks About Us section for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_authority_section_about_us',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"align\":\"full\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#333333\",\"customBackgroundColor\":\"#ffffff\",\"columnMaxWidth\":1200,\"className\":\"gpb-authority-section-about-us is-style-gpb-authority-right-background \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-authority-section-about-us is-style-gpb-authority-right-background gb-layout-columns-2 gb-2-col-equal gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#ffffff;color:#333333\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"style\":{\"typography\":{\"fontSize\":40},\"color\":{\"text\":\"#111111\"}}} -->
<h2 class=\"has-text-color\" style=\"color:#111111;font-size:40px\">Who We Are</h2>
<!-- /wp:heading -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"paddingLeft\":28} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-1 one-column\" style=\"padding-left:28px\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:paragraph -->
<p>We're here to help you navigate the increasingly complicated process of launching an online business.</p>
<!-- /wp:paragraph -->

<!-- wp:separator {\"customColor\":\"#eeeeee\",\"className\":\"is-style-wide\"} -->
<hr class=\"wp-block-separator has-text-color has-background is-style-wide\" style=\"background-color:#eeeeee;color:#eeeeee\"/>
<!-- /wp:separator -->

<!-- wp:paragraph -->
<p><strong>Passion</strong><br>We're driven to help you succeed.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Purpose</strong><br>We inspire you to build your dream online business.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>Ingenuity</strong><br>We provide creative, clever ideas and strategies.</p>
<!-- /wp:paragraph -->

<!-- wp:spacer {\"height\":30} -->
<div style=\"height:30px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
<!-- /wp:spacer --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:image {\"align\":\"center\",\"id\":730,\"width\":380,\"sizeSlug\":\"large\",\"linkDestination\":\"none\",\"className\":\"is-style-gpb-border is-style-gpb-shadow\"} -->
<div class=\"wp-block-image is-style-gpb-border is-style-gpb-shadow\"><figure class=\"aligncenter size-large is-resized\"><img src=\"https://demo.studiopress.com/page-builder/slate/gb_slate_image_person.jpg\" alt=\"\" class=\"wp-image-730\" width=\"380\" title=\"\"/></figure></div>
<!-- /wp:image --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Authority About Us', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'image', 'genesis-page-builder' ),
		esc_html__( 'about', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority about us', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_section_about_us.jpg',
];
