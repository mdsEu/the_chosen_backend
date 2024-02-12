=== Atlas Search ===
Tags: search
Tested up to: 6.0.1
Requires PHP: 7.4
Stable tag: 0.2.13
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Author: WP Engine
Contributors: wpengine toughcrab24 konrad-glowacki ciaranshan1 dimitrios-wpengine ericosullivanwp RBrady98 richard-wpengine mindctrl

A WordPress plugin to enhance the default WordPress search features for wp-graphql, and REST search methods.

== Description ==

Atlas Search is an enhanced search solution for WordPress. WordPress default search struggles to surface relevant content
from searches, this plugin enables WordPress to query vastly more relevant and refined content. The plugin enables a
variety of configuration options and is compatible with builtins and a variety of popular plugins such as, Custom Post Type UI,
Advanced Custom Fields (ACF) and Atlas Content Modeler (ACM).


== Installation ==

This plugin and its credentials will be automatically installed and configured on your WordPress instance after purchasing Atlas Search on your WP Engine Plan and assigning a license to the environment in the user portal.

This plugin can be installed directly from your WordPress site.

* Log in to your WordPress site and navigate to **Plugins &rarr; Add New**.
* Type "Atlas Search" into the Search box.
* Locate the Atlas Search plugin in the list of search results and click **Install Now**.
* Once installed, click the Activate button.

It can also be installed manually using a zip file.

* Download the Atlas Search plugin from WordPress.org.
* Log in to your WordPress site and navigate to **Plugins &rarr; Add New**.
* Click the **Upload Plugin** button.
* Click the **Choose File** button, select the zip file you downloaded in step 1, then click the **Install Now** button.
* Click the **Activate Plugin** button.

Configuring the Plugin once activated

* Navigate to the Atlas Search settings page in WP Admin
* Enter your URL and Access Token on the Atlas Search settings page
* Click save

