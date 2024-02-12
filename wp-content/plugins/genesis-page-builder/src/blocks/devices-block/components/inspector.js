/**
 * Inspector Controls
 */

/**
 * Internal dependencies
 */
import BackgroundImagePanel from '../../../../vendor/genesis/blocks/src/utils/components/background-image/inspector';
import RenderSettingControl from "../../../../vendor/genesis/blocks/src/utils/components/settings/renderSettingControl";

/* Setup the block */
const { __ } = wp.i18n;
const { Component } = wp.element;

/* Import block components */
const { InspectorControls } = wp.blockEditor;

/* Import Inspector components */
const {
	PanelBody,
	SelectControl,
	ToggleControl,
	RangeControl
} = wp.components;

/* Create an Inspector Controls wrapper Component */
export default class Inspector extends Component {

	render() {

		/* Setup the attributes */
		const { attributes } = this.props;

		const deviceOptions = [
			{ value: 'gpb-device-phone', label: __( 'Phone', 'genesis-page-builder' ) },
			{ value: 'gpb-device-tablet', label: __( 'Tablet', 'genesis-page-builder' ) }
		];

		const deviceOrientationOptions = [
			{ value: 'gpb-device-vertical', label: __( 'Vertical', 'genesis-page-builder' ) },
			{ value: 'gpb-device-horizontal', label: __( 'Horizontal', 'genesis-page-builder' ) }
		];

		const deviceColorOptions = [
			{ value: 'gpb-device-black', label: __( 'Black', 'genesis-page-builder' ) },
			{ value: 'gpb-device-white', label: __( 'White', 'genesis-page-builder' ) }
		];

		return (
			<InspectorControls key="inspector">
				<PanelBody>
					<RenderSettingControl id="gpb_devices_device_type">
						<SelectControl
							label={ __( 'Device Type', 'genesis-page-builder' ) }
							description={ __( 'Choose between a mobile or tablet mockup.', 'genesis-page-builder' ) }
							options={ deviceOptions }
							value={ attributes.deviceType }
							onChange={ ( value ) => this.props.setAttributes({ deviceType: value }) }
						/>
					</RenderSettingControl>

					<RenderSettingControl id="gpb_devices_device_color">
						<SelectControl
							label={ __( 'Device Color', 'genesis-page-builder' ) }
							description={ __( 'Choose between a black or white device.', 'genesis-page-builder' ) }
							options={ deviceColorOptions }
							value={ attributes.deviceColor }
							onChange={ ( value ) => this.props.setAttributes({ deviceColor: value }) }
						/>
					</RenderSettingControl>

					<RenderSettingControl id="gpb_devices_device_orientation">
						<SelectControl
							label={ __( 'Device Orientation', 'genesis-page-builder' ) }
							description={ __( 'Choose between vertical or horizontal orientation.', 'genesis-page-builder' ) }
							options={ deviceOrientationOptions }
							value={ attributes.deviceOrientation }
							onChange={ ( value ) => this.props.setAttributes({ deviceOrientation: value }) }
						/>
					</RenderSettingControl>

					<RenderSettingControl id="gpb_devices_drop_shadow">
						<ToggleControl
							label={ __( 'Enable Drop Shadow', 'genesis-page-builder' ) }
							checked={ attributes.deviceShadow }
							onChange={ () => this.props.setAttributes({ deviceShadow: ! attributes.deviceShadow }) }
						/>
					</RenderSettingControl>

					<RenderSettingControl id="gpb_devices_device_max_width">
						<RangeControl
							label={ __( 'Device Max Width', 'genesis-page-builder' ) }
							value={ attributes.deviceMaxWidth }
							onChange={ ( value ) => this.props.setAttributes({ deviceMaxWidth: value }) }
							min={ 100 }
							max={ 2000 }
							step={ 1 }
						/>
					</RenderSettingControl>

					<RenderSettingControl id="gpb_devices_device_border_width">
						<RangeControl
							label={ __( 'Device Border Width', 'genesis-page-builder' ) }
							value={ attributes.deviceBorder }
							onChange={ ( value ) => this.props.setAttributes({ deviceBorder: value }) }
							min={ 0 }
							max={ 2 }
							step={ .01 }
						/>
					</RenderSettingControl>

					<RenderSettingControl id="gpb_devices_device_border_radius">
						<RangeControl
							label={ __( 'Device Border Radius', 'genesis-page-builder' ) }
							value={ attributes.deviceBorderRadius }
							onChange={ ( value ) => this.props.setAttributes({ deviceBorderRadius: value }) }
							min={ 0 }
							max={ 75 }
							step={ 1 }
						/>
					</RenderSettingControl>
				</PanelBody>

				<RenderSettingControl id="gpb_devices_device_background_image">
					<BackgroundImagePanel { ...this.props }>
					</BackgroundImagePanel>
				</RenderSettingControl>
			</InspectorControls>
		);
	}
}