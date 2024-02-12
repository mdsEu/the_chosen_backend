/**
 * BLOCK: Genesis Blocks Button
 */

// Don't delete this import, as it's used in the Pricing Table block.
import './styles/style.scss';

import { useDispatch, useSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import { createBlock, registerBlockType } from '@wordpress/blocks';
import { useEffect } from '@wordpress/element';

import deprecated from './deprecated';
import convertChildAttributes from './deprecated/convert-child-attributes';
import convertParentAttributes from './deprecated/convert-parent-attributes';

function Edit( { attributes, clientId } ) {
	const { replaceBlocks, replaceInnerBlocks } =
		useDispatch( 'core/block-editor' );
	const { getBlock, getBlockParents } = useSelect( ( select ) =>
		select( 'core/block-editor' )
	);

	useEffect( () => {
		const parentId = getBlockParents( clientId, true )?.[ 0 ];
		const hasParent = !! parentId;
		const newBlock = createBlock(
			'core/buttons',
			convertParentAttributes( attributes ),
			[
				createBlock(
					'core/button',
					convertChildAttributes( attributes )
				),
			]
		);

		// Replace this GB Button block with the Core Button block.
		if ( hasParent ) {
			replaceInnerBlocks(
				parentId,
				getBlock( parentId ).innerBlocks?.map( ( block ) => {
					return block.clientId === clientId ? newBlock : block;
				} )
			);
		} else {
			replaceBlocks( clientId, newBlock );
		}
	}, [ clientId ] ); // eslint-disable-line react-hooks/exhaustive-deps

	return null;
}

// Register the block
registerBlockType( 'genesis-blocks/gb-button', {
	title: __( 'Button', 'genesis-blocks' ),
	description: __( 'Add a customizable button.', 'genesis-blocks' ),
	icon: 'admin-links',
	supports: { inserter: false },
	category: 'genesis-blocks',
	keywords: [
		__( 'button', 'genesis-blocks' ),
		__( 'link', 'genesis-blocks' ),
		__( 'genesis', 'genesis-blocks' ),
	],
	edit: Edit,
	save: () => null,
	deprecated,
} );
