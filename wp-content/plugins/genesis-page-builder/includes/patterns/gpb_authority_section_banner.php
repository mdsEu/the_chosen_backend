<?php
/**
 * Genesis Blocks Banner section for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_authority_section_banner',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"focalPoint\":{\"x\":\"0.50\",\"y\":\"0.50\"},\"columns\":1,\"layout\":\"gb-1-col-equal\",\"columnsGap\":3,\"align\":\"full\",\"paddingTop\":1.5,\"paddingRight\":1,\"paddingBottom\":1.5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#ffffff\",\"customBackgroundColor\":\"#000cff\",\"columnMaxWidth\":1200,\"className\":\"gpb-authority-section-banner \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-authority-section-banner gb-layout-columns-1 gb-1-col-equal gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:1.5em;padding-right:1em;padding-bottom:1.5em;padding-left:1em;background-color:#000cff;color:#ffffff;background-position:50% 50%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-3 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":16},\"color\":{\"text\":\"#ffffff\"}},\"className\":\"is-style-gpb-no-margin\"} -->
<p class=\"has-text-align-center is-style-gpb-no-margin has-text-color\" style=\"color:#ffffff;font-size:16px\"><strong>Check out our fresh new course on building and growing an online audience —&nbsp;25% OFF Today Only!</strong></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Authority Banner', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'banner', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority banner', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_section_banner.jpg',
];
