<?php
/**
 * Genesis Blocks Blog Posts section for Monochrome Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_monochrome_section_blog_posts',
	'collection' => [
		'slug'                   => 'monochrome',
		'label'                  => esc_html__( 'Monochrome', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"marginUnit\":\"em\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#1f1f1f\",\"customBackgroundColor\":\"#ffffff\",\"columnMaxWidth\":1200,\"className\":\"gpb-monochrome-section-blog-posts\"} --> <div class=\"wp-block-genesis-blocks-gb-columns gpb-monochrome-section-blog-posts gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#ffffff;color:#1f1f1f\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column --> <div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-container {\"containerMarginBottom\":0,\"containerMaxWidth\":1200} --> <div class=\"wp-block-genesis-blocks-gb-container gb-block-container\"><div class=\"gb-container-inside\"><div class=\"gb-container-content\" style=\"max-width:1200px\"><!-- wp:heading {\"align\":\"left\",\"style\":{\"typography\":{\"fontSize\":48},\"color\":{\"text\":\"#1f1f1f\"}}} --> <h2 class=\"has-text-align-left has-text-color\" style=\"font-size:48px;color:#1f1f1f\">We create stories.</h2> <!-- /wp:heading --> <!-- wp:paragraph {\"align\":\"left\",\"style\":{\"typography\":{\"fontSize\":18}}} --> <p class=\"has-text-align-left\" style=\"font-size:18px\">A killer narrative will turn your readers into raving fans.</p> <!-- /wp:paragraph --> <!-- wp:separator {\"customColor\":\"#1f1f1f\",\"className\":\"is-style-wide\"} --> <hr class=\"wp-block-separator has-text-color has-background is-style-wide\" style=\"background-color:#1f1f1f;color:#1f1f1f\"/> <!-- /wp:separator --> <!-- wp:genesis-blocks/gb-post-grid {\"postsToShow\":4,\"displayPostExcerpt\":false,\"displayPostLink\":false,\"postTitleTag\":\"h2\"} /--></div></div></div> <!-- /wp:genesis-blocks/gb-container --></div></div> <!-- /wp:genesis-blocks/gb-column --></div></div> <!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Monochrome Blog Posts', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'blog', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'posts', 'genesis-page-builder' ),
		esc_html__( 'blog', 'genesis-page-builder' ),
		esc_html__( 'monochrome', 'genesis-page-builder' ),
		esc_html__( 'monochrome blog posts', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/monochrome/gpb_monochrome_section_blog_posts.jpg',
];
