=== Genesis Blocks Pro ===
Tags: blocks, editor, gutenberg, gutenberg blocks, page builder, block enabled, page building, block, WP Engine

Requires at least: 5.3

Tested up to: 6.2

Stable tag: 2.0.0

License: GPLv2 or later

License URI: https://www.gnu.org/licenses/gpl-2.0.html

A collection of beautiful, customizable Gutenberg blocks, page layouts and sections. An extention to the already exhaustive Genesis Blocks plugin.

== Description ==

Genesis Blocks Pro is a collection of page building blocks for the WordPress block editor. Building pages with the block editor and Genesis Blocks Pro gives you more control to quickly create and launch any kind of site you want!

Installing the customizable Genesis Blocks Pro plugin adds a collection of beautiful, site-building blocks to help you customize page layouts, increase engagement, and get results for your business. Genesis Blocks Pro provides everything from customizable buttons, to beautifully-designed page sections and full-page layout designs via the Section & Layout block.

Breaking change: The Genesis Blocks Button block is deprecated in favor of the Core Buttons block.

When you open the block editor, this will automatically convert your Genesis Blocks Button blocks to the Core Buttons block.

This will not convert Button blocks if you don't open the block editor.

You might see some styling changes, especially if you have custom styling for classes other than 'gb-block-button'.

== Changelog ==

= 2.0.0 =
* Breaking change: Deprecate the Button block in favor of Core Buttons block. This will automatically convert your GB Button blocks to Core Buttons blocks when opening the block editor. The buttons should look mainly the same, but there could be some styling changes, especially if you have custom styling for classes other than 'gb-block-button'.

= 1.8.6 =
* Fixed: Prevent duplicate blocks in inserter when another plugin uses the Genesis Blocks category.

= 1.8.5 =
* Fixed: Deprecation JS console warnings.

= 1.8.4 =
* Fixed: Fix PHP 8 uksort.
* Fixed: Prevent a PHP error on the Newlsetter block.
* Changed: Add filter to disable responsive font size controls.

= 1.8.3 =
* Fixed: Fix an error with Desktop responsive controls on the Heading and Paragraph blocks.

= 1.8.2 =
* Changed: NPM tooling overhaul.
* Changed: Unignore eslint rules, fix linting.
* Fixed: Prevent an error if another plugin incorrectly filters 'admin_body_class'.

= 1.8.1 =
* Fixed: Revert changes that modified Profile Box avatar styling.

= 1.8.0 =
* Changed: Remove Google Analytics entirely.
* Fixed: Ensure styles are enqueued.
* Fixed: Fix post grid warning.

= 1.7.0 =
* Added: New Getting Started pages to assist with onboarding.
* Added: Optional analytics tracking for responsive styles and layout modal.
* Changed: Collections Tab is now the first tab in the layout modal for Sections and Layouts.

= 1.6.0 =
* Added: Responsive controls for the paragraph and heading core blocks.

= 1.5.1 =
* Added: block_categories_all filter for WordPress 5.8.
* Added: Add 2 new Tangerine Sections.
* Changed: Replace Font Awesome with SVG files in the Profile Box (aka Author Profile) block, and the Sharing block.
* Changed: Updates to ensure blocks work outside of a post context (such as the WordPress 5.8 widgets screen).
* Changed: Standardize Tangerine Sections and Layouts.
* Changed: Use section keys to build Tangerine & Monochrome Layouts.
* Fixed: Improve accessibility & readability of the Slate Collection colors.
* Fixed: Button alignment in Monochrome Call to Action section in WordPress 5.7+.

= 1.5.0 =
- Added: New "Authority" Collection.

= 1.4.1 =
- Added: The Post Grid block now allows for multiple categories to be selected.
- Changed: The Post Grid block now requires the user to begin typing the name of the category they wish to add, instead of selecting it from a dropdown menu.
- Fixed: The Post Grid block has been optimized to reduce load on server and wait times for sites with many categories/pages.
- Fixed: The Post Grid Block, when set to show pages, incorrectly used the "Number of items" option to limit the number of pages shown. This has been fixed. The "Number of items" option no longer applies to pages while previewing the block in the editor. The number of pages selected are the number of pages shown. Note that this bug did not affect the frontend, but only what you see in the block editor in wp-admin.
- Fixed: The genesis_blocks_allowed_layout_components filter was broken for Layouts (but not Sections) since version 1.2.2 and has been fixed here.

= 1.4.0 =
- Added: Infinity section and layout collection.
- Added: Default text and background colors to Altitude sections that had none.
- Fixed: Duplicate section and layout categories in layout modal dropdown.
- Changed: Remove parenthesis from the Monochrome Title and Text Columns Dark section key.
- Changed: Tangerine collection Tangerine Text Columns with Background image URL.

= 1.3.0 =
- Added: Altitude section and layout collection.
- Changed: If there's no subscription key, show a helpful message encouraging the user to enter one.

= 1.2.3 =
- Fixed: Layout link has been moved back to the left of the admin toolbar.

= 1.2.2 =
- Fixed: Corrected the settings link in the Newsletter Block.
- Added: Collection images to layout modal.
- Added: Fallback images for section/layout previews that fail to load.
- Added: Ability to use section keys to build layouts.

= 1.2.1 =
- Fixed: The layouts block is no longer left over in the editor if the modal is closed by the user.
- Fixed: The layouts button in the Block Editor header toolbar uses a more reliable javascript event to ensure it is always visible.
- Fixed: The Post and Page Grid block now shows all pages selected, instead of cutting it off at the number of posts set to show.
- New: Added a "Leave a review" button to the settings page.

= 1.2.0 =
- New: Introducing Collections, a curated suite of pattern designs to quickly build out beautiful pages and full websites.
- Added support for migrating Genesis Blocks Pro users.

= 1.1.2 =
- Genesis Page Builder has a new name. Welcome to Genesis Blocks Pro!
- Fixed issue with the Post & Page Grid block where automatic excerpts did not show under certain conditions.
- Removed unnecessary padding in the editor on full-width Container, Pricing, and Advanced Column blocks.
- Advanced Columns and Pricing blocks now show new columns when the column count is increased in WordPress 5.5.
- Placeholder text in the Advanced Columns block is now visible in WordPress 5.5.

= 1.1.1 =
- Fixes issue where all pages selected in the Post and Page Grid block might not be displayed.
- Fixes issue where column setting was not visible when working with pages in the Post and Page Grid block.
- Fixes issue with block styles not loading on the front end under certain conditions.

= 1.1.0 =
- New: Adds 9 new section designs and 2 new layout designs.
- Improves styles for improved editor preview.
- Introduces fluid typography styles for use in future releases.

= 1.0.1 =
- Improves the Layouts block usability by making the library window wider.
- Improves the Layouts library window performance by optimizing the preview images.
- Adds helpful notices if there's an issue with your Genesis Pro subscription key.

= 1.0.0 =
- Initial release
