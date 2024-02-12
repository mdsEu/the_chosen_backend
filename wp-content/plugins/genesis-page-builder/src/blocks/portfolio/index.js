/**
 * BLOCK: Genesis Page Builder Portfolio
 */

// Import block dependencies and components
import edit from './components/edit';

// Import CSS
import './styles/style.scss';
import './styles/editor.scss';

// Components
const { __ } = wp.i18n;

// Register block controls
const {
	registerBlockType
} = wp.blocks;

// Register alignments
const validAlignments = [ 'center', 'wide', 'full' ];

// Register the block
registerBlockType( 'genesis-page-builder/gpb-portfolio-grid', {
	title: __( 'Portfolio Block', 'genesis-page-builder' ),
	description: __( 'Customize and display your portfolio items.', 'genesis-page-builder' ),
	icon: 'format-gallery',
	category: 'genesis-blocks',
	keywords: [
		__( 'portfolio', 'genesis-page-builder' ),
		__( 'project', 'genesis-page-builder' ),
		__( 'gallery', 'genesis-page-builder' ),
		'genesis',
		'gpb'
	],

	getEditWrapperProps( attributes ) {
		const { align } = attributes;
		if ( -1 !== validAlignments.indexOf( align ) ) {
			return { 'data-align': align };
		}
	},

	edit,

	gpb_settings_data: {
		gpb_portfolio_queryControls: {
			title: __( 'Query Controls', 'genesis-page-builder' )
		},
		gpb_portfolio_offset: {
			title: __( 'Portfolio Offset', 'genesis-page-builder' )
		},
		gpb_portfolio_columns: {
			title: __( 'Portfolio Columns', 'genesis-page-builder' )
		},
		gpb_portfolio_displaySectionTitle: {
			title: __( 'Display Portfolio Section Title', 'genesis-page-builder' )
		},
		gpb_portfolio_sectionTitle: {
			title: __( 'Portfolio Section Title', 'genesis-page-builder' )
		},
		gpb_portfolio_displayPostImage: {
			title: __( 'Display Portfolio Featured Image', 'genesis-page-builder' )
		},
		gpb_portfolio_imageSizeValue: {
			title: __( 'Portfolio Image Size', 'genesis-page-builder' )
		},
		gpb_portfolio_displayPostTitle: {
			title: __( 'Display Portfolio Post Title', 'genesis-page-builder' )
		},
		gpb_portfolio_displayPostExcerpt: {
			title: __( 'Display Portfolio Post Excerpt', 'genesis-page-builder' )
		},
		gpb_portfolio_excerptLength: {
			title: __( 'Portfolio Excerpt Length', 'genesis-page-builder' )
		},
		gpb_portfolio_displayPostLink: {
			title: __( 'Display Continue Reading Link', 'genesis-page-builder' )
		},
		gpb_portfolio_readMoreText: {
			title: __( 'Read More Text', 'genesis-page-builder' )
		},
		gpb_portfolio_sectionTag: {
			title: __( 'Portfolio Section Tag', 'genesis-page-builder' )
		},
		gpb_portfolio_sectionTitleTag: {
			title: __( 'Portfolio Section Title Heading Tag', 'genesis-page-builder' )
		},
		gpb_portfolio_postTitleTag: {
			title: __( 'Portfolio Item Title Heading Tag', 'genesis-page-builder' )
		}
	},
	// Render via PHP
	save() {
		return null;
	}
});
