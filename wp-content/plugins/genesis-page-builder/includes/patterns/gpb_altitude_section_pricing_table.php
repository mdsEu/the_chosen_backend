<?php
/**
 * Genesis Blocks Pricing Table section for Altitude Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_altitude_section_pricing_table',
	'collection' => [
		'slug'                   => 'altitude',
		'label'                  => esc_html__( 'Altitude', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":6,\"paddingRight\":1,\"paddingBottom\":6,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#1f1f1f\",\"customBackgroundColor\":\"#f3f3f3\",\"columnMaxWidth\":1200,\"className\":\"gpb-altitude-section-pricing-table\"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-altitude-section-pricing-table gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:6em;padding-right:1em;padding-bottom:6em;padding-left:1em;background-color:#f3f3f3;color:#1f1f1f\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\"><!-- wp:genesis-blocks/gb-container {\"containerMarginBottom\":5,\"containerMaxWidth\":750} -->
<div style=\"margin-bottom:5%\" class=\"wp-block-genesis-blocks-gb-container gb-block-container\"><div class=\"gb-container-inside\"><div class=\"gb-container-content\" style=\"max-width:750px\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"typography\":{\"fontSize\":18},\"color\":{\"text\":\"#767676\"}}} -->
<h2 class=\"has-text-align-center has-text-color\" style=\"color:#767676;font-size:18px\">Simple Pricing</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"typography\":{\"fontSize\":48,\"lineHeight\":\"1.2\"},\"color\":{\"text\":\"#1f1f1f\"}}} -->
<p class=\"has-text-align-center has-text-color\" style=\"color:#1f1f1f;font-size:48px;line-height:1.2\"><strong>Find a simple price that’s<br>right for you.</strong></p>
<!-- /wp:paragraph --></div></div></div>
<!-- /wp:genesis-blocks/gb-container -->

<!-- wp:genesis-blocks/gb-pricing {\"columns\":3} -->
<div class=\"wp-block-genesis-blocks-gb-pricing gb-pricing-columns-3\"><div class=\"gb-pricing-table-wrap gb-block-pricing-table-gap-2\"><!-- wp:genesis-blocks/gb-pricing-table {\"borderWidth\":0,\"backgroundColor\":\"#ffffff\"} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table gb-block-pricing-table-center gb-block-pricing-table\" itemscope itemtype=\"http://schema.org/Product\"><div class=\"gb-block-pricing-table-inside\" style=\"background-color:#ffffff\"><!-- wp:genesis-blocks/gb-pricing-table-title {\"title\":\"\u003cstrong\u003eBeginner Level\u003c/strong\u003e\",\"customFontSize\":22,\"paddingTop\":30} -->
<div itemprop=\"name\" style=\"font-size:22px;padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px\" class=\"wp-block-genesis-blocks-gb-pricing-table-title gb-pricing-table-title\"><strong>Beginner Level</strong></div>
<!-- /wp:genesis-blocks/gb-pricing-table-title -->

<!-- wp:genesis-blocks/gb-pricing-table-price {\"price\":\"9\",\"currency\":\"$\",\"customFontSize\":50,\"term\":\"\"} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-price gb-pricing-table-price-wrap gb-pricing-has-currency\" style=\"padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px\"><div itemprop=\"offers\" itemscope itemtype=\"http://schema.org/Offer\"><span itemprop=\"priceCurrency\" class=\"gb-pricing-table-currency\" style=\"font-size:20px\">$</span><div itemprop=\"price\" class=\"gb-pricing-table-price\" style=\"font-size:50px\">9</div></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table-price -->

<!-- wp:genesis-blocks/gb-pricing-table-features {\"customFontSize\":16,\"customTextColor\":\"#000000\",\"borderColor\":\"#dae0df\",\"paddingTop\":15,\"paddingBottom\":15} -->
<ul itemprop=\"description\" class=\"wp-block-genesis-blocks-gb-pricing-table-features gb-pricing-table-features gb-list-border-none gb-list-border-width-1\" style=\"font-size:16px;color:#000000;border-color:#dae0df;padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px\"><li>Beginner Feature One</li><li>Beginner Feature Two</li><li>Beginner Feature Three</li><li>Beginner Feature Four</li></ul>
<!-- /wp:genesis-blocks/gb-pricing-table-features -->

<!-- wp:genesis-blocks/gb-pricing-table-button {\"buttonText\":\"Join Now\",\"buttonBackgroundColor\":\"#0680a2\",\"buttonShape\":\"gb-button-shape-square\",\"paddingTop\":15,\"paddingBottom\":35} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-button gb-pricing-table-button\" style=\"padding-top:15px;padding-right:20px;padding-bottom:35px;padding-left:20px\"><div class=\"gb-block-button\"><a class=\"gb-button gb-button-shape-square gb-button-size-medium\" style=\"color:#ffffff;background-color:#0680a2\">Join Now</a></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table-button --></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table -->

<!-- wp:genesis-blocks/gb-pricing-table {\"borderWidth\":0,\"backgroundColor\":\"#ffffff\"} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table gb-block-pricing-table-center gb-block-pricing-table\" itemscope itemtype=\"http://schema.org/Product\"><div class=\"gb-block-pricing-table-inside\" style=\"background-color:#ffffff\"><!-- wp:genesis-blocks/gb-pricing-table-title {\"title\":\"\u003cstrong\u003eProfessional Level\u003c/strong\u003e\",\"customFontSize\":22,\"paddingTop\":30} -->
<div itemprop=\"name\" style=\"font-size:22px;padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px\" class=\"wp-block-genesis-blocks-gb-pricing-table-title gb-pricing-table-title\"><strong>Professional Level</strong></div>
<!-- /wp:genesis-blocks/gb-pricing-table-title -->

<!-- wp:genesis-blocks/gb-pricing-table-price {\"price\":\"19\",\"currency\":\"$\",\"customFontSize\":50,\"term\":\"\"} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-price gb-pricing-table-price-wrap gb-pricing-has-currency\" style=\"padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px\"><div itemprop=\"offers\" itemscope itemtype=\"http://schema.org/Offer\"><span itemprop=\"priceCurrency\" class=\"gb-pricing-table-currency\" style=\"font-size:20px\">$</span><div itemprop=\"price\" class=\"gb-pricing-table-price\" style=\"font-size:50px\">19</div></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table-price -->

<!-- wp:genesis-blocks/gb-pricing-table-features {\"customFontSize\":16,\"customTextColor\":\"#000000\",\"borderColor\":\"#dae0df\",\"paddingTop\":15,\"paddingBottom\":15} -->
<ul itemprop=\"description\" class=\"wp-block-genesis-blocks-gb-pricing-table-features gb-pricing-table-features gb-list-border-none gb-list-border-width-1\" style=\"font-size:16px;color:#000000;border-color:#dae0df;padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px\"><li>Professional Feature One</li><li>Professional Feature Two</li><li>Professional Feature Three</li><li>Professional Feature Four</li></ul>
<!-- /wp:genesis-blocks/gb-pricing-table-features -->

<!-- wp:genesis-blocks/gb-pricing-table-button {\"buttonText\":\"Join Now\",\"buttonBackgroundColor\":\"#0680a2\",\"buttonShape\":\"gb-button-shape-square\",\"paddingTop\":25,\"paddingBottom\":25} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-button gb-pricing-table-button\" style=\"padding-top:25px;padding-right:20px;padding-bottom:25px;padding-left:20px\"><div class=\"gb-block-button\"><a class=\"gb-button gb-button-shape-square gb-button-size-medium\" style=\"color:#ffffff;background-color:#0680a2\">Join Now</a></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table-button --></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table -->

<!-- wp:genesis-blocks/gb-pricing-table {\"borderWidth\":0,\"backgroundColor\":\"#ffffff\"} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table gb-block-pricing-table-center gb-block-pricing-table\" itemscope itemtype=\"http://schema.org/Product\"><div class=\"gb-block-pricing-table-inside\" style=\"background-color:#ffffff\"><!-- wp:genesis-blocks/gb-pricing-table-title {\"title\":\"\u003cstrong\u003eExpert Level\u003c/strong\u003e\",\"customFontSize\":22,\"paddingTop\":30} -->
<div itemprop=\"name\" style=\"font-size:22px;padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px\" class=\"wp-block-genesis-blocks-gb-pricing-table-title gb-pricing-table-title\"><strong>Expert Level</strong></div>
<!-- /wp:genesis-blocks/gb-pricing-table-title -->

<!-- wp:genesis-blocks/gb-pricing-table-price {\"price\":\"39\",\"currency\":\"$\",\"customFontSize\":50,\"term\":\"/mo\"} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-price gb-pricing-table-price-wrap gb-pricing-has-currency\" style=\"padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px\"><div itemprop=\"offers\" itemscope itemtype=\"http://schema.org/Offer\"><span itemprop=\"priceCurrency\" class=\"gb-pricing-table-currency\" style=\"font-size:20px\">$</span><div itemprop=\"price\" class=\"gb-pricing-table-price\" style=\"font-size:50px\">39</div><span class=\"gb-pricing-table-term\" style=\"font-size:20px\">/mo</span></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table-price -->

<!-- wp:genesis-blocks/gb-pricing-table-features {\"customFontSize\":16,\"customTextColor\":\"#000000\",\"borderColor\":\"#dae0df\",\"paddingTop\":15,\"paddingBottom\":15} -->
<ul itemprop=\"description\" class=\"wp-block-genesis-blocks-gb-pricing-table-features gb-pricing-table-features gb-list-border-none gb-list-border-width-1\" style=\"font-size:16px;color:#000000;border-color:#dae0df;padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px\"><li>Expert Feature One</li><li>Expert Feature Two</li><li>Expert Feature Three</li><li>Expert Feature Four</li></ul>
<!-- /wp:genesis-blocks/gb-pricing-table-features -->

<!-- wp:genesis-blocks/gb-pricing-table-button {\"buttonText\":\"Join Now\",\"buttonBackgroundColor\":\"#0680a2\",\"buttonShape\":\"gb-button-shape-square\",\"paddingTop\":15,\"paddingBottom\":35} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-button gb-pricing-table-button\" style=\"padding-top:15px;padding-right:20px;padding-bottom:35px;padding-left:20px\"><div class=\"gb-block-button\"><a class=\"gb-button gb-button-shape-square gb-button-size-medium\" style=\"color:#ffffff;background-color:#0680a2\">Join Now</a></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table-button --></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table --></div></div>
<!-- /wp:genesis-blocks/gb-pricing --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Altitude Pricing Table', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'media', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'pricing', 'genesis-page-builder' ),
		esc_html__( 'pricing table', 'genesis-page-builder' ),
		esc_html__( 'altitude', 'genesis-page-builder' ),
		esc_html__( 'altitude pricing table', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/altitude/gpb_altitude_section_pricing_table.jpg',
];
