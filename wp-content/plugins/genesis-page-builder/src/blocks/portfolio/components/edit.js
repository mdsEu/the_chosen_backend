/**
 * External dependencies
 */

import isUndefined from 'lodash/isUndefined';
import pickBy from 'lodash/pickBy';
import classnames from 'classnames';
import Inspector from './inspector';
import PostGridImage from '../../../../vendor/genesis/blocks/src/blocks/block-post-grid/components/image';

const { compose } = wp.compose;

const { Component, Fragment } = wp.element;

const { __ } = wp.i18n;

const { decodeEntities } = wp.htmlEntities;

const {
	withSelect
} = wp.data;

const {
	Placeholder,
	Spinner
} = wp.components;

const {
	BlockAlignmentToolbar,
	BlockControls
} = wp.blockEditor;

class LatestPostsBlock extends Component {

	render() {
		const {
			attributes,
			setAttributes,
			latestPosts
		} = this.props;

		// Check if there are posts
		const hasPosts = Array.isArray( latestPosts ) && latestPosts.length;

		if ( ! hasPosts ) {
			return (
				<Fragment>
					<Inspector
						{ ...{ setAttributes, ...this.props } }
					/>
					<Placeholder
						icon="admin-post"
						label={ __( 'Genesis Blocks Pro Portfolio', 'genesis-page-builder' ) }
					>
						{ ! Array.isArray( latestPosts ) ?
							<Spinner /> :
							__( 'No portfolio posts found.', 'genesis-page-builder' )
						}
					</Placeholder>
				</Fragment>
			);
		}

		// Removing posts from display should be instant.
		const displayPosts = latestPosts.length > attributes.postsToShow ?
			latestPosts.slice( 0, attributes.postsToShow ) :
			latestPosts;

		// Get the section tag
		const SectionTag = attributes.sectionTag ? attributes.sectionTag : 'section';

		// Get the section title tag
		const SectionTitleTag = attributes.sectionTitleTag ? attributes.sectionTitleTag : 'h2';

		// Get the post title tag
		const PostTag = attributes.postTitleTag ? attributes.postTitleTag : 'h3';

		return (
			<Fragment>
				<Inspector
					{ ...{ setAttributes, ...this.props } }
				/>
				<BlockControls>
					<BlockAlignmentToolbar
						value={ attributes.align }
						onChange={ ( value ) => {
							setAttributes({ align: value });
						} }
						controls={ [ 'center', 'wide', 'full' ] }
					/>
				</BlockControls>
				<SectionTag
					className={ classnames(
						this.props.className,
						'gpb-block-post-grid gpb-portfolio-grid',
					) }
				>
					{ attributes.displaySectionTitle && attributes.sectionTitle &&
						<SectionTitleTag className="gpb-post-grid-section-title">{ attributes.sectionTitle }</SectionTitleTag>
					}

					<div
						className={ classnames({
							'is-grid': 'grid' === attributes.postLayout,
							'is-list': 'list' === attributes.postLayout,
							[ `columns-${ attributes.columns }` ]: 'grid' === attributes.postLayout,
							'gpb-post-grid-items': 'gpb-post-grid-items'
						}) }
					>
						{ displayPosts.map( ( post, i ) =>
							<article
								key={ i }
								id={ 'post-' + post.id }
								className={ classnames(
									'post-' + post.id,
									'gpb-portfolio-grid-item',
									post.featured_image_src && attributes.displayPostImage ? 'has-post-thumbnail' : null
								) }
							>
								{
									attributes.displayPostImage && post.featured_media ? (
										<PostGridImage
											{ ...this.props }
											imgAlt={ decodeEntities( post.title.rendered.trim() ) || __( '(Untitled)', 'genesis-page-builder' ) }
											imgClass={ `wp-image-${post.featured_media.toString()}` }
											imgID={ post.featured_media.toString() }
											imgSize={ attributes.imageSize }
											imgSizeLandscape={ post.featured_image_src }
											imgSizeSquare={ post.featured_image_src_square }
											imgLink={ post.link }
										/>
									) : (
										null
									)
								}

								<div className="gpb-block-post-grid-text">
									<header className="gpb-block-post-grid-header">
										{ attributes.displayPostTitle &&
											<PostTag className="gpb-block-post-grid-title"><a href={ post.link } target="_blank" rel="bookmark">{ decodeEntities( post.title.rendered.trim() ) || __( '(Untitled)', 'genesis-page-builder' ) }</a></PostTag>
										}
									</header>

									<div className="gpb-block-post-grid-excerpt">
										{ attributes.displayPostExcerpt && post.excerpt &&
											<div dangerouslySetInnerHTML={ { __html: truncate( post.excerpt.rendered, attributes.excerptLength ) } } />
										}

										{ attributes.displayPostLink &&
											<p><a className="gpb-block-post-grid-more-link gpb-text-link" href={ post.link } target="_blank" rel="bookmark">{ attributes.readMoreText }</a></p>
										}
									</div>
								</div>
							</article>
						) }
					</div>
				</SectionTag>
			</Fragment>
		);
	}
}

export default compose([
	withSelect( ( select, props ) => {
		const {
			order,
			categories
		} = props.attributes;

		const { getEntityRecords } = select( 'core' );

		const args = {
			'portfolio-type': categories,
			order,
			orderby: props.attributes.orderBy,
			per_page: props.attributes.postsToShow,
			offset: props.attributes.offset,
		}

		// Only append the exclude if this block is sitting on a post.
		if ( wp.data.select( 'core/editor' ) ) {
			const currentPostId = wp.data.select( 'core/editor' ).getCurrentPostId();
			if ( currentPostId ) {
				args.exclude = [ currentPostId ];
			}
		}

		const latestPostsQuery = pickBy(args, ( value ) => ! isUndefined( value ) );

		return {
			latestPosts: getEntityRecords( 'postType', 'gpb_portfolio', latestPostsQuery )
		};
	})
])( LatestPostsBlock );

// Truncate excerpt
function truncate( str, no_words ) {
	return str.split( ' ' ).splice( 0, no_words ).join( ' ' );
}
