<?php

namespace Wpe_Content_Engine\Helper\Acf_Support;

use Wpe_Content_Engine\Helper\Acf_Support\Acf_Factory;
use Wpe_Content_Engine\Helper\Constants\Json_Schema_Type;
use Wpe_Content_Engine\Helper\String_Transformation;

class Acf {

	/**
	 * @var array
	 */
	public const ACF_UNSUPPORTED_TYPES = array(
		Acf_Factory::IMAGE,
		Acf_Factory::FILE,
		Acf_Factory::GOOGLE_MAP,
		Acf_Factory::PASSWORD,
		Acf_Factory::GALLERY,
	);

	/**
	 * @var array
	 */
	public const ACF_NESTED_TYPES = array(
		Acf_Factory::FLEXIBLE_CONTENT,
		Acf_Factory::GROUP,
		Acf_Factory::POST_OBJECT,
		Acf_Factory::RELATIONSHIP,
		Acf_Factory::LINK,
		Acf_Factory::TAXONOMY,
		Acf_Factory::REPEATER,
		Acf_Factory::USER,
	);

	/**
	 * @var array
	 */
	private $field_structure = array();

	/**
	 * @var array
	 */
	private $data = array();


	public function __construct( array $field_structure, array $data ) {
		$this->field_structure = $field_structure;
		$this->data            = $this->format_data_according_structure( $data );
	}

	/**
	 * @return array
	 */
	public function get_field_structure(): array {
		return $this->field_structure;
	}

	/**
	 * @return array
	 */
	public function get_data(): array {
		return $this->data;
	}

	/**
	 * @return bool
	 */
	public static function is_acf_loaded(): bool {
		return class_exists( 'ACF' );
	}

	/**
	 * @param string $post_type Post type.
	 * @return bool
	 */
	public static function acf_exists_for_post_type( string $post_type ): bool {
		return self::is_acf_loaded() && ! empty( acf_get_field_groups( array( 'post_type' => $post_type ) ) );
	}

	/**
	 * @param mixed $data Data.
	 * @return mixed
	 */
	protected function convert_empty_data_to_null( $data ) {
		if ( '' === $data || false === $data ) {
			return null;
		}

		if ( is_array( $data ) || is_object( $data ) ) {
			foreach ( $data as &$value ) {
				$value = $this->convert_empty_data_to_null( $value );
			}
		}

		return $data;
	}

	/**
	 * @param mixed $data Data.
	 * @return mixed
	 */
	protected function remove_empty_keys( &$data ) {
		if ( is_array( $data ) ) {
			foreach ( $data as $key => &$value ) {
				if ( '' === $key ) {
					unset( $data[ $key ] );
				} else {
					$this->remove_empty_keys( $value );
				}
			}
		}
	}

	/**
	 * @param array $data Data.
	 * @return array
	 */
	protected function format_data_according_structure( array $data ): array {
		if ( empty( $this->field_structure ) || empty( $data ) ) {
			return array();
		}

		$field_data = array();

		foreach ( $this->field_structure as $field_group ) {
			if ( empty( $field_group['fields'] ) ) {
				continue;
			}

			$field_title                = String_Transformation::camel_case( $field_group['title'] );
			$field_data[ $field_title ] = array();

			foreach ( $field_group['fields'] as $field ) {
				if ( ! array_key_exists( $field['name'], $data ) ) {
					continue;
				}

				if ( in_array( $field['type'], $this::ACF_UNSUPPORTED_TYPES, true ) ) {
					continue;
				}

				$value = $data[ $field['name'] ];

				if ( Json_Schema_Type::NUMBER === $field['type'] || Json_Schema_Type::INTEGER === $field['type'] ) {
					// check with regex if value is an integer.
					$value = preg_match( '/^-?\d+$/', $value ) ? (int) $value : (float) $value;
				}

				$this->remove_empty_keys( $value );
				$value = $this->convert_empty_data_to_null( $value );

				$field_data[ $field_title ][ String_Transformation::camel_case( $field['name'], array( '_' ) ) ] = $value;
			}
		}

		return $field_data;
	}
}
