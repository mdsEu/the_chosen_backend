<?php
/**
 * Genesis Blocks Testimonials section for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_authority_section_testimonials',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#333333\",\"customBackgroundColor\":\"#f4f4f4\",\"columnMaxWidth\":1200,\"className\":\"gpb-authority-section-testimonials \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-authority-section-testimonials gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#f4f4f4;color:#333333\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-container {\"containerMarginBottom\":5,\"containerMaxWidth\":700} -->
<div style=\"margin-bottom:5%\" class=\"wp-block-genesis-blocks-gb-container gb-block-container\"><div class=\"gb-container-inside\"><div class=\"gb-container-content\" style=\"max-width:700px\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":14},\"color\":{\"text\":\"#707070\"}}} -->
<h2 class=\"has-text-align-center has-text-color\" style=\"color:#707070;font-size:14px\"><em>What people are saying…</em></h2>
<!-- /wp:heading --></div></div></div>
<!-- /wp:genesis-blocks/gb-container -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":3,\"layout\":\"gb-3-col-equal\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-3 gb-3-col-equal\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column {\"customBackgroundColor\":\"#ffffff\",\"padding\":15} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner gb-has-custom-background-color\" style=\"background-color:#ffffff\"><!-- wp:genesis-blocks/gb-testimonial {\"testimonialImgID\":10230,\"testimonialBackgroundColor\":\"#ffffff\",\"testimonialTextColor\":\"#333333\"} -->
<div style=\"background-color:#ffffff;color:#333333\" class=\"wp-block-genesis-blocks-gb-testimonial left-aligned gb-has-avatar gb-font-size-18 gb-block-testimonial\"><div class=\"gb-testimonial-text\"><p>“ <em>I was skeptical but I found that your system had multiplied my revenue by 40% after just the first quarter!</em></p></div><div class=\"gb-testimonial-info\"><div class=\"gb-testimonial-avatar-wrap\"><div class=\"gb-testimonial-image-wrap\"><img class=\"gb-testimonial-avatar\" src=\"https://demo.studiopress.com/page-builder/person-w-4.jpg\" alt=\"avatar\"/></div></div><h2 class=\"gb-testimonial-name\" style=\"color:#333333\">Mary Sequoia</h2><small class=\"gb-testimonial-title\" style=\"color:#333333\">Author</small></div></div>
<!-- /wp:genesis-blocks/gb-testimonial --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"customBackgroundColor\":\"#ffffff\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner gb-has-custom-background-color\" style=\"background-color:#ffffff\"><!-- wp:genesis-blocks/gb-testimonial {\"testimonialImgID\":10211,\"testimonialBackgroundColor\":\"#ffffff\"} -->
<div style=\"background-color:#ffffff;color:#32373c\" class=\"wp-block-genesis-blocks-gb-testimonial left-aligned gb-has-avatar gb-font-size-18 gb-block-testimonial\"><div class=\"gb-testimonial-text\"><p>“ <em>We started using just one email marketing technique from this system and it helped us to make $5,000 more a month without any extra work!</em></p></div><div class=\"gb-testimonial-info\"><div class=\"gb-testimonial-avatar-wrap\"><div class=\"gb-testimonial-image-wrap\"><img class=\"gb-testimonial-avatar\" src=\"https://demo.studiopress.com/page-builder/person-m-1.jpg\" alt=\"avatar\"/></div></div><h2 class=\"gb-testimonial-name\" style=\"color:#32373c\">Philip Glacier</h2><small class=\"gb-testimonial-title\" style=\"color:#32373c\">Publisher</small></div></div>
<!-- /wp:genesis-blocks/gb-testimonial --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"customBackgroundColor\":\"#ffffff\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner gb-has-custom-background-color\" style=\"background-color:#ffffff\"><!-- wp:genesis-blocks/gb-testimonial {\"testimonialImgID\":10230,\"testimonialBackgroundColor\":\"#ffffff\"} -->
<div style=\"background-color:#ffffff;color:#32373c\" class=\"wp-block-genesis-blocks-gb-testimonial left-aligned gb-has-avatar gb-font-size-18 gb-block-testimonial\"><div class=\"gb-testimonial-text\"><p>“ <em>This course helped me to grow my email list from 500 to over 10,000 subscribers within 3 months!</em></p></div><div class=\"gb-testimonial-info\"><div class=\"gb-testimonial-avatar-wrap\"><div class=\"gb-testimonial-image-wrap\"><img class=\"gb-testimonial-avatar\" src=\"https://demo.studiopress.com/page-builder/person-w-3.jpg\" alt=\"avatar\"/></div></div><h2 class=\"gb-testimonial-name\" style=\"color:#32373c\">Amy Redwood</h2><small class=\"gb-testimonial-title\" style=\"color:#32373c\">Consultant</small></div></div>
<!-- /wp:genesis-blocks/gb-testimonial --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Authority Testimonials', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'testimonial', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'testimonial', 'genesis-page-builder' ),
		esc_html__( 'quote', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority testimonials', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_section_testimonials.jpg',
];
