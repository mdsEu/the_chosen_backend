<?php

namespace WPML\GraphQL\Resolvers\Interfaces;

interface ModelFields {

	/**
	 * Adjust model fields
	 *
	 * @param mixed[]           $fields
	 * @param string            $modelName
	 * @param \WP_Post|\WP_Term $data
	 *
	 * @return mixed[]
	 */
	public function adjustModelFields( $fields, $modelName, $data );

}
