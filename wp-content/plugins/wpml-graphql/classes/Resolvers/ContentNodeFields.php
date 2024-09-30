<?php

namespace WPML\GraphQL\Resolvers;

use WPGraphQL\AppContext;
use WPGraphQL\Model\Model;
use WPGraphQL\Model\Post;
use GraphQL\Type\Definition\ResolveInfo;
use WPML\GraphQL\Resolvers\Interfaces\LanguageFields;
use WPML\GraphQL\Resolvers\Interfaces\ModelFields;

class ContentNodeFields extends BaseFields implements LanguageFields {

	/**
	 * Resolve language field
	 *
	 * @param Model       $post
	 * @param mixed[]     $args
	 * @param AppContext  $context
	 * @param ResolveInfo $info
	 *
	 * @return null|mixed[]
	 */
	public function resolveLanguageField(
		Model $post,
		$args,
		AppContext $context,
		ResolveInfo $info
	) {
		if ( ! $post instanceof Post ) {
			return null;
		}

		$fields = array_keys( $info->getFieldSelection() );
		$postId = $post->ID;

		if ( empty( $fields ) ) {
			return null;
		}

		if ( $post->isPreview ) {
			// Preview post: get parent post language, if any
			$postId = wp_get_post_parent_id( $post->ID );
		}

		$languageData = $this->helpers->getElementLanguageData( $postId, $post->post_type );

		if ( ! $languageData ) {
			return null;
		}

		return $this->helpers->filterFields( $languageData, $fields );
	}

	/**
	 * Resolve language code field
	 *
	 * @param Model $post
	 *
	 * @return null|string
	 */
	public function resolveLanguageCodeField( Model $post ) {
		if ( ! $post instanceof Post ) {
			return null;
		}

		$postId = $post->ID;

		if ( $post->isPreview ) {
			// Preview post: get parent post language, if any.
			$postId = wp_get_post_parent_id( $post->ID );
		}

		return $this->helpers->getElementLanguageCode( $postId, $post->post_type );
	}
	
}
