<?php
/**
 * Genesis Blocks Tablet and Call To Action section for Altitude Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_altitude_section_tablet_and_call_to_action',
	'collection' => [
		'slug'                   => 'altitude',
		'label'                  => esc_html__( 'Altitude', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"backgroundDimRatio\":20,\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":6,\"paddingRight\":1,\"paddingBottom\":6,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#1f1f1f\",\"customBackgroundColor\":\"#ffffff\",\"columnMaxWidth\":1200,\"className\":\"gpb-altitude-section-tablet-and-call-to-action \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-altitude-section-tablet-and-call-to-action gb-layout-columns-1 one-column gb-has-background-dim gb-has-background-dim-20 gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:6em;padding-right:1em;padding-bottom:6em;padding-left:1em;background-color:#ffffff;color:#1f1f1f\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"customTextColor\":\"#ffffff\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-2 gb-2-col-equal gb-has-custom-text-color\" style=\"color:#ffffff\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-page-builder/gpb-devices {\"backgroundImgURL\":\"https://demo.studiopress.com/page-builder/gb-monochrome-tablet.jpg\",\"deviceType\":\"gpb-device-tablet\",\"deviceColor\":\"gpb-device-black\",\"deviceMaxWidth\":500,\"deviceAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-page-builder-gpb-devices gpb-device-mockup gpb-device-align-center\" style=\"max-width:500px\"><div class=\"gpb-device-tablet gb-background-cover gb-background-no-repeat\" style=\"background-image:url(https://demo.studiopress.com/page-builder/gb-monochrome-tablet.jpg)\"></div></div>
<!-- /wp:genesis-page-builder/gpb-devices --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"customTextColor\":\"#ffffff\",\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner gb-has-custom-text-color\" style=\"color:#ffffff\"><!-- wp:heading {\"style\":{\"color\":{\"text\":\"#1f1f1f\"},\"typography\":{\"fontSize\":48}}} -->
<h2 class=\"has-text-color\" style=\"color:#1f1f1f;font-size:48px\">The Next Generation Website Solution</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"style\":{\"color\":{\"text\":\"#1f1f1f\"}}} -->
<p class=\"has-text-color\" style=\"color:#1f1f1f\">Use this mobile and tablet device mockup to show off your latest and greatest apps and mobile-friendly designs. The mockup block comes with settings to change the device type (phone or tablet) color, orientation, max-width, border width, image, and more!</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class=\"wp-block-buttons\"><!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"background\":\"#1f1f1f\",\"text\":\"#ffffff\"}}} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-text-color has-background no-border-radius\" style=\"background-color:#1f1f1f;color:#ffffff\">Learn More</a></div>
<!-- /wp:button -->

<!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"background\":\"#0680a2\",\"text\":\"#ffffff\"}}} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-text-color has-background no-border-radius\" style=\"background-color:#0680a2;color:#ffffff\">Buy Today</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Altitude Tablet and Call To Action', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
		esc_html__( 'portfolio', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'device', 'genesis-page-builder' ),
		esc_html__( 'tablet', 'genesis-page-builder' ),
		esc_html__( 'ipad', 'genesis-page-builder' ),
		esc_html__( 'screenshot', 'genesis-page-builder' ),
		esc_html__( 'altitude', 'genesis-page-builder' ),
		esc_html__( 'altitude tablet and call to action', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/altitude/gpb_altitude_section_tablet_and_call_to_action.jpg',
];
