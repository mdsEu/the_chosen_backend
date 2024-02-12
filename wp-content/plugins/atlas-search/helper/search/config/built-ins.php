<?php

namespace Wpe_Content_Engine\Helper\Search\Config;

use Wpe_Content_Engine\Helper\Acf_Support\Acf;

class BuiltIns extends Configurable {

	public function get_config( array $existing_config ): array {
		$built_in_types = array(
			'post' => array(
				'title',
				'content',
				'excerpt',
				'author.displayName',
				'tags.name',
				'categories.name',
			),
			'page' => array(
				'title',
				'content',
				'excerpt',
			),
		);

		$search_config = array();

		foreach ( $built_in_types as $name => $fields ) {

			foreach ( $fields as $field ) {
				$search_config[ $name ][ $field ] = $this->provide_config( $name, $field, $existing_config );
			}

			if ( ! Acf::is_acf_loaded() ) {
				continue;
			}

			$search_config = $this->get_acf_search_config( $name, $existing_config, $search_config );
		}

		return $search_config;
	}
}
