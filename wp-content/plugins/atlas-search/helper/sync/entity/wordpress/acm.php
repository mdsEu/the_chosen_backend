<?php

namespace Wpe_Content_Engine\Helper\Sync\Entity\Wordpress;

use ErrorException;
use WP_Post;
use DateTime;
use Wpe_Content_Engine\Helper\Constants\Json_Schema_Type;
use Wpe_Content_Engine\Helper\Data_Life_Cycle;
use Wpe_Content_Engine\Helper\Json_Schema\Array_Property;
use Wpe_Content_Engine\Helper\Json_Schema\Boolean_Property;
use Wpe_Content_Engine\Helper\Json_Schema\Integer_Property;
use Wpe_Content_Engine\Helper\Json_Schema\Json_Schema;
use Wpe_Content_Engine\Helper\Json_Schema\Number_Property;
use Wpe_Content_Engine\Helper\Json_Schema\String_Property;
use Wpe_Content_Engine\Helper\Json_Schema\Date_Time_Property;
use Wpe_Content_Engine\Helper\Constants\Post_Status;
use Wpe_Content_Engine\Helper\Logging\Server_Log_Info;
use Wpe_Content_Engine\WPSettings;
use function WPE\AtlasContentModeler\ContentRegistration\get_registered_content_types;
use function WPE\AtlasContentModeler\is_field_repeatable;

class ACM extends WP_Entity {

	/**
	 * @param int     $post_id Post ID.
	 * @param WP_Post $acm_post ACM Post.
	 * @throws ErrorException Exception.
	 */
	public function upsert( int $post_id, WP_Post $acm_post ) {
		if ( ! $this->is_allowed( $acm_post ) ) {
			return;
		}

		$query = <<<'GRAPHQL'
			mutation syncSchema(
				$schemaName: String!
				$schemaData : JSON!
				$dataName: String!
				$dataObjectId: String!
			    $dataContext : JSON!
			) {
				syncSchema(
					name: $schemaName
					data: {
						schema: $schemaData
						}
				) {
						status
						message
				}

			syncSchemaValue(
					name: $dataName
					objectId: $dataObjectId
					data: {
						values: $dataContext
					}
				) {
						status
						message
				}
			}
			GRAPHQL;

		$graphql_vars = array(
			'schemaName'   => $acm_post->post_type,
			'schemaData'   => $this->generate_json_schema( $acm_post->post_type ) ?? array(),
			'dataName'     => $acm_post->post_type,
			'dataObjectId' => (string) $post_id,
			'dataContext'  => $this->generate_json_schema_data( $acm_post ) ?? array(),
		);

		$wpe_content_engine_options = $this->settings->get( WPSettings::WPE_CONTENT_ENGINE_OPTION_NAME ); // Array of All Options.

		$this->client->query(
			$wpe_content_engine_options['url'],
			$query,
			$graphql_vars,
			$wpe_content_engine_options['access_token'],
			( new Server_Log_Info() )->get_data()
		);
	}

	/**
	 * @param int     $post_id Post ID.
	 * @param WP_Post $acm_post ACM Post.
	 * @throws ErrorException Exception.
	 */
	public function delete( int $post_id, WP_Post $acm_post ) {
		if ( ! $this->is_allowed( $acm_post ) ) {
			return;
		}
		$query = <<<'GRAPHQL'
			mutation deleteSchemaValue($name: String!,$objectId: String!) {
				deleteSchemaValue(name: $name, objectId: $objectId) {
					status
					message
				}
			}
		GRAPHQL;

		$wpe_content_engine_options = $this->settings->get( WPSettings::WPE_CONTENT_ENGINE_OPTION_NAME ); // Array of All Options.
		$url                        = $wpe_content_engine_options['url']; // Url.
		$access_token               = $wpe_content_engine_options['access_token']; // Access Token.

		$this->client->query(
			$url,
			$query,
			array(
				'name'     => $acm_post->post_type,
				'objectId' => (string) $post_id,
			),
			$access_token
		);
	}

	/**
	 * @return bool
	 */
	public static function is_acm_loaded(): bool {
		return is_plugin_active( 'atlas-content-modeler/atlas-content-modeler.php' );
	}

	/**
	 * @param string $post_type Post Type.
	 * @return bool
	 */
	public static function is_acm_model( string $post_type ): bool {
		return self::is_acm_loaded() && array_key_exists( $post_type, get_registered_content_types() );
	}

