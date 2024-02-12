<?php
/**
 * Genesis Blocks Text and Image Columns section for Infinity Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_infinity_section_text_and_image_columns',
	'collection' => [
		'slug'                   => 'infinity',
		'label'                  => esc_html__( 'Infinity', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"align\":\"full\",\"paddingTop\":6,\"paddingRight\":1,\"paddingBottom\":6,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#1f1f1f\",\"customBackgroundColor\":\"#f3f3f3\",\"columnMaxWidth\":1200,\"className\":\"gpb-infinity-section-text-and-image-columns \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-infinity-section-text-and-image-columns gb-layout-columns-2 gb-2-col-equal gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:6em;padding-right:1em;padding-bottom:6em;padding-left:1em;background-color:#f3f3f3;color:#1f1f1f\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"style\":{\"typography\":{\"fontSize\":48},\"color\":{\"text\":\"#1f1f1f\"}}} -->
<h2 class=\"has-text-color\" style=\"color:#1f1f1f;font-size:48px\">Grow Smarter</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18}}} -->
<p style=\"font-size:18px\">Infinity Pro is the most beautiful theme ever created. With an emphasis on incredible typography and responsive design, it will leave your audience speechless.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Infinity Pro is the most beautiful theme ever created. With an emphasis on incredible typography and responsive design, it will leave your audience speechless.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:image {\"width\":582,\"height\":392,\"sizeSlug\":\"large\"} -->
<figure class=\"wp-block-image size-large is-resized\"><img src=\"https://demo.studiopress.com/page-builder/altitude-computer.jpg\" alt=\"\" width=\"582\" height=\"392\"/></figure>
<!-- /wp:image --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Infinity Text and Image Columns', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'image', 'genesis-page-builder' ),
		esc_html__( 'infinity', 'genesis-page-builder' ),
		esc_html__( 'infinity text and image columns', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/infinity/gpb_infinity_section_text_and_image_columns.jpg',
];
