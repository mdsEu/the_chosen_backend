<?php
/**
 * Genesis Blocks Pricing Table section for Authority Collection.
 *
 * @package genesis-page-builder
 */

return [
	'type'       => 'section',
	'key'        => 'gpb_authority_section_pricing_table',
	'collection' => [
		'slug'                   => 'authority',
		'label'                  => esc_html__( 'Authority', 'genesis-page-builder' ),
		'allowThemeColorPalette' => false,
	],
	'content'    => "<!-- wp:genesis-blocks/gb-columns {\"columns\":1,\"layout\":\"one-column\",\"align\":\"full\",\"paddingTop\":5,\"paddingRight\":1,\"paddingBottom\":5,\"paddingLeft\":1,\"paddingUnit\":\"em\",\"customTextColor\":\"#333333\",\"customBackgroundColor\":\"#f4f4f4\",\"columnMaxWidth\":1200,\"className\":\"gpb-authority-section-pricing-table \"} -->
<div class=\"wp-block-genesis-blocks-gb-columns gpb-authority-section-pricing-table gb-layout-columns-1 one-column gb-has-custom-background-color gb-has-custom-text-color gb-columns-center alignfull\" style=\"padding-top:5em;padding-right:1em;padding-bottom:5em;padding-left:1em;background-color:#f4f4f4;color:#333333\"><div class=\"gb-layout-column-wrap gb-block-layout-column-gap-2 gb-is-responsive-column\" style=\"max-width:1200px\"><!-- wp:genesis-blocks/gb-column {\"paddingUnit\":\"em\",\"paddingRight\":1,\"paddingLeft\":1} -->
<div class=\"wp-block-genesis-blocks-gb-column gb-block-layout-column\"><div class=\"gb-block-layout-column-inner\" style=\"padding-right:1em;padding-left:1em\"><!-- wp:genesis-blocks/gb-container {\"containerMarginBottom\":5,\"containerMaxWidth\":700} -->
<div style=\"margin-bottom:5%\" class=\"wp-block-genesis-blocks-gb-container gb-block-container\"><div class=\"gb-container-inside\"><div class=\"gb-container-content\" style=\"max-width:700px\"><!-- wp:heading {\"textAlign\":\"center\",\"style\":{\"color\":{\"text\":\"#111111\"},\"typography\":{\"fontSize\":40,\"lineHeight\":\"1.2\"}}} -->
<h2 class=\"has-text-align-center has-text-color\" style=\"color:#111111;font-size:40px;line-height:1.2\">Beautiful, responsive pricing tables.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\"} -->
<p class=\"has-text-align-center\">Use these highly customizable, responsive, block-powered pricing tables to lead customers to subscriptions, checkout pages, and more. </p>
<!-- /wp:paragraph --></div></div></div>
<!-- /wp:genesis-blocks/gb-container -->

<!-- wp:genesis-blocks/gb-pricing {\"columns\":3} -->
<div class=\"wp-block-genesis-blocks-gb-pricing gb-pricing-columns-3\"><div class=\"gb-pricing-table-wrap gb-block-pricing-table-gap-2\"><!-- wp:genesis-blocks/gb-pricing-table {\"borderWidth\":1,\"borderColor\":\"#dcdcdc\",\"backgroundColor\":\"#ffffff\"} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table gb-block-pricing-table-center gb-block-pricing-table\" itemscope itemtype=\"http://schema.org/Product\"><div class=\"gb-block-pricing-table-inside\" style=\"border-width:1px;border-style:solid;border-color:#dcdcdc;background-color:#ffffff\"><!-- wp:genesis-blocks/gb-pricing-table-title {\"title\":\"\u003cstrong\u003eBasic Package\u003c/strong\u003e\",\"customFontSize\":22,\"paddingTop\":30} -->
<div itemprop=\"name\" style=\"font-size:22px;padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px\" class=\"wp-block-genesis-blocks-gb-pricing-table-title gb-pricing-table-title\"><strong>Basic Package</strong></div>
<!-- /wp:genesis-blocks/gb-pricing-table-title -->

<!-- wp:genesis-blocks/gb-pricing-table-subtitle {\"subtitle\":\"\u003cem\u003ePrice Subtitle Description\u003c/em\u003e\",\"customFontSize\":18} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-subtitle gb-pricing-table-subtitle\" style=\"font-size:18px;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px\"><em>Price Subtitle Description</em></div>
<!-- /wp:genesis-blocks/gb-pricing-table-subtitle -->

<!-- wp:genesis-blocks/gb-pricing-table-price {\"price\":\"149\",\"currency\":\"$\",\"term\":\"/mo\",\"showTerm\":false} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-price gb-pricing-table-price-wrap gb-pricing-has-currency\" style=\"padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px\"><div itemprop=\"offers\" itemscope itemtype=\"http://schema.org/Offer\"><span itemprop=\"priceCurrency\" class=\"gb-pricing-table-currency\" style=\"font-size:24px\">$</span><div itemprop=\"price\" class=\"gb-pricing-table-price\" style=\"font-size:60px\">149</div></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table-price -->

<!-- wp:genesis-blocks/gb-pricing-table-features {\"customFontSize\":18,\"borderColor\":\"#a2bfcb\",\"paddingTop\":15,\"paddingBottom\":15} -->
<ul itemprop=\"description\" class=\"wp-block-genesis-blocks-gb-pricing-table-features gb-pricing-table-features gb-list-border-none gb-list-border-width-1\" style=\"font-size:18px;border-color:#a2bfcb;padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px\"><li>Product Feature One</li><li>Product Feature Two</li><li>Product Feature Three</li></ul>
<!-- /wp:genesis-blocks/gb-pricing-table-features -->

<!-- wp:genesis-blocks/gb-pricing-table-button {\"buttonText\":\"Buy Now\",\"buttonBackgroundColor\":\"#000cff\",\"buttonShape\":\"gb-button-shape-square\",\"paddingTop\":15,\"paddingBottom\":35} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-button gb-pricing-table-button\" style=\"padding-top:15px;padding-right:20px;padding-bottom:35px;padding-left:20px\"><div class=\"gb-block-button\"><a class=\"gb-button gb-button-shape-square gb-button-size-medium\" style=\"color:#ffffff;background-color:#000cff\">Buy Now</a></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table-button --></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table -->

<!-- wp:genesis-blocks/gb-pricing-table {\"borderColor\":\"#000cff\",\"backgroundColor\":\"#ffffff\"} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table gb-block-pricing-table-center gb-block-pricing-table\" itemscope itemtype=\"http://schema.org/Product\"><div class=\"gb-block-pricing-table-inside\" style=\"border-width:2px;border-style:solid;border-color:#000cff;background-color:#ffffff\"><!-- wp:genesis-blocks/gb-pricing-table-title {\"title\":\"\u003cstrong\u003eProfessional Package\u003c/strong\u003e\",\"customFontSize\":22,\"paddingTop\":30} -->
<div itemprop=\"name\" style=\"font-size:22px;padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px\" class=\"wp-block-genesis-blocks-gb-pricing-table-title gb-pricing-table-title\"><strong>Professional Package</strong></div>
<!-- /wp:genesis-blocks/gb-pricing-table-title -->

<!-- wp:genesis-blocks/gb-pricing-table-subtitle {\"subtitle\":\"\u003cem\u003ePrice Subtitle Description\u003c/em\u003e\",\"customFontSize\":18} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-subtitle gb-pricing-table-subtitle\" style=\"font-size:18px;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px\"><em>Price Subtitle Description</em></div>
<!-- /wp:genesis-blocks/gb-pricing-table-subtitle -->

<!-- wp:genesis-blocks/gb-pricing-table-price {\"price\":\"179\",\"currency\":\"$\",\"term\":\"/mo\",\"showTerm\":false} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-price gb-pricing-table-price-wrap gb-pricing-has-currency\" style=\"padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px\"><div itemprop=\"offers\" itemscope itemtype=\"http://schema.org/Offer\"><span itemprop=\"priceCurrency\" class=\"gb-pricing-table-currency\" style=\"font-size:24px\">$</span><div itemprop=\"price\" class=\"gb-pricing-table-price\" style=\"font-size:60px\">179</div></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table-price -->

<!-- wp:genesis-blocks/gb-pricing-table-features {\"customFontSize\":18,\"paddingTop\":15,\"paddingBottom\":15} -->
<ul itemprop=\"description\" class=\"wp-block-genesis-blocks-gb-pricing-table-features gb-pricing-table-features gb-list-border-none gb-list-border-width-1\" style=\"font-size:18px;padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px\"><li>Product Feature One</li><li>Product Feature Two</li><li>Product Feature Three</li></ul>
<!-- /wp:genesis-blocks/gb-pricing-table-features -->

<!-- wp:paragraph {\"style\":{\"color\":{\"text\":\"#707070\"},\"typography\":{\"fontSize\":22}}} -->
<p class=\"has-text-color\" style=\"color:#707070;font-size:22px\"><em>Most Popular!</em></p>
<!-- /wp:paragraph -->

<!-- wp:genesis-blocks/gb-pricing-table-button {\"buttonText\":\"Buy Now\",\"buttonBackgroundColor\":\"#000cff\",\"buttonShape\":\"gb-button-shape-square\",\"paddingTop\":15,\"paddingBottom\":35} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-button gb-pricing-table-button\" style=\"padding-top:15px;padding-right:20px;padding-bottom:35px;padding-left:20px\"><div class=\"gb-block-button\"><a class=\"gb-button gb-button-shape-square gb-button-size-medium\" style=\"color:#ffffff;background-color:#000cff\">Buy Now</a></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table-button --></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table -->

<!-- wp:genesis-blocks/gb-pricing-table {\"borderWidth\":1,\"borderColor\":\"#dcdcdc\",\"backgroundColor\":\"#ffffff\"} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table gb-block-pricing-table-center gb-block-pricing-table\" itemscope itemtype=\"http://schema.org/Product\"><div class=\"gb-block-pricing-table-inside\" style=\"border-width:1px;border-style:solid;border-color:#dcdcdc;background-color:#ffffff\"><!-- wp:genesis-blocks/gb-pricing-table-title {\"title\":\"\u003cstrong\u003eEmpire Builder\u003c/strong\u003e\",\"customFontSize\":22,\"paddingTop\":30} -->
<div itemprop=\"name\" style=\"font-size:22px;padding-top:30px;padding-right:20px;padding-bottom:10px;padding-left:20px\" class=\"wp-block-genesis-blocks-gb-pricing-table-title gb-pricing-table-title\"><strong>Empire Builder</strong></div>
<!-- /wp:genesis-blocks/gb-pricing-table-title -->

<!-- wp:genesis-blocks/gb-pricing-table-subtitle {\"subtitle\":\"\u003cem\u003ePrice Subtitle Description\u003c/em\u003e\",\"customFontSize\":18} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-subtitle gb-pricing-table-subtitle\" style=\"font-size:18px;padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px\"><em>Price Subtitle Description</em></div>
<!-- /wp:genesis-blocks/gb-pricing-table-subtitle -->

<!-- wp:genesis-blocks/gb-pricing-table-price {\"price\":\"199\",\"currency\":\"$\",\"term\":\"/mo\",\"showTerm\":false} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-price gb-pricing-table-price-wrap gb-pricing-has-currency\" style=\"padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px\"><div itemprop=\"offers\" itemscope itemtype=\"http://schema.org/Offer\"><span itemprop=\"priceCurrency\" class=\"gb-pricing-table-currency\" style=\"font-size:24px\">$</span><div itemprop=\"price\" class=\"gb-pricing-table-price\" style=\"font-size:60px\">199</div></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table-price -->

<!-- wp:genesis-blocks/gb-pricing-table-features {\"customFontSize\":18,\"paddingTop\":15,\"paddingBottom\":15} -->
<ul itemprop=\"description\" class=\"wp-block-genesis-blocks-gb-pricing-table-features gb-pricing-table-features gb-list-border-none gb-list-border-width-1\" style=\"font-size:18px;padding-top:15px;padding-right:20px;padding-bottom:15px;padding-left:20px\"><li>Product Feature One</li><li>Product Feature Two</li><li>Product Feature Three</li></ul>
<!-- /wp:genesis-blocks/gb-pricing-table-features -->

<!-- wp:genesis-blocks/gb-pricing-table-button {\"buttonText\":\"Buy Now\",\"buttonBackgroundColor\":\"#000cff\",\"buttonShape\":\"gb-button-shape-square\",\"paddingTop\":15,\"paddingBottom\":35} -->
<div class=\"wp-block-genesis-blocks-gb-pricing-table-button gb-pricing-table-button\" style=\"padding-top:15px;padding-right:20px;padding-bottom:35px;padding-left:20px\"><div class=\"gb-block-button\"><a class=\"gb-button gb-button-shape-square gb-button-size-medium\" style=\"color:#ffffff;background-color:#000cff\">Buy Now</a></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table-button --></div></div>
<!-- /wp:genesis-blocks/gb-pricing-table --></div></div>
<!-- /wp:genesis-blocks/gb-pricing --></div></div>
<!-- /wp:genesis-blocks/gb-column --></div></div>
<!-- /wp:genesis-blocks/gb-columns -->",
	'name'       => esc_html__( 'Authority Pricing Table', 'genesis-page-builder' ),
	'category'   => [
		esc_html__( 'business', 'genesis-page-builder' ),
		esc_html__( 'landing', 'genesis-page-builder' ),
		esc_html__( 'services', 'genesis-page-builder' ),
		esc_html__( 'product', 'genesis-page-builder' ),
	],
	'keywords'   => [
		esc_html__( 'pricing', 'genesis-page-builder' ),
		esc_html__( 'authority', 'genesis-page-builder' ),
		esc_html__( 'authority pricing table', 'genesis-page-builder' ),
	],
	'image'      => 'https://demo.studiopress.com/page-builder/authority/gpb_authority_section_pricing_table.jpg',
];
