<?php

namespace Wpe_Content_Engine\Helper\Search\Config;

use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\ACM as AtlasContentModeler;
use function WPE\AtlasContentModeler\ContentRegistration\get_registered_content_types;

class ACM extends Configurable {

	public function get_config( array $existing_config ): array {
		$acm_search_config = array();

		if ( ! AtlasContentModeler::is_acm_loaded() ) {
			return array();
		}
		$acm_models = get_registered_content_types();

		foreach ( $acm_models as $model_name => $model ) {
			foreach ( array_column( $model['fields'], 'slug' ) as $field ) {
				$acm_search_config[ $model_name ][ $field ] = $this->provide_config( $model_name, $field, $existing_config );
			}
		}
		return $acm_search_config;
	}
}
