<?php
/**
 * Genesis Blocks About Text with Background section for Infinity Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_infinity_section_about_text_with_background',
	'collection' => [
		'slug'                   => 'infinity',
		'label'                  => esc_html__( 'Infinity', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"backgroundImgURL\":\"https://demo.studiopress.com/infinity/wp-content/themes/infinity-pro/images/bg-3.jpg\",\"focalPoint\":{\"x\":\"0.50\",\"y\":\"0.50\"},\"columns\":1,\"layout\":\"gb-1-col-equal\",\"columnsGap\":3,\"align\":\"full\",\"paddingTop\":6,\"paddingRight\":1,\"paddingBottom\":6,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#ffffff\",\"customBackgroundColor\":\"#1f1f1f\",\"columnMaxWidth\":872,\"className\":\"gpb-infinity-section-about-text-with-background \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-infinity-section-about-text-with-background gb-layout-columns-1 gb-1-col-equal gb-background-cover gb-background-no-repeat gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:6em;padding-right:1em;padding-bottom:6em;padding-left:1em;background-color:#1f1f1f;color:#ffffff;background-image:url(https://demo.studiopress.com/infinity/wp-content/themes/infinity-pro/images/bg-3.jpg);background-position:50% 50%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-3 gb-is-responsive-column\" style=\"max-width:872px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"color\":{\"text\":\"#ffffff\"},\"typography\":{\"lineHeight\":\"1.2\",\"fontSize\":48}}} -->
<h2 class=\"has-text-align-center has-text-color\" style=\"color:#ffffff;font-size:48px;line-height:1.2\">We Believe</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"color\":{\"text\":\"#ffffff\"},\"typography\":{\"fontSize\":22}}} -->
<p class=\"has-text-align-center has-text-color\" style=\"color:#ffffff;font-size:22px\">Infinity Pro is the most beautiful theme ever created. With an emphasis on incredible typography and responsive design, it will leave your audience speechless.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {\"contentJustification\":\"center\"} -->
<div class=\"wp-block-buttons is-content-justification-center\"><!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"background\":\"#c44868\",\"text\":\"#ffffff\"}}} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-text-color has-background no-border-radius\" style=\"background-color:#c44868;color:#ffffff\">View Theme Features</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Infinity About Text with Background', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'hero', 'genesis-page-builder' ),
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'cta', 'genesis-page-builder' ),
		esc_html__( 'call to action', 'genesis-page-builder' ),
		esc_html__( 'infinity', 'genesis-page-builder' ),
		esc_html__( 'infinity about text with background', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/infinity/gpb_infinity_section_about_text_with_background.jpg',
];
