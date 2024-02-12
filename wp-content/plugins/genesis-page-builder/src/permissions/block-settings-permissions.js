wp.hooks.addFilter( 'gb_should_render_block_setting', 'gpb', ( can_access, block_name, setting_id, user_data ) => {

	const permissions = getBlockSettingsPermissions();

	/**
	 * If the permissions are undefined, this means the settings page
	 * has not been used yet, and by default everyone has access to all
	 * settings. We return the can_access value early, which by default
	 * is set to 'true' by Genesis Blocks. We return can_access instead of
	 * 'true' in case someone else has filtered the value.
	 */
	if ( typeof permissions[block_name] === 'undefined' || typeof permissions[block_name][setting_id] === 'undefined' ) {
		return can_access;
	}

	return user_data.roles.some( ( role ) => {
		return permissions[block_name][setting_id][role] === true;
	} );
} );


/**
 * Returns the block settings permissions data.
 *
 * @returns {{}}
 */
export function getBlockSettingsPermissions() {
	return genesis_page_builder_globals.blockSettingsPermissions;
}

/**
 * Returns all the registered blocks from GB and GPB.
 *
 * @returns {[]}
 */
export function get_registered_gpb_blocks() {
	// @todo update these map/filter functions for proper Genesis names
	let gpbBlocks = [];
	wp.blocks.getBlockTypes().map( block => {
		if ( block.name.startsWith( 'genesis-blocks' ) || block.name.startsWith( 'genesis-page-builder' ) ) {
			gpbBlocks.push(block);
		}
	});

	// Remove blocks with no settings data.
	gpbBlocks = gpbBlocks.filter( ( block ) => {
		return block.hasOwnProperty( 'gb_settings_data' ) || block.hasOwnProperty( 'gpb_settings_data' );
	} );

	return gpbBlocks;
}

/**
 * Returns all user roles.
 *
 * @returns {{}}
 */
export function getAllRoles() {
	return genesis_page_builder_globals.allRoles;
}
