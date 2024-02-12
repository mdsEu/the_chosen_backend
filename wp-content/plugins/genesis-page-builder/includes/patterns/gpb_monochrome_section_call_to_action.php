<?php
/**
 * Genesis Blocks Call To Action section for Monochrome Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_monochrome_section_call_to_action',
	'collection' => [
		'slug'                   => 'monochrome',
		'label'                  => esc_html__( 'Monochrome', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:cover {\"minHeight\":132,\"minHeightUnit\":\"px\",\"customGradient\":\"linear-gradient(48deg,rgb(0,106,206) 0%,rgb(2,198,249) 100%)\",\"align\":\"full\",\"className\":\"gpb-monochrome-section-call-to-action \"} -->
<div class=\"wp-block-cover alignfull has-background-dim has-background-gradient gpb-monochrome-section-call-to-action\" style=\"background:linear-gradient(48deg,rgb(0,106,206) 0%,rgb(2,198,249) 100%);min-height:132px\"><div class=\"wp-block-cover__inner-container\"><!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"paddingTop\":3,\"paddingRight\":1,\"paddingBottom\":3,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#ffffff\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-1 one-column gb-has-custom-text-color\" style=\"padding-top:3em;padding-right:1em;padding-bottom:3em;padding-left:1em;color:#ffffff\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":30},\"color\":{\"text\":\"#ffffff\"}}} -->
<h2 class=\"has-text-align-center has-text-color\" style=\"color:#ffffff;font-size:30px\">Hit the ground running with a minimalist look.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Find out how we can bring your site into the future.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {\"contentJustification\":\"center\"} -->
<div class=\"wp-block-buttons is-content-justification-center\"><!-- wp:button {\"borderRadius\":4,\"style\":{\"color\":{\"text\":\"#1f1f1f\",\"background\":\"#ffffff\"}}} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-text-color has-background\" style=\"border-radius:4px;background-color:#ffffff;color:#1f1f1f\">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:cover -->",
	'name'       => esc_html__( 'Monochrome Call To Action', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'cta', 'genesis-page-builder' ),
		esc_html__( 'call to action', 'genesis-page-builder' ),
		esc_html__( 'button', 'genesis-page-builder' ),
		esc_html__( 'monochrome', 'genesis-page-builder' ),
		esc_html__( 'monochrome call to action', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_section_call_to_action.jpg',
];
