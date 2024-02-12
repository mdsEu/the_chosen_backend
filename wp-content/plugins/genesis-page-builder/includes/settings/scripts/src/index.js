/**
 * WordPress dependencies.
 */
const { React } = window;
const { Component, useState, useEffect } = React;
const { __ } = wp.i18n;
const { Fill } = wp.components;
const { registerPlugin } = wp.plugins;
const { addAction } = wp.hooks;
const { dispatch } = wp.data;
const apiFetch = wp.apiFetch;

/**
 * Internal dependencies.
 */
import {
	get_registered_gpb_blocks,
	getAllRoles,
	getBlockSettingsPermissions
} from "../../../../src/permissions/block-settings-permissions";

/**
 * External dependencies.
 */
import classnames from "classnames";

/**
 * Option name used to persist state to the settings app.
 *
 * @type {string}
 */
const optionName = 'block_settings_permissions';

/**
 * Displays the checkbox element.
 */
const RoleCheckbox = ( props ) => {
	return (
		<>
			<label className="gb-checkbox-label">
				<input
					type="checkbox"
					name={ props.checkboxName }
					value={ props.role.toLowerCase() }
					checked={ props.checked }
					onChange={
						( e ) => props.onClick( e )
					}
					data-setting={props.setting}
					data-block={props.block}
				/>
				{ props.role }
			</label>
		</>
	);
}

/**
 * Displays a list of checkboxes for the roles.
 */
const RolesList = ( props ) => {
	return (
		<fieldset>
			<legend className="screen-reader-text"><span>{ __( 'Roles', 'genesis-page-builder' ) }</span></legend>
			{
				Object.values( props.roles ).map( ( role ) => {
					let checked = true;
					if ( props.permissions[props.block] !== undefined && props.permissions[props.block][props.setting.name] !== undefined ) {
						const rolekey = role.name.toLowerCase();
						checked = props.permissions[props.block][props.setting.name][rolekey];
					}
					return (
						<RoleCheckbox
							key={ 'key_' + props.block + '_' + props.setting.name + '_' + role.name.toLowerCase() }
							block={ props.block }
							role={ role.name }
							setting={ props.setting.name }
							checkboxName={ `genesis-page-builder-settings[block_settings_permissions][${props.block}][${props.setting.name}][]` }
							checked={ checked }
							onClick={ props.onClick }
						/>
					);
				} )
			}
		</fieldset>
	);
}

/**
 * Displays the individual setting and its role checkboxes.
 */
const Setting = ( props ) => {
	const [ open, toggleOpen ] = useState( props.allExpanded || props.isOpen );

	useEffect( () => {
		const newOpen = ( props.allExpanded || props.isOpen );
		toggleOpen( newOpen );
	}, [ props.isOpen ] );

	return (
		<details key={ 'key_' + props.setting } className={ classnames(
			"gpb-control-settings-control-settings-entry gb-admin-accordion-panel",
			open ? 'gpb-control-settings-entry-open' : null
		) } open={open}>
			<summary className="gpb-control-settings-block-setting-summary">
				<h4>{ props.setting.title }</h4>
			</summary>

			<div className="gpb-control-settings-block-permission gb-details-content">
				<RolesList
					roles={ props.roles }
					permissions={ props.permissions }
					setting={ props.setting }
					block={ props.block.name }
					onClick={ props.onClick }
				/>
			</div>
		</details>
	);
}

/**
 * Displays a list of settings for each block.
 */
const Settings = ( props ) => {
	const [ open, toggleOpen ] = useState( props.isOpen );

	useEffect( () => {
		toggleOpen( props.isOpen );
	}, [ props.isOpen ] );

	return (
		<>
			<details className="gpb-control-settings-block gb-admin-accordion-panel" open={open}>
				<summary className="gpb-control-settings-block-summary">
					<h3>{ props.block.title }</h3>
					<div className="gpb-control-settings-entry-header">
						<span class="screen-reader-text"> { __( 'Block Settings Permissions', 'genesis-page-builder' ) }</span>
					</div>
				</summary>
				<div className={ classnames( "gpb-control-settings-control-settings gb-details-content", open ? 'gpb-control-settings-control-settings-open' : null )}>
					{ typeof props.settings !== 'undefined' &&
						Object.keys( props.settings ).map( ( setting ) => {
							return (
								<Setting
									key={ 'key_' + props.block.name + '_' + setting }
									roles={ props.roles }
									permissions={ props.permissions }
									setting={ { name: setting, title: props.settings[setting].title } }
									block={ props.block }
									onClick={ props.onClick }
									isOpen={ props.allExpanded }
									allExpanded={ props.allExpanded }
								/>
							);
						} )
					}
				</div>
			</details>
		</>
	);
}

/**
 * Displays the individual block panel and its associated settings list.
 */
const Block = ( props ) => {
	return (
		<div className="gpb-control-settings-entry">
			<Settings
				roles={ props.roles }
				settings={ props.settings[props.block.name] }
				permissions={ props.permissions }
				block={ props.block }
				onClick={ props.onClick }
				isOpen={ ( props.isOpen ) }
				allExpanded={ props.allExpanded }
			/>
		</div>
	);
}

/**
 * Displays the list of blocks.
 */
const Blocks = ( props ) => {
	return (
		<div className="gpb-control-settings-entries">
			{
				props.blocks.map( ( block ) => {
					return (
						<Block
							key={ 'key_' + block.name }
							settings={props.settings}
							roles={props.roles}
							block={block}
							onClick={props.onClick}
							permissions={props.permissions}
							isOpen={ props.allExpanded }
							allExpanded={ props.allExpanded }
						/>
					);
				})
			}
		</div>
	);
}

