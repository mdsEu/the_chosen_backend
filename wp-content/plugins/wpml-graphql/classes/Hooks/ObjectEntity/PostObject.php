<?php

namespace WPML\GraphQL\Hooks\ObjectEntity;

use WPML\GraphQL\Helpers;
use WPML\GraphQL\Hooks\Query\LanguageFilter;
use WPML\GraphQL\Resolvers\PostFields;
use WPML\LIB\WP\Hooks;
use function WPML\FP\spreadArgs;

class PostObject extends BaseObject {

	// phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found
	public function __construct(
		PostFields $fieldsResolver,
		Helpers $helpers
	) {
		parent::__construct( $fieldsResolver, $helpers );
	}

	/**
	 * @see BaseObject::registerObjectFieldsAndFilters
	 */
	public function registerObjectFieldsAndFilters() {
		foreach ( $this->helpers->getGraphqlAllowedPostTypes() as $postTypeObject ) {
			if ( apply_filters( 'wpml_is_translated_post_type', false, $postTypeObject->name ) ) {
				$graphQlSingleName = $postTypeObject->graphql_single_name;

				$this->registerLanguageFilter( $graphQlSingleName );
				$this->manageFields( $graphQlSingleName );
			}
		}

		Hooks::onFilter( 'graphql_pre_resolve_uri', 10, 5 )
			->then( spreadArgs( [ $this, 'adjustQueryByPostSlug' ] ) );

		Hooks::onFilter( 'graphql_resolve_uri', 10, 7 )
			->then( spreadArgs( [ $this, 'restoreQueryByPostSlug' ] ) );

	}

	/**
	 * @param array<string,mixed>|string $extraQueryVars Any extra query vars to consider.
	 *
	 * @return bool
	 */
	private function isSlugQuery( $extraQueryVars ) {
		if ( ! is_array( $extraQueryVars ) ) {
			return false;
		}
		return (
			$this->helpers->getArr( 'name', $extraQueryVars )
			&& $this->helpers->getArr( 'post_type', $extraQueryVars )
			&& 'ContentNode' === $this->helpers->getArr( 'nodeType', $extraQueryVars )
		);
	}

	/**
	 * @param array $args
	 *
	 * @return array
	 */
	public function skipFiltersInSlugQuery( $args ) {
		$args[ LanguageFilter::WP_QUERY_SKIP_WPML_FILTERS_ARGUMENT ] = true;
		return $args;
	}

	/**
	 * @param mixed|null                 $node           The node, defaults to nothing.
	 * @param string                     $uri            The uri being searched.
	 * @param \WPGraphQL\AppContext      $context        The app context.
	 * @param \WP                        $wp             WP object.
	 * @param array<string,mixed>|string $extraQueryVars Any extra query vars to consider.
	 *
	 * @return mixed|null
	 */
	public function adjustQueryByPostSlug( $node, $uri, $context, $wp, $extraQueryVars ) {
		if ( $this->isSlugQuery( $extraQueryVars ) ) {
			add_filter( 'request', [ $this, 'skipFiltersInSlugQuery' ] );
		}
		return $node;
	}

	/**
	 * @param mixed|null                                    $node           The node, defaults to nothing.
	 * @param ?string                                       $uri            The uri being searched.
	 * @param \WP_Term|\WP_Post_Type|\WP_Post|\WP_User|null $queriedObject  The queried object, if WP_Query returns one.
	 * @param \WP_Query                                     $query          The query object.
	 * @param \WPGraphQL\AppContext                         $context        The app context.
	 * @param \WP                                           $wp             WP object.
	 * @param array<string,mixed>|string                    $extraQueryVars Any extra query vars to consider.
	 *
	 * @return mixed|null
	 */
	public function restoreQueryByPostSlug( $node, $uri, $queriedObject, $query, $context, $wp, $extraQueryVars ) {
		if ( $this->isSlugQuery( $extraQueryVars ) ) {
			remove_filter( 'request', [ $this, 'skipFiltersInSlugQuery' ] );
		}
		return $node;
	}

}
