<?php

namespace WPML\GraphQL;

use WPML\LIB\WP\Hooks;

class Loader implements \IWPML_Frontend_Action {
	
	/**
	 * Use graphql_init fired on GraphQL requests
	 *
	 * @return void
	 */
	public function add_hooks() {
		Hooks::onAction( 'graphql_init' )
			->then( [ $this, 'graphqlInit' ] );
	}

	/**
	 * Init the GraphQL integration
	 *
	 * @return void
	 */
	public function graphqlInit() {
		\WPML\Container\share( [ '\WPML\GraphQL\Helpers' ] );
		$actionsFiltersLoader = new \WPML_Action_Filter_Loader();
		$actionsFiltersLoader->load([
			\WPML\GraphQL\Hooks\Connection\Factory::class,
			\WPML\GraphQL\Hooks\Modifiers::class,
			\WPML\GraphQL\Hooks\ObjectEntity\CommentObject::class,
			\WPML\GraphQL\Hooks\ObjectEntity\ContentNodeObject::class,
			\WPML\GraphQL\Hooks\ObjectEntity\ContentTypeObject::class,
			\WPML\GraphQL\Hooks\ObjectEntity\MenuObject::class,
			\WPML\GraphQL\Hooks\ObjectEntity\MenuItemObject::class,
			\WPML\GraphQL\Hooks\ObjectEntity\PostObject::class,
			\WPML\GraphQL\Hooks\ObjectEntity\TermNodeObject::class,
			\WPML\GraphQL\Hooks\ObjectEntity\TermObject::class,
			\WPML\GraphQL\Hooks\ObjectEntity\UserObject::class,
			\WPML\GraphQL\Hooks\ObjectType\LanguageType::class,
			\WPML\GraphQL\Hooks\Query\LanguageFilter::class,
			\WPML\GraphQL\Hooks\Query\Languages::class,
		]);
	}

}
