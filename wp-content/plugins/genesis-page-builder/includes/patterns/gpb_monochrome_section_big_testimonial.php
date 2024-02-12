<?php
/**
 * Genesis Blocks Big Testimonial section for Monochrome Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_monochrome_section_big_testimonial',
	'collection' => [
		'slug'                   => 'monochrome',
		'label'                  => esc_html__( 'Monochrome', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"backgroundDimRatio\":30,\"focalPoint\":{\"x\":\"0.50\",\"y\":\"0.52\"},\"columns\":1,\"layout\":\"gb-1-col-equal\",\"columnsGap\":3,\"align\":\"full\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#1f1f1f\",\"customBackgroundColor\":\"#ffffff\",\"columnMaxWidth\":872,\"className\":\"gpb-monochrome-section-big-testimonial\"} --> <div class=\"wp-block-genesis-blocks-gb-columns gpb-monochrome-section-big-testimonial gb-layout-columns-1 gb-1-col-equal gb-has-background-dim gb-has-background-dim-30 gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#ffffff;color:#1f1f1f;background-position:50% 52%\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-3 gb-is-responsive-column\" style=\"max-width:872px\"><!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":40}}} --> <p class=\"has-text-align-center\" style=\"font-size:40px\"><strong>With an emphasis on typography, white space, and mobile-optimized design, your website will look absolutely breathtaking. And Genesis can help you get there quicker.</strong></p> <!-- /wp:paragraph --> <!-- wp:paragraph {\"align\":\"center\"} --> <p class=\"has-text-align-center\">Anna Alpine / Helvetico<strong> </strong></p> <!-- /wp:paragraph --></div></div> <!-- /wp:genesis-blocks/gb-column --></div></div> <!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Monochrome Big Testimonial', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'testimonial', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'testimonial', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'monochrome', 'genesis-page-builder' ),
		esc_html__( 'monochrome big testimonial', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_section_big_testimonial.jpg',
];
