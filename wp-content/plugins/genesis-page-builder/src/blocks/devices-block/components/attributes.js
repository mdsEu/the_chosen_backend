import BackgroundAttributes from '../../../../vendor/genesis/blocks/src/utils/components/background-image/attributes';

const blockAttributes = {
	...BackgroundAttributes,
	deviceImage: {
		type: 'string'
	},
	deviceType: {
		type: 'string',
		default: 'gpb-device-phone'
	},
	deviceOrientation: {
		type: 'string'
	},
	deviceShadow: {
		type: 'boolean',
		default: true
	},
	deviceColor: {
		type: 'string'
	},
	deviceMaxWidth: {
		type: 'number',
		default: 350
	},
	deviceBorder: {
		type: 'number'
	},
	deviceBorderRadius: {
		type: 'number'
	},
	deviceAlignment: {
		type: 'string'
	}
};

export default blockAttributes;