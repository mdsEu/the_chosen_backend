<?php
/**
 * Genesis Blocks Text / Image Columns section for Altitude Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_altitude_section_text_image_columns',
	'collection' => [
		'slug'                   => 'altitude',
		'label'                  => esc_html__( 'Altitude', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"align\":\"full\",\"paddingTop\":6,\"paddingRight\":1,\"paddingBottom\":6,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#1f1f1f\",\"customBackgroundColor\":\"#ededed\",\"columnMaxWidth\":1200,\"className\":\"gpb-altitude-section-text-image-columns\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-altitude-section-text-image-columns gb-layout-columns-2 gb-2-col-equal gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:6em;padding-right:1em;padding-bottom:6em;padding-left:1em;background-color:#ededed;color:#1f1f1f\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"style\":{\"color\":{\"text\":\"#000000\"},\"typography\":{\"fontSize\":28}}} -->
<h2 class=\"has-text-color\" style=\"color:#000000;font-size:28px\">Start with a good design.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We help creative entrepreneurs build their digital business by focusing on three key elements of a successful online platform.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {\"style\":{\"color\":{\"text\":\"#000000\"},\"typography\":{\"fontSize\":28}}} -->
<h2 class=\"has-text-color\" style=\"color:#000000;font-size:28px\">Create sticky content.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Our team will teach you the art of writing audience-focused content that will help you achieve the success you truly deserve.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {\"style\":{\"color\":{\"text\":\"#000000\"},\"typography\":{\"fontSize\":28}}} -->
<h2 class=\"has-text-color\" style=\"color:#000000;font-size:28px\">Refine your strategy.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>We help creative entrepreneurs build their digital business by focusing on three key elements of a successful online platform.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:image {\"width\":582,\"height\":392,\"sizeSlug\":\"large\"} -->
<figure class=\"wp-block-image size-large is-resized\"><img src=\"https://demo.studiopress.com/page-builder/altitude-computer.jpg\" alt=\"\" width=\"582\" height=\"392\"/></figure>
<!-- /wp:image --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Altitude Text / Image Columns', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'portfolio', 'genesis-page-builder' ),
		esc_html__( 'team', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'text', 'genesis-page-builder' ),
		esc_html__( 'images', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'altitude', 'genesis-page-builder' ),
		esc_html__( 'altitude text image columns', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/altitude/gpb_altitude_section_text_image_columns.jpg',
];
