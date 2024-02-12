<?php
/**
 * Genesis Blocks Quote with Background section for Infinity Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_infinity_section_quote_with_background',
	'collection' => [
		'slug'                   => 'infinity',
		'label'                  => esc_html__( 'Infinity', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"backgroundImgURL\":\"https://demo.studiopress.com/page-builder/infinity/bg-7.webp\",\"focalPoint\":{\"x\":\"0.50\",\"y\":\"0.50\"},\"columns\":1,\"layout\":\"gb-1-col-equal\",\"columnsGap\":3,\"align\":\"full\",\"paddingTop\":6,\"paddingRight\":1,\"paddingBottom\":6,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#ffffff\",\"customBackgroundColor\":\"#1f1f1f\",\"columnMaxWidth\":610,\"className\":\"gpb-infinity-section-quote-with-background \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-infinity-section-quote-with-background gb-layout-columns-1 gb-1-col-equal gb-background-cover gb-background-no-repeat gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:6em;padding-right:1em;padding-bottom:6em;padding-left:1em;background-color:#1f1f1f;color:#ffffff;background-image:url(https://demo.studiopress.com/page-builder/infinity/bg-7.webp);background-position:50% 50%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-3 gb-is-responsive-column\" style=\"max-width:610px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:image {\"align\":\"center\",\"width\":104,\"height\":104,\"sizeSlug\":\"large\",\"className\":\"is-style-rounded\"} -->
<div class=\"wp-block-image is-style-rounded\"><figure class=\"aligncenter size-large is-resized\"><img src=\"https://demo.studiopress.com/page-builder/person-w-3.jpg\" alt=\"\" width=\"104\" height=\"104\"/></figure></div>
<!-- /wp:image -->

<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"color\":{\"text\":\"#ffffff\"},\"typography\":{\"fontSize\":22}}} -->
<p class=\"has-text-align-center has-text-color\" style=\"color:#ffffff;font-size:22px\">If you're a creative entrepreneur and serious about building your business, it's time to take the next step. We built the most beautiful most responsive theme for you to use.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"color\":{\"text\":\"#ffffff\"},\"typography\":{\"fontSize\":22}}} -->
<p class=\"has-text-align-center has-text-color\" style=\"color:#ffffff;font-size:22px\"><strong>– Marion Sagan</strong></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Infinity Quote with Background', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'testimonial', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'testimonial', 'genesis-page-builder' ),
		esc_html__( 'quote', 'genesis-page-builder' ),
		esc_html__( 'infinity', 'genesis-page-builder' ),
		esc_html__( 'infinity quote with background', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/infinity/gpb_infinity_section_quote_with_background.jpg',
];
