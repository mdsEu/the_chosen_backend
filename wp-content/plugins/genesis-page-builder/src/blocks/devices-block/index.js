/**
 * BLOCK: Genesis Page Builder Device Mockup
 */

/**
 * Internal dependencies
 */
import Edit from './components/edit';
import Save from './components/save';
import './styles/style.scss';
import './styles/editor.scss';
import blockAttributes from './components/attributes';

/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

/**
 * Register the block
 */
registerBlockType( 'genesis-page-builder/gpb-devices', {
	title: __( 'Device Mockup', 'genesis-page-builder' ),
	description: __( 'Add a mobile or tablet image mockup.', 'genesis-page-builder' ),
	icon: 'tablet',
	category: 'genesis-blocks',
	keywords: [
		__( 'phone', 'genesis-page-builder' ),
		__( 'tablet', 'genesis-page-builder' ),
		__( 'mockup', 'genesis-page-builder' ),
		'genesis',
		'gpb'
	],

	/* Setup the block attributes */
	attributes: blockAttributes,

	gpb_settings_data: {
		gpb_devices_device_type: {
			title: __( 'Device Type', 'genesis-page-builder' )
		},
		gpb_devices_device_color: {
			title: __( 'Device Color', 'genesis-page-builder' )
		},
		gpb_devices_device_orientation: {
			title: __( 'Device Orientation', 'genesis-page-builder' )
		},
		gpb_devices_device_drop_shadow: {
			title: __( 'Drop Shadow', 'genesis-page-builder' )
		},
		gpb_devices_device_device_max_width: {
			title: __( 'Device Max Width', 'genesis-page-builder' )
		},
		gpb_devices_device_border_width: {
			title: __( 'Device Border Width', 'genesis-page-builder' )
		},
		gpb_devices_device_border_radius: {
			title: __( 'Device Border Radius', 'genesis-page-builder' )
		},
		gpb_devices_device_background_image: {
			title: __( 'Device Background Image', 'genesis-page-builder' )
		}
	},

	/* Render the block in the editor. */
	edit: props => {
		return <Edit { ...props } />;
	},

	/* Save the block markup. */
	save: props => {
		return <Save { ...props } />;
	}
});