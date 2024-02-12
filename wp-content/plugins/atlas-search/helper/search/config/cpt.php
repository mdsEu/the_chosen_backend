<?php

namespace Wpe_Content_Engine\Helper\Search\Config;

use Wpe_Content_Engine\Helper\Acf_Support\Acf;

class CPT extends Configurable {

	public function get_config( array $existing_config ): array {
		$cpt_search_config = array();

		$cpt_models = get_post_types(
			array(
				'public'   => true,
				'_builtin' => false,
			)
		);

		$default_fields = array( 'title', 'content' );

		foreach ( $cpt_models as $cpt_model_name ) {

			foreach ( $default_fields as $field ) {
				$cpt_search_config[ $cpt_model_name ][ $field ] = $this->provide_config( $cpt_model_name, $field, $existing_config );
			}

			if ( ! Acf::is_acf_loaded() ) {
				continue;
			}

			$cpt_search_config = $this->get_acf_search_config( $cpt_model_name, $existing_config, $cpt_search_config );
		}

		return $cpt_search_config;
	}
}
