<?php

namespace WPML\GraphQL\Hooks\ObjectEntity;

use WPML\LIB\WP\Hooks;
use function WPML\FP\spreadArgs;
use WPML\GraphQL\Helpers;
use WPML\GraphQL\Hooks\ObjectType\LanguageType;
use WPML\GraphQL\Resolvers\CommentFields;

class CommentObject extends BaseObject {

	// phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
	public function __construct(
		CommentFields $fieldsResolver,
		Helpers $helpers
	) {
		parent::__construct( $fieldsResolver, $helpers );
	}

	/**
	 * @see BaseObject::registerObjectFieldsAndFilters
	 */
	public function registerObjectFieldsAndFilters() {
		parent::registerObjectFieldsAndFilters();

		// @codeCoverageIgnoreStart
		Hooks::onFilter( 'graphql_wp_connection_type_config' )
			->then( spreadArgs( [ $this, 'adjustCommentedOnConnectionResolver' ] ) );
		// @codeCoverageIgnoreEnd
	}

	/**
	 * @see BaseObject::manageFieldsAndDefineFilters
	 */
	protected function manageFieldsAndDefineFilters() {
		$this->registerLanguageFilter( 'comment' );
		$this->manageFields( 'comment' );
	}

	/**
	 * @see BaseObject::applyLanguageFilter
	 */
	protected function applyLanguageFilter() {
		Hooks::onFilter( 'graphql_map_input_fields_to_wp_comment_query', 10, 2 )
			->then( spreadArgs( function( $queryArgs, $whereArgs ) {
				$selectedLanguage = $this->helpers->getArr( LanguageType::FILTER_NAME, $whereArgs );

				if ( is_null( $selectedLanguage ) ) {
					return $queryArgs;
				}

				if ( 'all' === $selectedLanguage ) {
					Hooks::onFilter( 'wpml_is_comment_query_filtered' )
						->then( '__return_false' );
				}

				return $this->setLanguageFromQueryArgs( $queryArgs, $whereArgs );
			} ) );
	}

	/**
	 * Adjust the 'commentedOn' connection resolver to get the right post
	 *
	 * @param mixed[] $config
	 *
	 * @return mixed[]
	 *
	 * @todo Move connection resolvers to proper classes
	 * @codeCoverageIgnore
	 */
	public function adjustCommentedOnConnectionResolver( $config ) {
		if ( 'Comment' !== $config['fromType'] ) {
			return $config;
		}
		if ( 'ContentNode' !== $config['toType'] ) {
			return $config;
		}
		if ( 'commentedOn' !== $config['fromFieldName'] ) {
			return $config;
		}

		$config['resolve'] = function( $comment, $args, $context, $info ) {
			if (
				empty( $comment->comment_post_ID ) ||
				! absint( $comment->comment_post_ID )
			) {
				return null;
			}
			$id       = absint( $comment->comment_post_ID );
			$resolver = new \WPGraphQL\Data\Connection\PostObjectConnectionResolver( $comment, $args, $context, $info, 'any' );

			return $resolver->one_to_one()->set_query_arg( 'suppress_wpml_where_and_join_filter', true )->set_query_arg( 'p', $id )->set_query_arg( 'post_parent', null )->get_connection();
		};

		return $config;
	}

}
