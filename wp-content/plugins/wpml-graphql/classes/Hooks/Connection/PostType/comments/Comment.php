<?php

namespace WPML\GraphQL\Hooks\Connection\PostType\comments;

use WPGraphQL\Data\Connection\CommentConnectionResolver;
use WPGraphQL\Model\Post;
use WPML\FP\Fns;
use WPML\GraphQL\Hooks\Connection\Base;
use WPML\GraphQL\Hooks\Query\LanguageFilter;

class Comment extends Base {

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

		if ( $post->isRevision ) {
			$id = $post->parentDatabaseId;
		} else {
			$id = $post->ID;
		}

		/**
		 * @param bool $isFiltered
		 *
		 * @return bool
		 */
		$skipFiltersInCommentQuery = \WPML\FP\Fns::always( false );

		add_filter( LanguageFilter::WP_COMMENT_QUERY_SKIP_WPML_FILTER, $skipFiltersInCommentQuery );
		$resolver = new CommentConnectionResolver( $post, $args, $context, $info );
		$resolver->set_query_arg( 'post_id', absint( $id ) );

		$resolve = $resolver->get_connection();
		remove_filter( LanguageFilter::WP_COMMENT_QUERY_SKIP_WPML_FILTER, $skipFiltersInCommentQuery );

		return $resolve;
	}

}
