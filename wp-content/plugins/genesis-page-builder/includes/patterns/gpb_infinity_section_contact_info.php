<?php
/**
 * Genesis Blocks Contact Info section for Infinity Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_infinity_section_contact_info',
	'collection' => [
		'slug'                   => 'infinity',
		'label'                  => esc_html__( 'Infinity', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"backgroundDimRatio\":20,\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"marginUnit\":\"em\",\"paddingTop\":6,\"paddingRight\":1,\"paddingBottom\":6,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#1f1f1f\",\"customBackgroundColor\":\"#ffffff\",\"columnMaxWidth\":1200,\"className\":\"gpb-infinity-section-contact-info \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-infinity-section-contact-info gb-layout-columns-1 one-column gb-has-background-dim gb-has-background-dim-20 gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:6em;padding-right:1em;padding-bottom:6em;padding-left:1em;background-color:#ffffff;color:#1f1f1f\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-container {\"containerMarginBottom\":5,\"containerMaxWidth\":1600} -->
<div style=\"margin-bottom:5%\" class=\"wp-block-genesis-blocks-gb-container gb-block-container\"><div class=\"gb-container-inside\"><div class=\"gb-container-content\" style=\"max-width:1600px\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":48},\"color\":{\"text\":\"#1f1f1f\"}}} -->
<h2 class=\"has-text-align-center has-text-color\" style=\"color:#1f1f1f;font-size:48px\">Contact Us</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":18},\"color\":{\"text\":\"#1f1f1f\"}}} -->
<p class=\"has-text-align-center has-text-color\" style=\"color:#1f1f1f;font-size:18px\">Contact us to get started on your next project!</p>
<!-- /wp:paragraph --></div></div></div>
<!-- /wp:genesis-blocks/gb-container -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":4,\"layout\":\"gb-4-col-equal\",\"marginBottom\":3,\"marginUnit\":\"%\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-4 gb-4-col-equal\" style=\"margin-bottom:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":22},\"color\":{\"text\":\"#1f1f1f\"}}} -->
<h3 class=\"has-text-color\" style=\"color:#1f1f1f;font-size:22px\">Office</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18}}} -->
<p style=\"font-size:18px\">Startup Square<br>123 Block Ave<br>Austin, Texas 36521</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":22},\"color\":{\"text\":\"#1f1f1f\"}}} -->
<h3 class=\"has-text-color\" style=\"color:#1f1f1f;font-size:22px\">Office Hours</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18}}} -->
<p style=\"font-size:18px\">Mon-Fri: 8am - 5pm<br>Sat: 8am 9pm<br>Sun: 8am - 2pm</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":22},\"color\":{\"text\":\"#1f1f1f\"}}} -->
<h3 class=\"has-text-color\" style=\"color:#1f1f1f;font-size:22px\">Email</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18}}} -->
<p style=\"font-size:18px\">hello@example.com sales@example.com support@example.com</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":22},\"color\":{\"text\":\"#1f1f1f\"}}} -->
<h3 class=\"has-text-color\" style=\"color:#1f1f1f;font-size:22px\">Telephone</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18}}} -->
<p style=\"font-size:18px\">Tel: 514-281-3821<br>Fax: 514-281-5210</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Infinity Contact Info', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'contact', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'contact', 'genesis-page-builder' ),
		esc_html__( 'team', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'infinity', 'genesis-page-builder' ),
		esc_html__( 'infinity contact info', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/infinity/gpb_infinity_section_contact_info.jpg',
];
