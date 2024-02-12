<?php
/**
 * Genesis Blocks Testimonial and Avatar section for Monochrome Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_monochrome_section_testimonial_and_avatar',
	'collection' => [
		'slug'                   => 'monochrome',
		'label'                  => esc_html__( 'Monochrome', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"align\":\"full\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#1f1f1f\",\"customBackgroundColor\":\"#ffffff\",\"columnMaxWidth\":1200,\"className\":\"gpb-monochrome-section-testimonial-and-avatar\"} --> <div class=\"wp-block-genesis-blocks-gb-columns gpb-monochrome-section-testimonial-and-avatar gb-layout-columns-2 gb-2-col-equal gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#ffffff;color:#1f1f1f\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"textAlign\":\"center\",\"columnVerticalAlignment\":\"center\"} --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\" style=\"text-align:center\"><!-- wp:image {\"sizeSlug\":\"large\"} --> <figure class=\"wp-block-image size-large\"><img src=\"https://demo.studiopress.com/page-builder/person-w-1.jpg\" alt=\"\"/></figure> <!-- /wp:image --></div></div> <!-- /wp:genesis-blocks/gb-column --> <!-- wp:genesis-blocks/gb-column {\"textAlign\":\"left\",\"columnVerticalAlignment\":\"center\"} --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\" style=\"text-align:left\"><!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":26}}} --> <p style=\"font-size:26px\"><strong>This team took my product from an idea to a reality in record time. Not only were they easy to work with, but the design they came up with was better than I could have even asked for.</strong></p> <!-- /wp:paragraph --> <!-- wp:paragraph {\"style\":{\"color\":{\"text\":\"#626e81\"}}} --> <p class=\"has-text-color\" style=\"color:#626e81\">- Anne Alpine / Nature First</p> <!-- /wp:paragraph --></div></div> <!-- /wp:genesis-blocks/gb-column --></div></div> <!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Monochrome Testimonial and Avatar', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'testimonial', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'testimonial', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'monochrome', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'monochrome testimonial and avatar', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_section_testimonial_and_avatar.jpg',
];
