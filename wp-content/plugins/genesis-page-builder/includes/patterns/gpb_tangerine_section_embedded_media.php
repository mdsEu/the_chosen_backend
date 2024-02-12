<?php
/**
 * Genesis Blocks Embedded Media section for Tangerine Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_tangerine_section_embedded_media',
	'collection' => [
		'slug'                   => 'tangerine',
		'label'                  => esc_html__( 'Tangerine', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-equal\",\"columnsGap\":3,\"align\":\"full\",\"paddingTop\":6,\"paddingRight\":1,\"paddingBottom\":6,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#272c30\",\"customBackgroundColor\":\"#dae0df\",\"columnMaxWidth\":1200,\"className\":\"gpb-tangerine-section-embedded-media gpb-tangerine-embedded-media \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-tangerine-section-embedded-media gpb-tangerine-embedded-media gb-layout-columns-2 gb-2-col-equal gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:6em;padding-right:1em;padding-bottom:6em;padding-left:1em;background-color:#dae0df;color:#272c30\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-3 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:paragraph {\"style\":{\"color\":{\"text\":\"#ea533c\"}},\"className\":\"gpb-mb-1\"} -->
<p class=\"gpb-mb-1 has-text-color\" style=\"color:#ea533c\"><strong>Watch it in action</strong></p>
<!-- /wp:paragraph -->

<!-- wp:heading {\"style\":{\"typography\":{\"fontSize\":38},\"color\":{\"text\":\"#272c30\"}}} -->
<h2 class=\"has-text-color\" style=\"color:#272c30;font-size:38px\">Hit the ground sprinting</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>If a word is worth one word, and a picture is worth a thousand, how many words is 24 frames per second worth? Let us do the math while you kick back and watch our promo.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class=\"wp-block-buttons\"><!-- wp:button {\"borderRadius\":50,\"style\":{\"color\":{\"text\":\"#ffffff\",\"background\":\"#ea533c\"}}} -->
<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-text-color has-background\" style=\"border-radius:50px;background-color:#ea533c;color:#ffffff\">Let's go</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column {\"columnVerticalAlignment\":\"center\"} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column gb-is-vertically-aligned-center\"><div class=\"gb-block-layout-column-inner\"><!-- wp:embed {\"url\":\"https://www.youtube.com/watch?v=sgV5s0-zjTc\",\"type\":\"video\",\"providerNameSlug\":\"youtube\",\"responsive\":true,\"className\":\"wp-embed-aspect-16-9 wp-has-aspect-ratio\"} -->
<figure class=\"wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube wp-embed-aspect-16-9 wp-has-aspect-ratio\"><div class=\"wp-block-embed__wrapper\">
https://www.youtube.com/watch?v=sgV5s0-zjTc
</div></figure>
<!-- /wp:embed --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Tangerine Embedded Media', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'business', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'video', 'genesis-page-builder' ),
		esc_html__( 'button', 'genesis-page-builder' ),
		esc_html__( 'embed', 'genesis-page-builder' ),
		esc_html__( 'tangerine', 'genesis-page-builder' ),
		esc_html__( 'tangerine embedded media', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/tangerine/gpb_tangerine_section_embedded_media.jpg',
];
