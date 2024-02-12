<?php
/**
 * Genesis Blocks Large Video section for Monochrome Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_monochrome_section_large_video',
	'collection' => [
		'slug'                   => 'monochrome',
		'label'                  => esc_html__( 'Monochrome', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"backgroundImgURL\":\"https://demo.studiopress.com/monochrome/files/2017/04/sample-light-2.jpg\",\"backgroundDimRatio\":20,\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"marginUnit\":\"em\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#ffffff\",\"customBackgroundColor\":\"#000000\",\"columnMaxWidth\":1200,\"className\":\"gpb-monochrome-section-large-video\"} --> <div class=\"wp-block-genesis-blocks-gb-columns gpb-monochrome-section-large-video gb-layout-columns-1 one-column gb-has-background-dim gb-has-background-dim-20 gb-background-cover gb-background-no-repeat gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#000000;color:#ffffff;background-image:url(https://demo.studiopress.com/monochrome/files/2017/04/sample-light-2.jpg)\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-container {\"containerMarginBottom\":5,\"containerMaxWidth\":1600} --> <div style=\"margin-bottom:5%\" class=\"wp-block-genesis-blocks-gb-container gb-block-container\"><div class=\"gb-container-inside\"><div class=\"gb-container-content\" style=\"max-width:1600px\"><!-- wp:heading {\"align\":\"left\",\"style\":{\"typography\":{\"fontSize\":48},\"color\":{\"text\":\"#ffffff\"}}} --> <h2 class=\"has-text-align-left has-text-color\" style=\"font-size:48px;color:#ffffff\">Modern design.</h2> <!-- /wp:heading --> <!-- wp:paragraph {\"align\":\"left\",\"style\":{\"typography\":{\"fontSize\":18}}} --> <p class=\"has-text-align-left\" style=\"font-size:18px\">See how we’re changing the landscape with our technology.</p> <!-- /wp:paragraph --> <!-- wp:separator {\"customColor\":\"#ffffff\",\"className\":\"is-style-wide\"} --> <hr class=\"wp-block-separator has-text-color has-background is-style-wide\" style=\"background-color:#ffffff;color:#ffffff\"/> <!-- /wp:separator --></div></div></div> <!-- /wp:genesis-blocks/gb-container --> <!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"gb-1-col-equal\",\"marginBottom\":3,\"marginUnit\":\"%\"} --> <div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-1 gb-1-col-equal\" style=\"margin-bottom:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:core-embed/youtube {\"url\":\"https://www.youtube.com/watch?v=aEfd7fO7e8I\",\"type\":\"video\",\"providerNameSlug\":\"youtube\",\"className\":\"wp-embed-aspect-16-9 wp-has-aspect-ratio\"} --> <figure class=\"wp-block-embed-youtube wp-block-embed is-type-video is-provider-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio\"><div class=\"wp-block-embed__wrapper\"> https://www.youtube.com/watch?v=aEfd7fO7e8I </div></figure> <!-- /wp:core-embed/youtube --></div></div> <!-- /wp:genesis-blocks/gb-column --></div></div> <!-- /wp:genesis-blocks/gb-columns --></div></div> <!-- /wp:genesis-blocks/gb-column --></div></div> <!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Monochrome Large Video', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'video', 'genesis-page-builder' ),
		esc_html__( 'monochrome', 'genesis-page-builder' ),
		esc_html__( 'monochrome large video', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_section_large_video.jpg',
];