/**
 * The Block Settings Permissions settings page app.
 */
export class App extends Component {
	constructor( props ) {
		super( props );
		this.state = {
			permissions: props.permissions || {},
			allExpanded: false,
		}
		this.updatePermissionsState = this.updatePermissionsState.bind( this );
	}

	updatePermissionsState( permissions ) {
		const { updateCustom } = dispatch( 'genesis-blocks/global-settings' );
		let perms = this.state.permissions;

		if ( typeof perms[permissions.target.dataset.block] === 'undefined' ) {
			perms[permissions.target.dataset.block] = {};
		}

		if ( typeof perms[permissions.target.dataset.block][permissions.target.dataset.setting] === 'undefined' ) {
			perms[permissions.target.dataset.block][permissions.target.dataset.setting] = {};
		}

		if ( typeof perms[permissions.target.dataset.block][permissions.target.dataset.setting][permissions.target.value] === 'undefined' ) {
			perms[permissions.target.dataset.block][permissions.target.dataset.setting][permissions.target.value] = {};
		}
		perms[permissions.target.dataset.block][permissions.target.dataset.setting][permissions.target.value] = permissions.target.checked;
		this.setState({permissions: perms});

		// Push state up to the Genesis Blocks settings application data store.
		// Ensures permissions setting changes are not lost if someone switches
		// tab (unloads this application's state) and then clicks Save All.
		updateCustom({
			key: optionName,
			value: perms,
		});
	}

	render() {
		return (
			<div className="gpb-control-settings">
				<div className="gpb-control-settings-head">
					<div><h2>{ __( 'Block Name', 'genesis-page-builder' ) }</h2></div>
					<div>
						<button onClick={ () => { this.setState({ allExpanded: true }) } } className={ classnames( "gpb-control-settings-expand-all gb-admin-button-link aligned", ! this.state.allExpanded ? null : 'gpb-hidden' )}>{ __( 'Expand All', 'genesis-page-builder' ) }</button>
						<button onClick={ () => { this.setState({ allExpanded: false }) } } className={ classnames( "gpb-control-settings-collapse-all gb-admin-button-link aligned", this.state.allExpanded ? 'gpb-visible' : null ) }>{ __( 'Collapse All', 'genesis-page-builder' ) }</button>
					</div>
				</div>

				<Blocks
					settings={ this.props.settings }
					roles={ this.props.roles }
					blocks={ this.props.blocks }
					onClick={ (e) => { this.updatePermissionsState(e) } }
					permissions={ this.state.permissions }
					allExpanded={ this.state.allExpanded }
				/>
			</div>
		);
	}
}

/**
 * Parses the registered blocks and returns an object
 * containing the settings data for all the blocks.
 */
const parseBlockSettings = ( blocks ) => {
	let settings = {};
	Object.values( blocks ).map( ( block ) => {
		if ( block.gb_settings_data !== undefined ) {
			settings[block.name] = block.gb_settings_data;
		}

		if ( block.gpb_settings_data !== undefined ) {
			settings[block.name] = block.gpb_settings_data;
		}
	} );
	return settings;
}

/**
 * Generates initial permission settings.
 *
 * So that the full permission tree is stored if this is the first save, instead
 * of just changed settings.
 *
 * @param {Object} perms Permissions passed to the component from the database.
 * @returns {Object} Initial permissions in the form { 'genesis-blocks/gb-accordion' : gb_accordion_accordionFontSize: { title: "Title Font Size", administrator: true, ... } ... }`.
 */
const initialPermissions = ( perms) => {
	// Set defaults only if permissions were not saved before.
	if ( Object.keys( perms ).length > 0 ) {
		return perms;
	}

	// Generates a role table: { administrator: true, editor: true, ... }
	const roles = Object.keys( getAllRoles() );
	const roleTable = roles.reduce( ( table, role ) => {
		table[role] = true;
		return table;
	}, {});

	let blocks = parseBlockSettings( get_registered_gpb_blocks() );

	for (const [block, settings] of Object.entries( blocks )) {
		for ( const setting in settings ) {
			blocks[block][setting] = {
				title: blocks[block][setting]['title'],
				...roleTable
			};
		}
	}

	return blocks;
}

/**
 * Renders the settings app.
 *
 * Wrapping in a `Fill` places the app inside the Block Permissions tab.
 *
 * The tab is declared in `includes/settings/tabs/block-permissions.php`
 * and rendered by the Settings app in Genesis Blocks.
 */
const render = () => {
	let blocks = get_registered_gpb_blocks();
	let permissions = getBlockSettingsPermissions();

	return (
		<Fill name="GenesisBlocksSettings_block_permissions_section">
			<App
				blocks={ blocks }
				settings={ parseBlockSettings( blocks ) }
				roles={ getAllRoles() }
				permissions={ initialPermissions( permissions ) }
			/>
		</Fill>
	);
}

// Registers a 'plugin' to render output inside the Genesis Blocks settings app.
// The settings app then moves the Fill into the specified tab Slot.
registerPlugin( 'genesis-pro-permission-settings', { render } );

/**
 * Saves block permissions settings when Genesis Blocks settings are saved.
 */
const saveSettings = ( _, custom ) => {
	if ( ! custom.hasOwnProperty( optionName ) ) {
		return;
	}

	// Removes the 'title' attribute before storing permission settings.
	for (const [block, settings] of Object.entries( custom[optionName] )) {
		for ( const setting in settings ) {
			delete custom[optionName][block][setting]['title'];
		}
	}

	apiFetch( {
		path: '/genesis-page-builder/v1/block-permissions',
		method: 'PUT',
		data: custom[optionName],
	} );
}
addAction( 'genesisBlocks.savingSettings', 'genesisBlocks', saveSettings );
