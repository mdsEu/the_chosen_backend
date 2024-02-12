<?php

namespace WPML\GraphQL\Resolvers;

use WPML\LIB\WP\Hooks;
use function WPML\FP\spreadArgs;
use WPGraphQL\AppContext;
use WPGraphQL\Model\Model;
use GraphQL\Type\Definition\ResolveInfo;
use WPML\GraphQL\Resolvers\Interfaces\TranslationFields;
use WPML\GraphQL\Resolvers\Interfaces\ModelFields;

class PostFields extends BaseFields implements TranslationFields, ModelFields {

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
		if ( ! $post instanceof \WPGraphQL\Model\Post ) {
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
		if ( ! $post instanceof \WPGraphQL\Model\Post ) {
			return null;
		}

		$postId = $post->ID;

		if ( $post->isPreview ) {
			// Preview post: get parent post language, if any
			$postId = wp_get_post_parent_id( $post->ID );
		}

		return $this->helpers->getElementLanguageCode( $postId, $post->post_type );
	}

	/**
	 * Resolve translation group id field
	 *
	 * @param Model $post
	 *
	 * @return null|int
	 */
	public function resolveTranslationGroupIdField( Model $post ) {
		if ( ! $post instanceof \WPGraphQL\Model\Post ) {
			return null;
		}

		$wpmlType = apply_filters( 'wpml_element_type', $post->post_type );
		$postId   = $post->ID;

		if ( $post->isPreview ) {
			$postId = wp_get_post_parent_id($post->ID);
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
		if ( ! $post instanceof \WPGraphQL\Model\Post ) {
			return null;
		}

		$wpmlType = apply_filters( 'wpml_element_type', $post->post_type );
		$posts    = [];
		$postId   = $post->ID;

		if ( $post->isPreview ) {
			$postId = wp_get_post_parent_id($post->ID);
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
	 * Adjust the PostObject model fields related to URLs: 'uri' and 'link'
	 *
	 * @param mixed[]           $fields
	 * @param string            $modelName
	 * @param \WP_Post|\WP_Term $data
	 *
	 * @return mixed[]
	 */
	public function adjustModelFields( $fields, $modelName, $data ) {
		if ( 'PostObject' !== $modelName ) {
			return $fields;
		}

		if ( ! $data instanceof \WP_Post ) {
			return $fields;
		}

		$currentLanguage = $this->helpers->getCurrentLanguage();
		$languageCode = apply_filters( 'wpml_element_language_code', null, [
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
			$currentLanguage = $this->helpers->getCurrentLanguage();
			$languageCode = apply_filters( 'wpml_element_language_code', null, [
				'element_id'   => $data->ID,
				'element_type' => $data->post_type,
			]);

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
