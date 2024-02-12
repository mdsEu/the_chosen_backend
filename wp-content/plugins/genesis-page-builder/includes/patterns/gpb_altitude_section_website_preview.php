<?php
/**
 * Genesis Blocks Website Preview section for Altitude Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_altitude_section_website_preview',
	'collection' => [
		'slug'                   => 'altitude',
		'label'                  => esc_html__( 'Altitude', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"backgroundDimRatio\":50,\"focalPoint\":{\"x\":\"0.50\",\"y\":\"0.06\"},\"columns\":1,\"layout\":\"gb-1-col-equal\",\"columnsGap\":0,\"align\":\"full\",\"paddingTop\":6,\"paddingRight\":1,\"paddingBottom\":6,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#1f1f1f\",\"customBackgroundColor\":\"#ffffff\",\"columnMaxWidth\":922,\"className\":\"gpb-altitude-section-website-preview\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-altitude-section-website-preview gb-layout-columns-1 gb-1-col-equal gb-has-background-dim gb-has-background-dim-50 gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:6em;padding-right:1em;padding-bottom:6em;padding-left:1em;background-color:#ffffff;color:#1f1f1f;background-position:50% 6%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-0 gb-is-responsive-column\" style=\"max-width:922px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":18},\"color\":{\"text\":\"#767676\"}}} -->
<h2 class=\"has-text-align-center has-text-color\" style=\"color:#767676;font-size:18px\">Get Altitude</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":48,\"lineHeight\":\"1.2\"},\"color\":{\"text\":\"#1f1f1f\"}}} -->
<p class=\"has-text-align-center has-text-color\" style=\"color:#1f1f1f;font-size:48px;line-height:1.2\"><strong>The Next Generation<br>Website Solution</strong></p>
<!-- /wp:paragraph -->

<!-- wp:spacer {\"height\":20} -->
<div style=\"height:20px\" aria-hidden=\"true\" class=\"wp-block-spacer\"></div>
<!-- /wp:spacer -->

<!-- wp:genesis-page-builder/gpb-devices {\"backgroundImgURL\":\"https://demo.studiopress.com/page-builder/gb-monochrome-tablet.jpg\",\"focalPoint\":{\"x\":\"0.50\",\"y\":\"0.00\"},\"deviceType\":\"gpb-device-tablet\",\"deviceOrientation\":\"gpb-device-horizontal\",\"deviceMaxWidth\":922,\"deviceBorder\":1.34,\"deviceBorderRadius\":28,\"deviceAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-page-builder-gpb-devices gpb-device-mockup gpb-device-align-center\" style=\"max-width:922px\"><div class=\"gpb-device-tablet gpb-device-horizontal gb-background-cover gb-background-no-repeat\" style=\"border-width:1.34em;border-radius:28px;background-image:url(https://demo.studiopress.com/page-builder/gb-monochrome-tablet.jpg);background-position:50% 0%\"></div></div>
<!-- /wp:genesis-page-builder/gpb-devices --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Altitude Website Preview', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'portfolio', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'device', 'genesis-page-builder' ),
		esc_html__( 'website', 'genesis-page-builder' ),
		esc_html__( 'ipad', 'genesis-page-builder' ),
		esc_html__( 'tablet', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'altitude', 'genesis-page-builder' ),
		esc_html__( 'altitude website preview', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/altitude/gpb_altitude_section_website_preview.jpg',
];
