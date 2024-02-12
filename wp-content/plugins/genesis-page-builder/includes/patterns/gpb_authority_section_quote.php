<?php
/**
 * Genesis Blocks Quote section for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_authority_section_quote',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"focalPoint\":{\"x\":\"0.50\",\"y\":\"0.50\"},\"columns\":1,\"layout\":\"gb-1-col-equal\",\"columnsGap\":3,\"align\":\"full\",\"paddingTop\":2,\"paddingRight\":1,\"paddingBottom\":2,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#070707\",\"customBackgroundColor\":\"#ffffff\",\"columnMaxWidth\":1140,\"className\":\"gpb-authority-section-quote \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-authority-section-quote gb-layout-columns-1 gb-1-col-equal gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:2em;padding-right:1em;padding-bottom:2em;padding-left:1em;background-color:#ffffff;color:#070707;background-position:50% 50%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-3 gb-is-responsive-column\" style=\"max-width:1140px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":22},\"color\":{\"text\":\"#555555\"}}} -->
<p class=\"has-text-align-center has-text-color\" style=\"color:#555555;font-size:22px\">“ <em>Melyssa’s course helped me to grow my email list from 500 to over 10,000 subscribers—all within 3 months!</em></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":14}}} -->
<p class=\"has-text-align-center\" style=\"font-size:14px\"><strong>– Jane, Food Blogger</strong></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Authority Quote', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'testimonial', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'testimonial', 'genesis-page-builder' ),
		esc_html__( 'quote', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority quote', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_section_quote.jpg',
];
