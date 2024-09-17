<?php

namespace WPML\GraphQL\Resolvers;

use WPGraphQL\AppContext;
use WPGraphQL\Model\Model;
use WPGraphQL\Model\Post;
use GraphQL\Type\Definition\ResolveInfo;
use WPML\GraphQL\Resolvers\Interfaces\TranslationFields;
use WPML\GraphQL\Resolvers\Interfaces\ModelFields;

class PostFields extends ContentNodeFields implements TranslationFields, ModelFields {

	const MODEL_OBJECT = 'PostObject';

	/**
	 * Resolve translation group id field
	 *
	 * @param Model $post
	 *
	 * @return null|int
	 */
	public function resolveTranslationGroupIdField( Model $post ) {
		if ( ! $post instanceof Post ) {
			return null;
		}

		$wpmlType = apply_filters( 'wpml_element_type', $post->post_type );
		$postId   = $post->ID;

		if ( $post->isPreview ) {
			$postId = wp_get_post_parent_id( $post->ID );
		}

		return apply_filters( 'wpml_element_trid', null, $postId, $wpmlType );
	}

	/**
	 * Resolve translations field
	 *
	 * @param Model $post
	 *
	 * @return null|mixed[]
	 */
	public function resolveTranslationsField( Model $post ) {
		if ( ! $post instanceof Post ) {
			return null;
		}

		$wpmlType = apply_filters( 'wpml_element_type', $post->post_type );
		$posts    = [];
		$postId   = $post->ID;

		if ( $post->isPreview ) {
			$postId = wp_get_post_parent_id( $post->ID );
		}

		$trid         = apply_filters( 'wpml_element_trid', null, $postId, $wpmlType );
		$translations = apply_filters( 'wpml_get_element_translations', [], $trid, $wpmlType );

		foreach ( $translations as $translationLanguage => $translationData ) {
			if ( ! $this->helpers->isPublicLanguage( $translationLanguage ) ) {
				continue;
			}
			$translation = $this->helpers->wpPost( $translationData->element_id );

			if ( ! $translation ) {
				continue;
			}

			if ( $post->ID === $translation->ID ) {
				continue;
			}

			// If fetching preview do not add the original as a translation
			if ( $post->isPreview && $post->parentDatabaseId === $translation->ID) {
				continue;
			}

			$model = $this->helpers->wpGraphqlPost( $translation );

			// The wp-graphql plugin crashed while requesting the ID from private posts
			if ( $model->is_private() ) {
				continue;
			}

			$posts[] = $model;
		}

		return $posts;
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
			'element_id'   => $data->ID,
			'element_type' => $data->post_type,
		]);

		$fields['link'] = function() use ( $data, $currentLanguage, $languageCode ) {
			$this->helpers->setCurrentLanguage( $languageCode );

			$link = get_permalink( $data );

			if ( ! post_type_supports( $data->post_type, 'revisions' ) && 'draft' === $data->post_status ) {
				$parent = get_post_parent( $data );
				if ( $parent ) {
					$link = get_preview_post_link( $parent );
				} else {
					$link = null;
				}
			}

			$this->helpers->setCurrentLanguage( $currentLanguage );

			return $link ?: null;
		};

		$fields['uri'] = function() use ( $data, $currentLanguage, $languageCode ) {
			$this->helpers->setCurrentLanguage( $languageCode );

			$link = get_permalink( $data );

			if ( $this->helpers->isFrontPage( $data->ID, $data->post_type ) ) {
				$link = '/';
			}

			$uri = ! empty( $link ) ? str_ireplace( home_url(), '', $link ) : null;

			$this->helpers->setCurrentLanguage( $currentLanguage );

			return $uri;
		};

		return $fields;
	}
}
