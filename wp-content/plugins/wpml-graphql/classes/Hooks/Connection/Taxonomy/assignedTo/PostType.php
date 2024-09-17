<?php

namespace WPML\GraphQL\Hooks\Connection\Taxonomy\assignedTo;

use WPGraphQL\Data\Connection\PostObjectConnectionResolver;
use WPGraphQL\Model\Term;
use WPML\GraphQL\Hooks\Connection\Base;
use WPML\GraphQL\Hooks\Query\LanguageFilter;

class PostType extends Base {

	/**
	 * @param Term $term
	 *
	 * @return string|null
	 */
	private function getParentLanguage( $term ) {
		if ( ! $term instanceof Term ) {
			return null;
		}

		return apply_filters(
			'wpml_element_language_code',
			null,
			[ 'element_id' => $term->term_id, 'element_type' => $term->taxonomyName ]
		);
	}

	/**
	 * @param Term                                 $term
	 * @param array<string,mixed>                  $args
	 * @param \WPGraphQL\AppContext                $context
	 * @param \GraphQL\Type\Definition\ResolveInfo $info
	 *
	 * @return \GraphQL\Deferred
	 */
	public function resolveReplacement( $term, $args, $context, $info ) {
		$originalResolve = $this->originalResolve;

		if ( ! $term instanceof Term ) {
			return $originalResolve( $term, $args, $context, $info );
		}

		$language = $this->getParentLanguage( $term );
		if ( ! $language ) {
			return $originalResolve( $term, $args, $context, $info );
		}

		$currentLanguage = $this->helpers->getCurrentLanguage();

		$this->helpers->setCurrentLanguage( $language );

		$resolver     = new PostObjectConnectionResolver( $term, $args, $context, $info, $this->connectedTypeName );
		$current_args = $resolver->get_query_args();
		$tax_query    = $current_args['tax_query'] ?? [];
		$tax_query[]  = [
			'taxonomy'         => $term->taxonomyName,
			'terms'            => [ $term->term_id ],
			'field'            => 'term_id',
			'include_children' => false,
		];
		$resolver->set_query_arg( 'tax_query', $tax_query );
		$resolver->set_query_arg( LanguageFilter::WP_QUERY_SKIP_WPML_FILTERS_ARGUMENT, true );

		$resolve = $resolver->get_connection();
		$this->helpers->setCurrentLanguage( $currentLanguage );

		return $resolve;
	}

}
