<?php

namespace WPML\GraphQL\Hooks\Connection\PostType\terms;

use WPGraphQL\Data\Connection\TermObjectConnectionResolver;
use WPGraphQL\Model\Post;
use WPML\GraphQL\Hooks\Connection\Base;
use WPML\GraphQL\Hooks\Query\LanguageFilter;

class Taxonomy extends Base {

	/**
	 * @param Post                                 $post
	 * @param array<string,mixed>                  $args
	 * @param \WPGraphQL\AppContext                $context
	 * @param \GraphQL\Type\Definition\ResolveInfo $info
	 *
	 * @return \GraphQL\Deferred
	 */
	public function resolveReplacement( $post, $args, $context, $info ) {
		$originalResolve = $this->originalResolve;

		if ( ! $post instanceof Post ) {
			return $originalResolve( $post, $args, $context, $info );
		}

		$object_id = true === $post->isPreview && ! empty( $post->parentDatabaseId ) ? $post->parentDatabaseId : $post->ID;

		if ( empty( $object_id ) || ! absint( $object_id ) ) {
			return $originalResolve( $post, $args, $context, $info );
		}

		$resolver = new TermObjectConnectionResolver( $post, $args, $context, $info, $this->connectedTypeName );
		$resolver->set_query_arg( 'object_ids', absint( $object_id ) );
		$resolver->set_query_arg( LanguageFilter::WP_TERM_QUERY_SKIP_WPML_FILTERS_ARGUMENT, true );

		return $resolver->get_connection();
	}

}
