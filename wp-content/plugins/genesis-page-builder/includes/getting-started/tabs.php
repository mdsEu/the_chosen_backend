<?php
/**
 * Function for the Getting Started page.
 *
 * @package Genesis\PageBuilder\GettingStarted
 */

namespace Genesis\PageBuilder\GettingStarted;

add_filter( 'genesis_blocks_setting_started_tabs', __NAMESPACE__ . '\remove_genesis_pro_tab' );

/**
 * Removes the Genesis Pro tab from the Getting Started page.
 *
 * @param string[][] $genesis_tabs The tabs to filter.
 * @return string[][] $genesis_tabs The tabs, without the Genesis Pro tab.
 */
function remove_genesis_pro_tab( $genesis_tabs ) {
	return array_filter(
		$genesis_tabs,
		static function( $tab ) {
			return ! isset( $tab['tab_slug'] ) || 'genesis-pro' !== $tab['tab_slug'];
		}
	);
}