	/**
	 * @return string[]
	 */
	public static function allowed_custom_post_types(): array {
		return array_keys( get_registered_content_types() );
	}

	/**
	 * Get ACM model fields.
	 *
	 * @param string $name Model name.
	 *
	 * @return array
	 */
	public static function get_fields( string $name ): array {
		$model = get_registered_content_types()[ $name ];

		return $model['fields'];
	}

	/**
	 * @param WP_Post $acm_post ACM Post.
	 * @return bool
	 */
	private function is_allowed( WP_Post $acm_post ): bool {
		if ( Post_Status::AUTO_DRAFT === $acm_post->post_status ) {
			return false;
		}

		if ( ! in_array( $acm_post->post_type, self::allowed_custom_post_types() ) ) {
			return false;
		}

		return true;
	}

	/**
	 * @param string $name Name.
	 * @return string[]
	 */
	private function generate_json_schema( string $name ): array {
		$cpt = new Json_Schema( $name );
		$cpt->add_property( new Integer_Property( 'id' ), true );
		$cpt->add_property( new String_Property( 'post_type' ), true );
		$cpt->add_property( new Date_Time_Property( 'published_at' ), true );
		$cpt->add_property( new String_Property( 'title' ), true );
		$cpt->add_property( new String_Property( 'post_status' ), true );

		$fields = self::get_fields( $name );

		foreach ( $fields as $field ) {
			switch ( $field['type'] ) {
				case 'email':
				case 'richtext':
				case 'date':
				case 'text':
					$required = ! empty( $field['required'] );

					if ( is_field_repeatable( $field ) ) {
						$cpt->add_property(
							new Array_Property( $field['slug'], Json_Schema_Type::STRING, true ),
							$required,
						);
						break;
					}

					$cpt->add_property( new String_Property( $field['slug'], true ), $required );

					if ( isset( $field['isTitle'] ) && $field['isTitle'] ) {
						$cpt->add_property( new String_Property( 'title' ), $required );
					}

					break;

				case 'boolean':
					$cpt->add_property( new Boolean_Property( $field['slug'] ), ! empty( $field['required'] ) );
					break;

				case 'media':
					$cpt->add_property( new String_Property( $field['slug'] ), ! empty( $field['required'] ) );
					break;

				case 'number':
					$proper_class = ( 'integer' === $field['numberType'] ) ? Integer_Property::class : Number_Property::class;
					$cpt->add_property( new $proper_class( $field['slug'] ), ! empty( $field['required'] ) );
					break;

				case 'multipleChoice':
				case 'relationship':
				default:
					break;
			}
		}
		return $cpt->generate();
	}

	/**
	 * @param WP_Post $acm_object ACM Object.
	 * @return string[]
	 */
	private function generate_json_schema_data( WP_Post $acm_object ): array {
		$published_at = new DateTime( $acm_object->post_date );

		$data = array(
			'id'           => $acm_object->ID,
			'post_type'    => $acm_object->post_type,
			'published_at' => $published_at->format( 'Y-m-d\TH:i:s.u\Z' ),
			'title'        => apply_filters( 'the_title', $acm_object->post_title, $acm_object->ID ),
			'post_status'  => Data_Life_Cycle::map_status( $acm_object->post_status, $acm_object->post_password ),
		);

		$models = get_registered_content_types();
		// @codingStandardsIgnoreLine
		if ( empty( $model = $models[ $acm_object->post_type ] ) ) {
			return $data;
		}

		foreach ( $model['fields'] as $field ) {
			// @todo skipping these fields for now.
			if ( in_array( $field['type'], array( 'multipleChoice', 'relationship' ), true ) ) {
				continue;
			}

			$value = get_post_meta( $acm_object->ID, $field['slug'], true );

			switch ( $field['type'] ) {
				case 'number':
					$value = ( 'integer' === $field['numberType'] ) ? (int) $value : (float) $value;
					break;
				case 'boolean':
					$value = ! empty( $value );
					break;
				case 'media':
					// @codingStandardsIgnoreLine
					if ( ! empty( $url = wp_get_attachment_url( $value ) ) ) {
						$value = $url;
					}
					break;
				case 'date':
				case 'text':
					if ( '' === $value ) {
						$value = null;
					}
					break;
				default:
					break;
			}

			$data[ $field['slug'] ] = $value;
		}

		return $data;
	}
}
