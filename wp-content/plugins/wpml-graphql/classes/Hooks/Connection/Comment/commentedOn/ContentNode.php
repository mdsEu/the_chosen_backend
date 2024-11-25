<?php

namespace WPML\GraphQL\Hooks\Connection\Comment\commentedOn;

use WPGraphQL\Data\Connection\PostObjectConnectionResolver;
use WPGraphQL\Model\Comment;
use WPML\GraphQL\Hooks\Connection\Base;
use WPML\GraphQL\Hooks\Query\LanguageFilter;

class ContentNode extends Base {

	/**
	 * @param Comment                              $comment
	 * @param array<string,mixed>                  $args
	 * @param \WPGraphQL\AppContext                $context
	 * @param \GraphQL\Type\Definition\ResolveInfo $info
	 *
	 * @return \GraphQL\Deferred
	 */
	public function resolveReplacement( $comment, $args, $context, $info ) {
		$originalResolve = $this->originalResolve;

		if ( ! $comment instanceof Comment ) {
			return $originalResolve( $comment, $args, $context, $info );
		}

		if (
			empty( $comment->comment_post_ID ) ||
			! absint( $comment->comment_post_ID )
		) {
			return $originalResolve( $comment, $args, $context, $info );
		}

		$id       = absint( $comment->comment_post_ID );
		$resolver = new PostObjectConnectionResolver( $comment, $args, $context, $info, 'any' );

		return $resolver->one_to_one()
			->set_query_arg( LanguageFilter::WP_QUERY_SKIP_WPML_FILTERS_ARGUMENT, true )
			->set_query_arg( 'p', $id )
			->set_query_arg( 'post_parent', null )
			->get_connection();
	}

}
