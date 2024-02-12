<?php
/**
 * Genesis Blocks Hero Header section for Monochrome Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_monochrome_section_hero_header',
	'collection' => [
		'slug'                   => 'monochrome',
		'label'                  => esc_html__( 'Monochrome', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"backgroundImgURL\":\"https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_hero_header.jpg\",\"backgroundDimRatio\":20,\"focalPoint\":{\"x\":\"0.50\",\"y\":\"0.52\"},\"columns\":1,\"layout\":\"gb-1-col-equal\",\"columnsGap\":3,\"align\":\"full\",\"marginUnit\":\"em\",\"paddingTop\":10,\"paddingRight\":1,\"paddingBottom\":10,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#ffffff\",\"customBackgroundColor\":\"#000000\",\"columnMaxWidth\":1200,\"className\":\"gpb-monochrome-section-hero-header\"} --> <div class=\"wp-block-genesis-blocks-gb-columns gpb-monochrome-section-hero-header gb-layout-columns-1 gb-1-col-equal gb-has-background-dim gb-has-background-dim-20 gb-background-cover gb-background-no-repeat gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:10em;padding-right:1em;padding-bottom:10em;padding-left:1em;background-color:#000000;color:#ffffff;background-image:url(https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_hero_header.jpg);background-position:50% 52%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-3 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"align\":\"left\",\"level\":2,\"style\":{\"typography\":{\"fontSize\":60},\"color\":{\"text\":\"#ffffff\"}}} --> <h2 class=\"has-text-align-left has-text-color\" style=\"font-size:60px;color:#ffffff\">We crush<br>minimal design.</h2> <!-- /wp:heading --> <!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":14},\"color\":{\"text\":\"#ffffff\"}}} --> <p class=\"has-text-color\" style=\"font-size:14px;color:#ffffff\"><strong>Monochrome</strong>&nbsp;is a creative agency based in Chicago. We developed the<br>Genesis Framework and build mobile-optimized themes for WordPress.</p> <!-- /wp:paragraph --></div></div> <!-- /wp:genesis-blocks/gb-column --></div></div> <!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Monochrome Hero Header', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'portfolio', 'genesis-page-builder' ),
		esc_html__( 'agency', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'portfolio', 'genesis-page-builder' ),
		esc_html__( 'agency', 'genesis-page-builder' ),
		esc_html__( 'monochrome', 'genesis-page-builder' ),
		esc_html__( 'monochrome hero header', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_section_hero_header.jpg',
];
