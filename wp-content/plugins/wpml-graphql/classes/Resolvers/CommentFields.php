<?php

namespace WPML\GraphQL\Resolvers;

use WPGraphQL\AppContext;
use WPGraphQL\Model\Model;
use GraphQL\Type\Definition\ResolveInfo;
use WPML\GraphQL\Resolvers\Interfaces\LanguageFields;

class CommentFields extends BaseFields implements LanguageFields {

	/**
	 * Resolve language field
	 *
	 * @param Model       $comment
	 * @param mixed[]     $args
	 * @param AppContext  $context
	 * @param ResolveInfo $info
	 *
	 * @return null|mixed[]
	 */
	public function resolveLanguageField(
		Model $comment,
		$args,
		AppContext $context,
		ResolveInfo $info
	) {
		if ( ! $comment instanceof \WPGraphQL\Model\Comment ) {
			return null;
		}

		$fields = array_keys( $info->getFieldSelection() );

		if ( empty( $fields ) ) {
			return null;
		}

		$commentId     = $comment->comment_ID;
		$commentPostId = $comment->comment_post_ID;
		$commentPost   = $this->helpers->wpPost( $commentPostId );

		if ( ! $commentPost ) {
			return null;
		}

		if ( $this->helpers->isPostPreview( $commentPost ) ) {
			// Preview post: get parent post language, if any.
			$commentPostId = wp_get_post_parent_id( $commentPost->ID );
		}

		$languageData = $this->helpers->getElementLanguageData( $commentPostId, $commentPost->post_type );

		if ( ! $languageData ) {
			return null;
		}

		return $this->helpers->filterFields( $languageData, $fields );
	}

	/**
	 * Resolve language code field
	 *
	 * @param Model $comment
	 *
	 * @return null|string
	 */
	public function resolveLanguageCodeField( Model $comment ) {
		if ( ! $comment instanceof \WPGraphQL\Model\Comment ) {
			return null;
		}

		$commentPostId = $comment->comment_post_ID;
		$commentPost   = $this->helpers->wpPost( $commentPostId );

		if ( ! $commentPost ) {
			return null;
		}

		if ( $this->helpers->isPostPreview( $commentPost ) ) {
			// Preview post: get parent post language, if any.
			$commentPostId = wp_get_post_parent_id( $commentPost->ID );
		}

		return $this->helpers->getElementLanguageCode( $commentPostId, $commentPost->post_type );
	}

}
