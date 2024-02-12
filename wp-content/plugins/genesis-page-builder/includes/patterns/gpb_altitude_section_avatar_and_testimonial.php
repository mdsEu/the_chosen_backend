<?php
/**
 * Genesis Blocks Avatar and Testimonial section for Altitude Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_altitude_section_avatar_and_testimonial',
	'collection' => [
		'slug'                   => 'altitude',
		'label'                  => esc_html__( 'Altitude', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"backgroundImgURL\":\"https://demo.studiopress.com/altitude/wp-content/themes/altitude-pro/images/bg-5.jpg\",\"backgroundDimRatio\":50,\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":6,\"paddingRight\":1,\"paddingBottom\":6,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#ffffff\",\"customBackgroundColor\":\"#1c201f\",\"columnMaxWidth\":800,\"className\":\"gpb-altitude-section-avatar-and-testimonial\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-altitude-section-avatar-and-testimonial gb-layout-columns-1 one-column gb-has-background-dim gb-has-background-dim-50 gb-background-cover gb-background-no-repeat gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:6em;padding-right:1em;padding-bottom:6em;padding-left:1em;background-color:#1c201f;color:#ffffff;background-image:url(https://demo.studiopress.com/altitude/wp-content/themes/altitude-pro/images/bg-5.jpg)\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:800px\"><!-- wp:genesis-blocks/gb-column {\"textAlign\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\" style=\"text-align:center\"><!-- wp:image {\"align\":\"center\",\"width\":198,\"height\":198,\"sizeSlug\":\"large\",\"className\":\"is-style-rounded\"} -->
<div class=\"wp-block-image is-style-rounded\"><figure class=\"aligncenter size-large is-resized\"><img src=\"https://demo.studiopress.com/page-builder/person-m-3.jpg\" alt=\"\" width=\"198\" height=\"198\"/></figure></div>
<!-- /wp:image -->

<!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":22,\"lineHeight\":\"1.4\"}},\"textColor\":\"white\"} -->
<p class=\"has-white-color has-text-color\" style=\"font-size:22px;line-height:1.4\">My new site is so much faster and easier to work with than my old site. It used to take me an hour or more to update a page. Now I can choose from pre-design sections and layouts and have a page done in minutes, not hours.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {\"style\":{\"color\":{\"text\":\"#b6b6b6\"}}} -->
<p class=\"has-text-color\" style=\"color:#b6b6b6\">– Phil Conners</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Altitude Avatar and Testimonial', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'header', 'genesis-page-builder' ),
		esc_html__( 'team', 'genesis-page-builder' ),
		esc_html__( 'testimonial', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'testimonial', 'genesis-page-builder' ),
		esc_html__( 'comment', 'genesis-page-builder' ),
		esc_html__( 'avatar', 'genesis-page-builder' ),
		esc_html__( 'user', 'genesis-page-builder' ),
		esc_html__( 'quote', 'genesis-page-builder' ),
		esc_html__( 'customer', 'genesis-page-builder' ),
		esc_html__( 'altitude', 'genesis-page-builder' ),
		esc_html__( 'altitude avatar and testimonial', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/altitude/gpb_altitude_section_avatar_and_testimonial.jpg',
];
