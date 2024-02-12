/**
 * Inspector Controls
 */

// Setup the block
const { __ } = wp.i18n;
const { Component } = wp.element;

import compact from 'lodash/compact';
import map from 'lodash/map';
import RenderSettingControl from '../../../../vendor/genesis/blocks/src/utils/components/settings/renderSettingControl';

// Import block components
const {
	InspectorControls
} = wp.blockEditor;

// Import Inspector components
const {
	PanelBody,
	QueryControls,
	RangeControl,
	SelectControl,
	TextControl,
	ToggleControl
} = wp.components;

const { addQueryArgs } = wp.url;

const { apiFetch } = wp;

const MAX_POSTS_COLUMNS = 4;

/**
 * Create an Inspector Controls wrapper Component
 */
export default class Inspector extends Component {

	constructor() {
		super( ...arguments );
		this.state = { categoriesList: [] };
	}

	componentDidMount() {
		this.stillMounted = true;
		this.fetchRequest = apiFetch({
			path: addQueryArgs( '/wp/v2/portfolio-type', { per_page: -1 })
		}).then(
			( categoriesList ) => {
				if ( this.stillMounted ) {
					this.setState({ categoriesList });
				}
			}
		).catch(
			() => {
				if ( this.stillMounted ) {
					this.setState({ categoriesList: [] });
				}
			}
		);
	}

	componentWillUnmount() {
		this.stillMounted = false;
	}

	/* Get the available image sizes */
	imageSizeSelect() {
		const getSettings = wp.data.select( 'core/block-editor' ).getSettings();

		return compact( map( getSettings.imageSizes, ({ name, slug }) => {
			return {
				value: slug,
				label: name
			};
		}) );
	}