**NOTE:** credentials for this plugin can only be obtained by purchasing this as an add-on as a part of your existing WP Engine Plan.
Please see [wpengine.com/atlas](https://wpengine.com/atlas/) for details.

== Changelog ==
= 0.2.13 =
* **Fixed:** Remove ACF keys with empty string
* **Updated:** Use new find API for searches

= 0.2.12 =
* **Fixed:** ACF issue with nested content

= 0.2.11 =
* **Fixed:** ACF field issue with empty values on fields

= 0.2.10 =
* **Added:** Extended support for ACF types

All ACF types will now be indexed and searchable except for the following, these fields are excluded:
* image
* file
* google_map
* password
* gallery

**NOTE:** To take advantage of this new feature, please delete and re sync your data.

= 0.2.8 =
* **Fixed:** Issue where assets syncing were taking too long.

= 0.2.4 =
* **Updated:** Update version headers.

= 0.2.3 =
* **Fixed:** Success toast now pops up when sync is complete.

= 0.2.2 =
* **Added:** WordPress HTML and REST search now work with Atlas Search.

= 0.2.1 =
* **Fixed:** Issue when searching multiple terms.

= 0.2.0 =
* **Notice:** Upgrading to this version requires re-syncing data.

= 0.1.52 =
* **Fixed:** Issue where ACF fields were being omitted on initial sync.

= 0.1.51 =
* **Added:** Feature to allow more complex searching.

= 0.1.50 =
* **Fixed:** Issue where weight sliders were not working.

= 0.1.49 =
* **Updated:** Update version headers.

= 0.1.48 =
* **Fixed:** Issue where post slugs were casing sync issues.

= 0.1.47 =
* **Updated:** Update version headers.

= 0.1.46 =
* **Fixed:** Issue where permalinks were casing sync issues.

= 0.1.45 =
* **Fixed:** Issue where parent posts were causing failed syncs.

= 0.1.44 =
* **Fixed:** Issue where ACM date types were causing sync issues

= 0.1.43 =
* **Updated:** Readme docs
* **Fixed:** Allow hyphens in model identifiers

= 0.1.42 =
* **Updated:** Update version headers

= 0.1.41 =
* **Updated:** Update version headers

= 0.1.40 =
* **Added:** Support for offset pagination

= 0.1.39 =
* **Fixed:** issue where field weights were not being respected in search results

= 0.1.38 =
* **Updated:** Version headers

= 0.1.37 =
* **Reverted** unintended changes to sync.

= 0.1.36 =
* **Removed** search unused capabilities check.

= 0.1.35 =
* **Fixed** Issue with nested ACF fields on CPT's.

= 0.1.34 =
* **Fixed** Atlas Search not working when ACF objects are attached to CPT's.

== Changelog ==
= 0.1.33 =
* **Fixed** ACF issue with empty field groups during sync.

= 0.1.32 =
* **Fixed** Failed sync's due to null ACF field groups.
* **Fixed** Correctly order posts and pages when syncing data.

= 0.1.31 =
* **Fixed** Sync issues with parent terms.

= 0.1.30 =
* **Fixed** Sync issues with removed and re-added ACM fields.

= 0.1.29 =
* **Fixed** Empty ACM repeatable fields causing sync issues.
* **Fixed** Post featured images would cause sync to fail.

= 0.1.28 =
* **Fixed** ACM repeatable fields causing sync issues.
* **Fixed** Front-end missing wpApiSettings object.

= 0.1.27 =
* **Fixed** Sync issue when post types had no author.
* **Fixed** Sync issue when ACF fields contained dates as strings.

= 0.1.26 =
* **Added** UI configuration for fuziness and stemming toggle.

= 0.1.25 =
* **Fixed** ACM models can now be searched correctly.
* **Fixed** Posts with no authors will be synchronized correctly.

= 0.1.24 =
* **Updated** Atlas Search minimum PHP version is now 7.4

= 0.1.23 =
* **Fixed** Posts with empty `post_name` with not be synchronized

= 0.1.22 =
* **Fixed:** Simple Feature Request plugin breaking Atlas search sync

= 0.1.21 =

* **Fixed:** Auto drafts will no longer be automatically synchronized
* **Fixed:** User delete events are now correctly handled
* **Fixed:** Tag descriptions can now be synchronized as longtext

= 0.1.20 =
* **Updated:** Version headers

= 0.1.19 =
* **Updated:** Version headers

= 0.1.18 =
* **Fixed:** Admin error notices correctly instruct users to sync when data sync issues occur

= 0.1.17 =
* **Fixed:** ACF group names search config where they were unable to be searched
* **Fixed:** Fuzzy queries unable to search where numbers are involved


= 0.1.16 =
* **Added:** Fuzzy configuration UI

= 0.1.15 =
* **Added:** Enable fuzzy search by default

= 0.1.14 =
* **Added:** Support for ACM's email field

= 0.1.13 =
* **Fixed:** Breaking pagination in WP Admin views
* **Added:** Clear sync progress & locks when plugin is deactivated

= 0.1.12 =
* **Added:** Add button to delete search data
* **Fixed:** Sync button progress bar improvement

= 0.1.11 =
* **Fixed:** Sync button progress is reset when multiple tabs try to sync

= 0.1.10 =
* **Fixed:** Progress bar animation
* **Fixed:** Sync items correctly syncing

= 0.1.9 =
* **Added:** Sync lock to prevent more than one sync executing at a time
* **Fixed:** Progress calculation on sync progress bar
* **Fixed:** Sync can now progress when ACM is not installed

= 0.1.8 =
* **Added:** New sync button to sync content via plugin
* **Added:** Plugin Icon and Banner
* **Added:** Toast confirmations when saving settings
* **Fixed:** Importing posts via ACM
* **Fixed:** Styling issues on Atlas Search Settings

= 0.1.7 =
* Added toast confirmations on settings changes
* Show info to user about syncing data when plugin is activated
* Settings based scripts are now cached by the browser on WP Admin
* Search configuration regenerated on content changes
* Added validation to settings form

= 0.1.6 =
* Search fields now correctly search through content models
* Remove slug as an option from search config
* Url setting will correctly default to an empty string

= 0.1.5 =
* Added new settings page
* Added Search Config page

= 0.1.4 =
* Update WP CLI command prefix to `wp as`

= 0.1.1 =
* Prepare for release

= 0.1.0 =
* Add support for ACM repeater fields
* Improve error messages in wp-admin
* Sync CPT excerpt field

