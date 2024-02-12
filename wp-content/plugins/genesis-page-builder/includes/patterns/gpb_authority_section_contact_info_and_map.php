<?php
/**
 * Genesis Blocks Contact Info and Map section for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_authority_section_contact_info_and_map',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"backgroundDimRatio\":20,\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"marginUnit\":\"em\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#333333\",\"customBackgroundColor\":\"#ffffff\",\"columnMaxWidth\":1200,\"className\":\"gpb-authority-section-contact-info-and-map \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-authority-section-contact-info-and-map gb-layout-columns-1 one-column gb-has-background-dim gb-has-background-dim-20 gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#ffffff;color:#333333\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"left\",\"style\":{\"typography\":{\"fontSize\":40,\"lineHeight\":\"1.2\"},\"color\":{\"text\":\"#111111\"}}} -->
<h2 class=\"has-text-align-left has-text-color\" style=\"color:#111111;font-size:40px;line-height:1.2\">Contact Us</h2>
<!-- /wp:heading -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-wideright\",\"paddingUnit\":\"em\",\"columnMaxWidth\":1140,\"className\":\"is-style-gpb-authority-right-background\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns is-style-gpb-authority-right-background gb-layout-columns-2 gb-2-col-wideright gb-columns-center\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1140px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:paragraph -->
<p>We’re centrally located in the heart of the tech district. Come find us or reach out to get started on your entrepreneurial journey!</p>
<!-- /wp:paragraph -->

<!-- wp:heading {\"textAlign\":\"left\",\"level\":3,\"style\":{\"typography\":{\"fontSize\":22},\"color\":{\"text\":\"#111111\"}}} -->
<h3 class=\"has-text-align-left has-text-color\" style=\"color:#111111;font-size:22px\">Office</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"left\",\"style\":{\"typography\":{\"fontSize\":18}}} -->
<p class=\"has-text-align-left\" style=\"font-size:18px\">Startup Square<br>123 Block Ave<br>Austin, Texas 36521</p>
<!-- /wp:paragraph -->

<!-- wp:heading {\"textAlign\":\"left\",\"level\":3,\"style\":{\"typography\":{\"fontSize\":22},\"color\":{\"text\":\"#111111\"}}} -->
<h3 class=\"has-text-align-left has-text-color\" style=\"color:#111111;font-size:22px\">Telephone</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"left\",\"style\":{\"typography\":{\"fontSize\":18}}} -->
<p class=\"has-text-align-left\" style=\"font-size:18px\">Tel: 514-281-3821<br>Fax: 514-281-5210</p>
<!-- /wp:paragraph -->

<!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":22},\"color\":{\"text\":\"#111111\"}}} -->
<h3 class=\"has-text-color\" style=\"color:#111111;font-size:22px\">Office Hours</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18}}} -->
<p style=\"font-size:18px\">Mon-Fri: 8am - 5pm<br>Sat: 8am 9pm<br>Sun: 8am - 2pm</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"textAlign\":\"center\",\"paddingRight\":1,\"paddingLeft\":1,\"className\":\"is-style-gpb-border is-style-gpb-shadow\"} -->
<div class=\"wp-block-genesis-blocks-gb-column is-style-gpb-border is-style-gpb-shadow gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\" style=\"padding-right:1px;padding-left:1px;text-align:center\"><!-- wp:html -->
<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3470.5670865756474!2d-95.09152774886842!3d29.558099181973784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86409da671292593%3A0xf684f098a7237a30!2sNASA+Mission+Control+Center!5e0!3m2!1sen!2sus!4v1560875318343!5m2!1sen!2sus\" width=\"80%\" height=\"560\" frameborder=\"0\" allowfullscreen=\"\"></iframe>
<!-- /wp:html --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Authority Contact Info and Map', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'contact', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'contact', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'map', 'genesis-page-builder' ),
		esc_html__( 'location', 'genesis-page-builder' ),
		esc_html__( 'authority contact info map', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority contact info and map', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_section_contact_info_and_map.jpg',
];
