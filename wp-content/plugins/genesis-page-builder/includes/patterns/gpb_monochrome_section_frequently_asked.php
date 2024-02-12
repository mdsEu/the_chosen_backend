<?php
/**
 * Genesis Blocks Frequently Asked section for Monochrome Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_monochrome_section_frequently_asked',
	'collection' => [
		'slug'                   => 'monochrome',
		'label'                  => esc_html__( 'Monochrome', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"marginUnit\":\"em\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#1f1f1f\",\"customBackgroundColor\":\"#ffffff\",\"columnMaxWidth\":1200,\"className\":\"gpb-monochrome-section-frequently-asked\"} --> <div class=\"wp-block-genesis-blocks-gb-columns gpb-monochrome-section-frequently-asked gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#ffffff;color:#1f1f1f\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-container {\"containerMarginBottom\":5,\"containerMaxWidth\":1600} --> <div style=\"margin-bottom:5%\" class=\"wp-block-genesis-blocks-gb-container gb-block-container\"><div class=\"gb-container-inside\"><div class=\"gb-container-content\" style=\"max-width:1600px\"><!-- wp:heading {\"align\":\"left\",\"style\":{\"typography\":{\"fontSize\":48},\"color\":{\"text\":\"#1f1f1f\"}}} --> <h2 class=\"has-text-align-left has-text-color\" style=\"font-size:48px;color:#1f1f1f\">Frequently asked.</h2> <!-- /wp:heading --> <!-- wp:paragraph {\"align\":\"left\",\"style\":{\"typography\":{\"fontSize\":18}}} --> <p class=\"has-text-align-left\" style=\"font-size:18px\">A minimalist approach is the only way to design a website.</p> <!-- /wp:paragraph --> <!-- wp:separator {\"customColor\":\"#1f1f1f\",\"className\":\"is-style-wide\"} --> <hr class=\"wp-block-separator has-text-color has-background is-style-wide\" style=\"background-color:#1f1f1f;color:#1f1f1f\"/> <!-- /wp:separator --></div></div></div> <!-- /wp:genesis-blocks/gb-container --> <!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"marginBottom\":3,\"marginUnit\":\"%\"} --> <div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-2 gb-2-col-equal\" style=\"margin-bottom:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":28},\"color\":{\"text\":\"#1f1f1f\"}}} --> <h3 class=\"has-text-color\" style=\"font-size:28px;color:#1f1f1f\">1. Are you currently hiring?</h3> <!-- /wp:heading --> <!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18}}} --> <p style=\"font-size:18px\">We are currently hiring for design and development roles. Please reach out to us at jobs@theawesomecreative.com for info!</p> <!-- /wp:paragraph --> <!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":28},\"color\":{\"text\":\"#1f1f1f\"}}} --> <h3 class=\"has-text-color\" style=\"font-size:28px;color:#1f1f1f\">2. What are your working hours?</h3> <!-- /wp:heading --> <!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18}}} --> <p style=\"font-size:18px\">We work 9am-6pm, Monday through Friday. Our support reps are available throughout the whole weekend.</p> <!-- /wp:paragraph --></div></div> <!-- /wp:genesis-blocks/gb-column --> <!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":28},\"color\":{\"text\":\"#1f1f1f\"}}} --> <h3 class=\"has-text-color\" style=\"font-size:28px;color:#1f1f1f\">3. Are you accepting new clients?</h3> <!-- /wp:heading --> <!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18}}} --> <p style=\"font-size:18px\">We’re always looking for the opportunity to work on new and exciting products. Send us your project today!</p> <!-- /wp:paragraph --> <!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":28},\"color\":{\"text\":\"#1f1f1f\"}}} --> <h3 class=\"has-text-color\" style=\"font-size:28px;color:#1f1f1f\">4. Do you provide discounts?</h3> <!-- /wp:heading --> <!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18}}} --> <p style=\"font-size:18px\">Our work is priced according to the amount of work and value we provide on delivery. Discounts aren’t necessary.</p> <!-- /wp:paragraph --></div></div> <!-- /wp:genesis-blocks/gb-column --></div></div> <!-- /wp:genesis-blocks/gb-columns --></div></div> <!-- /wp:genesis-blocks/gb-column --></div></div> <!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Monochrome Frequently Asked', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'contact', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'contact', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'faq', 'genesis-page-builder' ),
		esc_html__( 'monochrome', 'genesis-page-builder' ),
		esc_html__( 'monochrome frequently asked', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_section_frequently_asked.jpg',
];
