<?php
/**
 * Genesis Blocks Blog Posts section for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_authority_section_blog_posts',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"customTextColor\":\"#333333\",\"customBackgroundColor\":\"#ffffff\",\"className\":\"gpb-authority-section-blog-posts \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-authority-section-blog-posts gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color alignfull\" style=\"background-color:#ffffff;color:#333333\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"columnMaxWidth\":1200} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-1 one-column gb-columns-center\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:separator {\"customColor\":\"#eeeeee\",\"className\":\"is-style-wide\"} -->
<hr class=\"wp-block-separator has-text-color has-background is-style-wide\" style=\"background-color:#eeeeee;color:#eeeeee\"/>
<!-- /wp:separator --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#333333\",\"customBackgroundColor\":\"#ffffff\",\"columnMaxWidth\":1200} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#ffffff;color:#333333\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:heading {\"style\":{\"typography\":{\"fontSize\":40,\"lineHeight\":\"1.2\"},\"color\":{\"text\":\"#111111\"}}} -->
<h2 class=\"has-text-color\" style=\"color:#111111;font-size:40px;line-height:1.2\">The Blog</h2>
<!-- /wp:heading -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":2,\"layout\":\"gb-2-col-wideleft\",\"columnMaxWidth\":1140} -->
<div class=\"wp-block-genesis-blocks-gb-columns gb-layout-columns-2 gb-2-col-wideleft gb-columns-center\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1140px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:paragraph -->
<p>Build your authority by reading the premier publishing resource for online marketers and creative entrepreneurs.</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:genesis-blocks/gb-column -->

<!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:buttons {\"contentJustification\":\"right\"} -->
<div class=\"wp-block-buttons is-content-justification-right\"><!-- wp:button {\"borderRadius\":0,\"style\":{\"color\":{\"text\":\"#000cff\"}},\"className\":\"is-style-outline\"} -->
<div class=\"wp-block-button is-style-outline\"><a class=\"wp-block-button__link has-text-color no-border-radius\" style=\"color:#000cff\">Read More Blog Posts</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->

<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"paddingTop\":4,\"paddingUnit\":\"em\",\"columnMaxWidth\":1140,\"className\":\"gpb-authority-blog-posts\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-authority-blog-posts gb-layout-columns-1 one-column gb-columns-center\" style=\"padding-top:4em\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1140px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-post-grid {\"className\":\"gpb-authority-section-blog-posts \",\"postsToShow\":3,\"columns\":3,\"readMoreText\":\"Continue Reading →\",\"excerptLength\":17,\"sectionTag\":\"div\",\"imageSize\":\"large\"} /--></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Authority Blog Posts', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'blog', 'genesis-page-builder' ),
		esc_html__( 'posts', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'blog', 'genesis-page-builder' ),
		esc_html__( 'posts', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority blog posts', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_section_blog_posts.jpg',
];
