<?php
/**
 * Genesis Blocks Image Gallery section for Monochrome Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_monochrome_section_image_gallery',
	'collection' => [
		'slug'                   => 'monochrome',
		'label'                  => esc_html__( 'Monochrome', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"marginUnit\":\"em\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#ffffff\",\"customBackgroundColor\":\"#1f1f1f\",\"columnMaxWidth\":1200,\"className\":\"gpb-monochrome-section-image-gallery\"} --> <div class=\"wp-block-genesis-blocks-gb-columns gpb-monochrome-section-image-gallery gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#1f1f1f;color:#ffffff\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-container {\"containerMarginBottom\":5,\"containerMaxWidth\":1600} --> <div style=\"margin-bottom:5%\" class=\"wp-block-genesis-blocks-gb-container gb-block-container\"><div class=\"gb-container-inside\"><div class=\"gb-container-content\" style=\"max-width:1600px\"><!-- wp:heading {\"align\":\"left\",\"style\":{\"typography\":{\"fontSize\":48},\"color\":{\"text\":\"#ffffff\"}}} --> <h2 class=\"has-text-align-left has-text-color\" style=\"font-size:48px;color:#ffffff\">A visual tour.</h2> <!-- /wp:heading --> <!-- wp:paragraph {\"align\":\"left\",\"style\":{\"typography\":{\"fontSize\":18}}} --> <p class=\"has-text-align-left\" style=\"font-size:18px\">A minimalist approach is the only way to design a website.</p> <!-- /wp:paragraph --> <!-- wp:separator {\"customColor\":\"#ffffff\",\"className\":\"is-style-wide\"} --> <hr class=\"wp-block-separator has-text-color has-background is-style-wide\" style=\"background-color:#ffffff;color:#ffffff\"/> <!-- /wp:separator --></div></div></div> <!-- /wp:genesis-blocks/gb-container --> <!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"marginBottom\":3,\"marginUnit\":\"%\"} --> <div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-2 gb-2-col-equal\" style=\"margin-bottom:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"top\"} --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-top\"><div class=\"gb-block-layout-column-inner\"><!-- wp:image {\"sizeSlug\":\"large\"} --> <figure class=\"wp-block-image size-large\"><img src=\"https://demo.studiopress.com/page-builder/monochrome/curved-building.jpg\" alt=\"\"/></figure> <!-- /wp:image --></div></div> <!-- /wp:genesis-blocks/gb-column --> <!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:image {\"sizeSlug\":\"large\"} --> <figure class=\"wp-block-image size-large\"><img src=\"https://demo.studiopress.com/page-builder/monochrome/spiral-image-2.jpg\" alt=\"\"/></figure> <!-- /wp:image --> <!-- wp:image {\"sizeSlug\":\"large\"} --> <figure class=\"wp-block-image size-large\"><img src=\"https://demo.studiopress.com/page-builder/monochrome/spiral-image-3.jpg\" alt=\"\"/></figure> <!-- /wp:image --></div></div> <!-- /wp:genesis-blocks/gb-column --></div></div> <!-- /wp:genesis-blocks/gb-columns --></div></div> <!-- /wp:genesis-blocks/gb-column --></div></div> <!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Monochrome Image Gallery', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'portfolio', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'portfolio', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'gallery', 'genesis-page-builder' ),
		esc_html__( 'monochrome', 'genesis-page-builder' ),
		esc_html__( 'monochrome image gallery', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_section_image_gallery.jpg',
];
