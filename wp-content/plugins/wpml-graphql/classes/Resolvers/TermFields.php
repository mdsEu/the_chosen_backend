<?php

namespace WPML\GraphQL\Resolvers;

use WPGraphQL\AppContext;
use WPGraphQL\Model\Model;
use WPGraphQL\Model\Term;
use GraphQL\Type\Definition\ResolveInfo;
use WPML\GraphQL\Resolvers\Interfaces\TranslationFields;
use WPML\GraphQL\Resolvers\Interfaces\ModelFields;

class TermFields extends BaseFields implements TranslationFields, ModelFields {

	const MODEL_OBJECT = 'TermObject';

	/**
	 * Resolve language field
	 *
	 * @param Model       $term
	 * @param mixed[]     $args
	 * @param AppContext  $context
	 * @param ResolveInfo $info
	 *
	 * @return null|mixed[]
	 */
	public function resolveLanguageField(
		Model $term,
		$args,
		AppContext $context,
		ResolveInfo $info
	) {
		if ( ! $term instanceof Term ) {
			return null;
		}
		$fields = array_keys( $info->getFieldSelection() );

		if ( empty( $fields ) ) {
			return null;
		}

		$languageData = $this->helpers->getElementLanguageData( $term->term_id, $term->taxonomyName );

		if ( ! $languageData ) {
			return null;
		}

		return $this->helpers->filterFields( $languageData, $fields );
	}

	/**
	 * Resolve language code field
	 *
	 * @param Model $term
	 *
	 * @return null|string
	 */
	public function resolveLanguageCodeField( Model $term ) {
		if ( ! $term instanceof Term ) {
			return null;
		}

		return $this->helpers->getElementLanguageCode( $term->term_id, $term->taxonomyName );
	}

	/**
	 * Resolve translation group id field
	 *
	 * @param Model $term
	 *
	 * @return null|int
	 */
	public function resolveTranslationGroupIdField( Model $term ) {
		if ( ! $term instanceof Term ) {
			return null;
		}

		$wpmlType = apply_filters( 'wpml_element_type', $term->taxonomyName );
		
		return apply_filters( 'wpml_element_trid', null, $term->term_id, $wpmlType );
	}

	/**
	 * Resolve translations field
	 *
	 * @param Model $term
	 *
	 * @return null|mixed[]
	 */
	public function resolveTranslationsField( Model $term ) {
		if ( ! $term instanceof Term ) {
			return null;
		}

		$wpmlType = apply_filters( 'wpml_element_type', $term->taxonomyName );
		$terms    = [];

		$trid         = apply_filters( 'wpml_element_trid', null, $term->term_id, $wpmlType );
		$translations = apply_filters( 'wpml_get_element_translations', [], $trid, $wpmlType );

		foreach ( $translations as $translationLanguage => $translationData ) {
			if ( ! $this->helpers->isPublicLanguage( $translationLanguage ) ) {
				continue;
			}
			if ( absint( $term->term_id ) === absint( $translationData->term_id ) ) {
				continue;
			}

			$translation = $this->helpers->wpTerm( $translationData->term_id, $term->taxonomyName );

			if ( ! $translation || is_wp_error( $translation ) ) {
				continue;
			}

			$terms[] = $this->helpers->wpGraphqlTerm( $translation );
		}

		return $terms;
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

		$fields['link'] = function() use ( $data ) {
			$link = get_term_link( $data );
			return ( ! is_wp_error( $link ) ) ? $link : null;
		};

		$fields['uri'] = function() use ( $data ) {
			$link = get_term_link( $data );
			if ( is_wp_error( $link ) ) {
				return null;
			}
			$stripped_link = str_ireplace( home_url(), '', $link );
			return trailingslashit( $stripped_link );
		};

		return $fields;
	}
}