	render() {

		// Setup the attributes
		const {
			attributes,
			setAttributes,
			latestPosts
		} = this.props;

		const {
			order,
			orderBy
		} = attributes;

		const { categoriesList } = this.state;

		// Section title tags
		const sectionTags = [
			{ value: 'div', label: __( 'div', 'genesis-page-builder' ) },
			{ value: 'header', label: __( 'header', 'genesis-page-builder' ) },
			{ value: 'section', label: __( 'section', 'genesis-page-builder' ) },
			{ value: 'article', label: __( 'article', 'genesis-page-builder' ) },
			{ value: 'main', label: __( 'main', 'genesis-page-builder' ) },
			{ value: 'aside', label: __( 'aside', 'genesis-page-builder' ) },
			{ value: 'footer', label: __( 'footer', 'genesis-page-builder' ) }
		];

		// Section title tags
		const sectionTitleTags = [
			{ value: 'h2', label: __( 'H2', 'genesis-page-builder' ) },
			{ value: 'h3', label: __( 'H3', 'genesis-page-builder' ) },
			{ value: 'h4', label: __( 'H4', 'genesis-page-builder' ) },
			{ value: 'h5', label: __( 'H5', 'genesis-page-builder' ) },
			{ value: 'h6', label: __( 'H6', 'genesis-page-builder' ) }
		];

		// Check for posts
		const hasPosts = Array.isArray( latestPosts ) && latestPosts.length;

		// Add instruction text to the select
		const abImageSizeSelect = {
			value: 'selectimage',
			label: __( 'Select image size', 'genesis-page-builder' )
		};

		// Add the landscape image size to the select
		const abImageSizeLandscape = {
			value: 'gpb-block-post-grid-landscape',
			label: __( 'GB Grid Landscape', 'genesis-page-builder' )
		};

		// Add the square image size to the select
		const abImageSizeSquare = {
			value: 'gpb-block-post-grid-square',
			label: __( 'GB Grid Square', 'genesis-page-builder' )
		};

		// Get the image size options
		const imageSizeOptions = this.imageSizeSelect();

		// Combine the objects
		imageSizeOptions.push( abImageSizeSquare, abImageSizeLandscape );
		imageSizeOptions.unshift( abImageSizeSelect );

		const imageSizeValue = () => {
			for ( let i = 0; i < imageSizeOptions.length; i++ ) {
				if ( imageSizeOptions[i].value === attributes.imageSize ) {
					return attributes.imageSize;
				}
			}
			return 'full';
		};

		return (
			<InspectorControls>
				<PanelBody
					title={ __( 'Portfolio Settings', 'genesis-page-builder' ) }
				>
					<RenderSettingControl id="gpb_portfolio_queryControls">
						<QueryControls
							{ ...{ order, orderBy } }
							numberOfItems={ attributes.postsToShow }
							categoriesList={ categoriesList }
							selectedCategoryId={ attributes.categories }
							onOrderChange={ ( value ) => setAttributes({ order: value }) }
							onOrderByChange={ ( value ) => setAttributes({ orderBy: value }) }
							onCategoryChange={ ( value ) => setAttributes({ categories: '' !== value ? value : undefined }) }
							onNumberOfItemsChange={ ( value ) => setAttributes({ postsToShow: value }) }
						/>
					</RenderSettingControl>
					<RenderSettingControl id="gpb_portfolio_offset">
						<RangeControl
							label={ __( 'Number of items to offset', 'genesis-page-builder' ) }
							value={ attributes.offset }
							onChange={ ( value ) => setAttributes({ offset: value }) }
							min={ 0 }
							max={ 20 }
						/>
					</RenderSettingControl>
					{ 'grid' === attributes.postLayout &&
						<RenderSettingControl id="gpb_portfolio_columns">
							<RangeControl
								label={ __( 'Columns', 'genesis-page-builder' ) }
								value={ attributes.columns }
								onChange={ ( value ) => setAttributes({ columns: value }) }
								min={ 1 }
								max={ ! hasPosts ? MAX_POSTS_COLUMNS : Math.min( MAX_POSTS_COLUMNS, latestPosts.length ) }
							/>
						</RenderSettingControl>
					}
				</PanelBody>
				<PanelBody
					title={ __( 'Portfolio Content', 'genesis-page-builder' ) }
					initialOpen={ false }
				>
					<RenderSettingControl id="gpb_portfolio_displaySectionTitle">
						<ToggleControl
							label={ __( 'Display Section Title', 'genesis-page-builder' ) }
							checked={ attributes.displaySectionTitle }
							onChange={ () => this.props.setAttributes({ displaySectionTitle: ! attributes.displaySectionTitle }) }
						/>
					</RenderSettingControl>
					{ attributes.displaySectionTitle &&
						<RenderSettingControl id="gpb_portfolio_sectionTitle">
							<TextControl
								label={ __( 'Section Title', 'genesis-page-builder' ) }
								type="text"
								value={ attributes.sectionTitle }
								onChange={ ( value ) => this.props.setAttributes({ sectionTitle: value }) }
							/>
						</RenderSettingControl>
					}
					<RenderSettingControl id="gpb_portfolio_displayPostImage">
						<ToggleControl
							label={ __( 'Display Featured Image', 'genesis-page-builder' ) }
							checked={ attributes.displayPostImage }
							onChange={ () => this.props.setAttributes({ displayPostImage: ! attributes.displayPostImage }) }
						/>
					</RenderSettingControl>
					{ attributes.displayPostImage &&
						<RenderSettingControl id="gpb_portfolio_imageSizeValue">
							<SelectControl
								label={ __( 'Image Size', 'genesis-page-builder' ) }
								value={ imageSizeValue() }
								options={ imageSizeOptions }
								onChange={ ( value ) => this.props.setAttributes({ imageSize: value }) }
							/>
						</RenderSettingControl>
					}
					<RenderSettingControl id="gpb_portfolio_displayPostTitle">
						<ToggleControl
							label={ __( 'Display Title', 'genesis-page-builder' ) }
							checked={ attributes.displayPostTitle }
							onChange={ () => this.props.setAttributes({ displayPostTitle: ! attributes.displayPostTitle }) }
						/>
					</RenderSettingControl>
					<RenderSettingControl id="gpb_portfolio_displayPostExcerpt">
						<ToggleControl
							label={ __( 'Display Excerpt', 'genesis-page-builder' ) }
							checked={ attributes.displayPostExcerpt }
							onChange={ () => this.props.setAttributes({ displayPostExcerpt: ! attributes.displayPostExcerpt }) }
						/>
					</RenderSettingControl>
					{ attributes.displayPostExcerpt &&
						<RenderSettingControl id="gpb_portfolio_excerptLength">
							<RangeControl
								label={ __( 'Excerpt Length', 'genesis-page-builder' ) }
								value={ attributes.excerptLength }
								onChange={ ( value ) => setAttributes({ excerptLength: value }) }
								min={ 0 }
								max={ 150 }
							/>
						</RenderSettingControl>
					}
					<RenderSettingControl id="gpb_portfolio_displayPostLink">
						<ToggleControl
							label={ __( 'Display Continue Reading Link', 'genesis-page-builder' ) }
							checked={ attributes.displayPostLink }
							onChange={ () => this.props.setAttributes({ displayPostLink: ! attributes.displayPostLink }) }
						/>
					</RenderSettingControl>
					{ attributes.displayPostLink &&
						<RenderSettingControl id="gpb_portfolio_readMoreText">
							<TextControl
								label={ __( 'Customize Continue Reading Text', 'genesis-page-builder' ) }
								type="text"
								value={ attributes.readMoreText }
								onChange={ ( value ) => this.props.setAttributes({ readMoreText: value }) }
							/>
						</RenderSettingControl>
					}
				</PanelBody>
				<PanelBody
					title={ __( 'Portfolio Markup', 'genesis-page-builder' ) }
					initialOpen={ false }
					className="gpb-block-post-grid-markup-settings"
				>
					<RenderSettingControl id="gpb_portfolio_sectionTag">
						<SelectControl
							label={ __( 'Post Grid Section Tag', 'genesis-page-builder' ) }
							options={ sectionTags }
							value={ attributes.sectionTag }
							onChange={ ( value ) => this.props.setAttributes({ sectionTag: value }) }
							help={ __( 'Change the post grid section tag to match your content hierarchy.', 'genesis-page-builder' ) }
						/>
					</RenderSettingControl>
					{ attributes.sectionTitle &&
						<RenderSettingControl id="gpb_portfolio_sectionTitleTag">
							<SelectControl
								label={ __( 'Section Title Heading Tag', 'genesis-page-builder' ) }
								options={ sectionTitleTags }
								value={ attributes.sectionTitleTag }
								onChange={ ( value ) => this.props.setAttributes({ sectionTitleTag: value }) }
								help={ __( 'Change the post/page section title tag to match your content hierarchy.', 'genesis-page-builder' ) }
							/>
						</RenderSettingControl>
					}
					{ attributes.displayPostTitle &&
						<RenderSettingControl id="gpb_portfolio_postTitleTag">
							<SelectControl
								label={ __( 'Post Title Heading Tag', 'genesis-page-builder' ) }
								options={ sectionTitleTags }
								value={ attributes.postTitleTag }
								onChange={ ( value ) => this.props.setAttributes({ postTitleTag: value }) }
								help={ __( 'Change the post/page title tag to match your content hierarchy.', 'genesis-page-builder' ) }
							/>
						</RenderSettingControl>
					}
				</PanelBody>
			</InspectorControls>
		);
	}
}
