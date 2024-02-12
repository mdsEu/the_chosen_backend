<?php

namespace Wpe_Content_Engine\Helper\Search;

use Wpe_Content_Engine\Helper\Search\Config\ACM;
use Wpe_Content_Engine\Helper\Search\Config\BuiltIns;
use Wpe_Content_Engine\Helper\Search\Config\CPT;
use function WPE\AtlasContentModeler\ContentRegistration\get_registered_content_types;

class Search_Config {

	private const WPE_CONTENT_ENGINE_SEARCH_FIELDS = 'wpe_content_engine_search_fields';
	private CPT $cpt;
	private ACM $acm;
	private BuiltIns $built_ins;

	public function __construct() {
		$this->cpt       = new CPT();
		$this->acm       = new ACM();
		$this->built_ins = new BuiltIns();
	}

	/**
	 * @return array
	 */
	public function get_fields(): array {
		return get_option( self::WPE_CONTENT_ENGINE_SEARCH_FIELDS, array() );
	}

	/**
	 * @param array $search_fields The search fields.
	 *
	 * @return bool
	 */
	public function set_fields( array $search_fields ): bool {
		return update_option( self::WPE_CONTENT_ENGINE_SEARCH_FIELDS, $search_fields );
	}

	/**
	 * @param bool $use_cache Use the cache or not.
	 * @return array
	 */
	public function get_config( bool $use_cache = false ): array {
		if ( $use_cache ) {
			$search_config = get_transient( self::WPE_CONTENT_ENGINE_SEARCH_FIELDS );
			if ( false !== $search_config ) {
				return $search_config;
			}
		}

		$existing_config = $this->get_fields();
		$search_config   = $this->generate_search_config( $existing_config );
		$this->set_fields( $search_config );

		set_transient( self::WPE_CONTENT_ENGINE_SEARCH_FIELDS, $search_config );

		return $search_config;
	}

	public function clear_config() {
		delete_transient( self::WPE_CONTENT_ENGINE_SEARCH_FIELDS );
		delete_option( self::WPE_CONTENT_ENGINE_SEARCH_FIELDS );
	}

	/**
	 * @param array $config_updates The search configuration.
	 * @return array
	 */
	public function set_config( array $config_updates ): array {
		$search_config = $this->get_config();

		foreach ( $config_updates as $cat_key => $cat_value ) {
			foreach ( $cat_value as $key => $value ) {
				$search_config[ $cat_key ][ $key ] = is_array( $value ) ? array_merge( $search_config[ $cat_key ][ $key ], $value ) : $value;
			}
		}

		$this->set_fields( $search_config );

		set_transient( self::WPE_CONTENT_ENGINE_SEARCH_FIELDS, $search_config );

		return $search_config;
	}

	/**
	 * @param array $existing_config The existing search config in the DB.
	 * @return array
	 */
	public function generate_search_config( array $existing_config ): array {
		return array(
			'models' => array_merge(
				$this->built_ins->get_config( $existing_config['models'] ?? array() ),
				$this->cpt->get_config( $existing_config['models'] ?? array() ),
				$this->acm->get_config( $existing_config['models'] ?? array() ),
			),
			'fuzzy'  => array(
				'enabled'  => $existing_config['fuzzy']['enabled'] ?? false,
				'distance' => $existing_config['fuzzy']['distance'] ?? 1,
			),
		);
	}
}
