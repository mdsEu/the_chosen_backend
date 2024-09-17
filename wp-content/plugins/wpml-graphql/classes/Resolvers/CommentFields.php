<?php

namespace WPML\GraphQL\Resolvers;

use WPGraphQL\AppContext;
use WPGraphQL\Model\Comment;
use WPGraphQL\Model\Model;
use GraphQL\Type\Definition\ResolveInfo;
use WPML\GraphQL\Resolvers\Interfaces\LanguageFields;
use WPML\GraphQL\Resolvers\Interfaces\ModelFields;

class CommentFields extends BaseFields implements LanguageFields, ModelFields {

	const MODEL_OBJECT = 'CommentObject';

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
		if ( ! $comment instanceof Comment ) {
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
		if ( ! $comment instanceof Comment ) {
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

	/**
	 * @param mixed[]              $fields
	 * @param string               $modelName
	 * @param mixed[]|object|mixed $data
	 *
	 * @return mixed[]
	 */
	public function adjustModelFields( $fields, $modelName, $data ) {
		if ( self::MODEL_OBJECT !== $modelName ) {
			return $fields;
		}

		$currentLanguage = $this->helpers->getCurrentLanguage();
		$languageCode    = apply_filters( 'wpml_element_language_code', null, [
			'element_id'   => $data->comment_post_ID,
			'element_type' => get_post_type( (int) $data->comment_post_ID ),
		]);

		$fields['link'] = function() use ( $data, $currentLanguage, $languageCode ) {
			$this->helpers->setCurrentLanguage( $languageCode );

			$link = get_comment_link( $data );

			$this->helpers->setCurrentLanguage( $currentLanguage );

			return ! empty( $link ) ? urldecode( $link ) : null;
		};

		$fields['uri'] = function() use ( $data, $currentLanguage, $languageCode ) {
			$this->helpers->setCurrentLanguage( $languageCode );

			$link = get_comment_link( $data );

			$this->helpers->setCurrentLanguage( $currentLanguage );

			return ! empty( $link ) ? str_ireplace( home_url(), '', $link ) : null;
		};

		return $fields;
	}

}
