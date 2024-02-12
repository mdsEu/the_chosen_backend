<?php
/**
 * Functions related to block settings permissions.
 *
 * @package Genesis\PageBuilder\Permissions
 */

namespace Genesis\PageBuilder\Permissions;

/**
 * Returns the permissions for block setting controls.
 *
 * @return array
 */
function block_settings_permissions() {
	return get_option( 'genesis_page_builder_block_settings_permissions', [] );
}
