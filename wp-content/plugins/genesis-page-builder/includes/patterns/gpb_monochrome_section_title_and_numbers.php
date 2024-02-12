<?php
/**
 * Genesis Blocks Title and Numbers section for Monochrome Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_monochrome_section_title_and_numbers',
	'collection' => [
		'slug'                   => 'monochrome',
		'label'                  => esc_html__( 'Monochrome', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"marginUnit\":\"em\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#ffffff\",\"customBackgroundColor\":\"#1f1f1f\",\"columnMaxWidth\":1200,\"className\":\"gpb-monochrome-section-title-and-numbers\"} --> <div class=\"wp-block-genesis-blocks-gb-columns gpb-monochrome-section-title-and-numbers gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#1f1f1f;color:#ffffff\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-container {\"containerMarginBottom\":5,\"containerMaxWidth\":1600} --> <div style=\"margin-bottom:5%\" class=\"wp-block-genesis-blocks-gb-container gb-block-container\"><div class=\"gb-container-inside\"><div class=\"gb-container-content\" style=\"max-width:1600px\"><!-- wp:heading {\"align\":\"left\",\"style\":{\"typography\":{\"fontSize\":48},\"color\":{\"text\":\"#ffffff\"}}} --> <h2 class=\"has-text-align-left has-text-color\" style=\"font-size:48px;color:#ffffff\">By the numbers.</h2> <!-- /wp:heading --> <!-- wp:paragraph {\"align\":\"left\",\"style\":{\"typography\":{\"fontSize\":18},\"color\":{\"text\":\"#ffffff\"}}} --> <p class=\"has-text-align-left has-text-color\" style=\"font-size:18px;color:#ffffff\">We have the numbers to back up our operation.</p> <!-- /wp:paragraph --> <!-- wp:separator {\"customColor\":\"#ffffff\",\"className\":\"is-style-wide\"} --> <hr class=\"wp-block-separator has-text-color has-background is-style-wide\" style=\"background-color:#ffffff;color:#ffffff\"/> <!-- /wp:separator --></div></div></div> <!-- /wp:genesis-blocks/gb-container --> <!-- wp:genesis-blocks/gb-columns {\"columns\":4,\"layout\":\"gb-4-col-equal\",\"marginBottom\":3,\"marginUnit\":\"%\"} --> <div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-4 gb-4-col-equal\" style=\"margin-bottom:3%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":60},\"color\":{\"text\":\"#ffffff\"}}} --> <h3 class=\"has-text-color\" style=\"font-size:60px;color:#ffffff\">12</h3> <!-- /wp:heading --> <!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18},\"color\":{\"text\":\"#c4c6ca\"}}} --> <p class=\"has-text-color\" style=\"font-size:18px;color:#c4c6ca\">Team Members</p> <!-- /wp:paragraph --></div></div> <!-- /wp:genesis-blocks/gb-column --> <!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":60},\"color\":{\"text\":\"#ffffff\"}}} --> <h3 class=\"has-text-color\" style=\"font-size:60px;color:#ffffff\">200k</h3> <!-- /wp:heading --> <!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18},\"color\":{\"text\":\"#c4c6ca\"}}} --> <p class=\"has-text-color\" style=\"font-size:18px;color:#c4c6ca\">Product Downloads</p> <!-- /wp:paragraph --></div></div> <!-- /wp:genesis-blocks/gb-column --> <!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":60},\"color\":{\"text\":\"#ffffff\"}}} --> <h3 class=\"has-text-color\" style=\"font-size:60px;color:#ffffff\">120</h3> <!-- /wp:heading --> <!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":18},\"color\":{\"text\":\"#c4c6ca\"}}} --> <p class=\"has-text-color\" style=\"font-size:18px;color:#c4c6ca\">Amazing Clients</p> <!-- /wp:paragraph --></div></div> <!-- /wp:genesis-blocks/gb-column --> <!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"level\":3,\"style\":{\"typography\":{\"fontSize\":60},\"color\":{\"text\":\"#ffffff\"}}} --> <h3 class=\"has-text-color\" style=\"font-size:60px;color:#ffffff\">$58k</h3> <!-- /wp:heading --> <!-- wp:paragraph {\"style\":{\"color\":{\"text\":\"#c4c6ca\"}}} --> <p class=\"has-text-color\" style=\"color:#c4c6ca\">Donated To Charity</p> <!-- /wp:paragraph --></div></div> <!-- /wp:genesis-blocks/gb-column --></div></div> <!-- /wp:genesis-blocks/gb-columns --></div></div> <!-- /wp:genesis-blocks/gb-column --></div></div> <!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Monochrome Title and Numbers', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'team', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'numbers', 'genesis-page-builder' ),
		esc_html__( 'monochrome', 'genesis-page-builder' ),
		esc_html__( 'monochrome title and numbers', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_section_title_and_numbers.jpg',
];
