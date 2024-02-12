<?php

namespace WPML\GraphQL;

class Helpers {

	/**@var array<string, array<string, string>> */
	private $active_languages = null;

	/** @var string|null */
	private $default_language = null;

	/**
	 * Get active WPML languages
	 *
	 * Note that we get languages data in the current language:
	 * when filtering by a specific language, the trabnslated_name field
	 * will return the language name in the language being filtered by.
	 *
	 * @return array<string, array<string, string>>
	 */
	public function getAvailableLanguages() {
		// This happens too late to resove the language field on queries on non default languages!
		if ( null === $this->active_languages ) {
			$this->active_languages = apply_filters( 'wpml_active_languages', [] );
		}
		return $this->active_languages;
	}

	/**
	 * Get default language
	 *
	 * @return null|string
	 */
	public function getDefaultLanguage() {
		if ( null === $this->default_language ) {
			$this->default_language = apply_filters( 'wpml_default_language', null );
		}
		return $this->default_language;
	}

	/**
	 * Get current language
	 *
	 * @return null|string
	 */
	public function getCurrentLanguage() {
		return apply_filters( 'wpml_current_language', null );
	}

	/**
	 * Get data for a given language
	 *
	 * @param string $lang
	 *
	 * @return null|array<string, string>
	 */
	public function getLanguageData( $lang ) {
		$languages = self::getAvailableLanguages();
		return $this->getArr( $lang, $languages );
	}

	/**
	 * Check whether a language is a public language
	 *
	 * @param string $lang
	 *
	 * @return bool
	 */
	public function isPublicLanguage( $lang ) {
		$languages = self::getAvailableLanguages();
		return array_key_exists( $lang, $languages );
	}

	/**
	 * Check whether a language is an active language
	 *
	 * @param string $lang
	 *
	 * @return bool
	 */
	public function isActiveLanguage( $lang ) {
		return apply_filters( 'wpml_language_is_active', false, $lang );
	}

	/**
	 * Set a given language as the current one
	 *
	 * @param string $lang
	 *
	 * @return void
	 */
	public function setCurrentLanguage( $lang ) {
		do_action( 'wpml_switch_language', $lang );
	}

	/**
	 * Get the language code for a given item
	 *
	 * @param int    $elementId
	 * @param string $elementType
	 *
	 * @return null|string
	 */
	public function getElementLanguageCode( $elementId, $elementType ) {
		$languageCode = apply_filters( 'wpml_element_language_code', null, [
			'element_id'   => $elementId,
			'element_type' => $elementType,
		]);

		if ( ! $languageCode ) {
			return null;
		}

		if ( ! $this->isPublicLanguage( $languageCode ) ) {
			return null;
		}

		return $languageCode;
	}

	/**
	 * Get the language code for a given item
	 *
	 * @param int    $elementId
	 * @param string $elementType
	 *
	 * @return null|array<string, string>
	 */
	public function getElementLanguageData( $elementId, $elementType ) {
		$languageCode = apply_filters( 'wpml_element_language_code', null, [
			'element_id'   => $elementId,
			'element_type' => $elementType,
		]);

		if ( ! $languageCode ) {
			return null;
		}

		$languageData = $this->getLanguageData( $languageCode );

		return $languageData ?: null;
	}

	/**
	 * Filter an array by keys that belong to another array list
	 *
	 * @param array<string, T> $data
	 * @param array<string>    $fieldsList
	 *
	 * @return array<string, T>
	 *
	 * @template T
	 */
	public function filterFields( $data, $fieldsList ) {
		return array_filter(
			$data,
			function( $dataItemKey ) use ( $fieldsList ) {
				return in_array( $dataItemKey, $fieldsList, true );
			},
			ARRAY_FILTER_USE_KEY
		);
	}

	/**
	 * Get the value on an array given its key
	 *
	 * @param string   $key
	 * @param array<T> $source
	 * 
	 * @return null|T
	 *
	 * @template T
	 *
	 * @codeCoverageIgnore
	 */
	public function getArr( $key, $source ) {
		return \WPML\FP\Obj::prop( $key, $source );
	}

	/**
	 * Check whether a given post ID and type match the front page defined in the site settings
	 *
	 * @param int    $id
	 * @param string $postType
	 *
	 * @return bool
	 */
	public function isFrontPage( $id, $postType ) {
		if ( 'page' !== $postType || 'page' !== get_option( 'show_on_front' ) ) {
			return false;
		}

		if ( absint( get_option( 'page_on_front', 0 ) ) === $id ) {
			return true;
		}

		return false;
	}

	/**
	 * Check whether a given post is a preview
	 *
	 * @param \WP_Post $post
	 *
	 * @return bool
	 */
	public function isPostPreview( $post ) {
		if ( 'revision' === $post->post_type ) {
			$revisions = wp_get_post_revisions(
				$post->post_parent,
				[
					'posts_per_page' => 1,
					'fields'         => 'ids',
					'check_enabled'  => false,
				]
			);

			if ( in_array( $post->ID, array_values( $revisions ), true ) ) {
				return true;
			}
		}

		if ( ! post_type_supports( $post->post_type, 'revisions' ) && 'draft' === $post->post_status ) {
			return true;
		}

		return false;
	}

	/**
	 * Provide a \WP_Post object given a post ID
	 *
	 * @param int $id
	 *
	 * @return \WP_Post|false
	 *
	 * @codeCoverageIgnore
	 */
	public function wpPost( $id ) {
		return \WP_Post::get_instance( $id );
	}

	/**
	 * Provide a \WPGraphQL\Model\Post object given a \WP_Post object
	 *
	 * @param \WP_Post $post
	 *
	 * @return \WPGraphQL\Model\Post
	 *
	 * @codeCoverageIgnore
	 */
	public function wpGraphqlPost( $post ) {
		return new \WPGraphQL\Model\Post( $post );
	}

	/**
	 * Provide a \WP_Term object given a term ID and taxonomy name
	 *
	 * @param int    $termId
	 * @param string $taxonomyName
	 *
	 * @return \WP_Term|\WP_Error|false
	 *
	 * @codeCoverageIgnore
	 */
	public function wpTerm( $termId, $taxonomyName ) {
		return \WP_Term::get_instance( $termId, $taxonomyName );
	}

	/**
	 * Provide a \WPGraphQL\Model\Term object given a \WP_Term object
	 *
	 * @param \WP_Term $term
	 *
	 * @return \WPGraphQL\Model\Term
	 *
	 * @codeCoverageIgnore
	 */
	public function wpGraphqlTerm( $term ) {
		return new \WPGraphQL\Model\Term( $term );
	}

	/**
	 * Get a list of post types supported by the QP GraphQL API
	 *
	 * @param string $returnType
	 *
	 * @return \WPGraphQL\Model\PostType[]
	 *
	 * @codeCoverageIgnore
	 */
	public function getGraphqlAllowedPostTypes( $returnType ) {
		return \WPGraphQL::get_allowed_post_types( $returnType );
	}

	/**
	 * Get a list of taxonomies supported by the QP GraphQL API
	 *
	 * @param string $returnType
	 *
	 * @return \WPGraphQL\Model\Taxonomy[]
	 *
	 * @codeCoverageIgnore
	 */
	public function getGraphqlAllowedTaxonomies( $returnType ) {
		return \WPGraphQL::get_allowed_taxonomies( $returnType );
	}

}
