<?php

namespace Wpe_Content_Engine\Helper\Sync\Entity\Wordpress;

use ErrorException;
use WP_Post;
use DateTime;
use Wpe_Content_Engine\Helper\Acf_Support\Acf;
use Wpe_Content_Engine\Helper\Acf_Support\Acf_Factory;
use Wpe_Content_Engine\Helper\Data_Life_Cycle;
use Wpe_Content_Engine\Helper\Json_Schema\Integer_Property;
use Wpe_Content_Engine\Helper\Json_Schema\Json_Schema;
use Wpe_Content_Engine\Helper\Json_Schema\String_Property;
use Wpe_Content_Engine\Helper\Json_Schema\Date_Time_Property;
use Wpe_Content_Engine\Helper\Logging\Server_Log_Info;
use Wpe_Content_Engine\Helper\String_Transformation;
use Wpe_Content_Engine\Helper\Constants\Post_Status;
use Wpe_Content_Engine\WPSettings;

class Custom_Post_Type extends WP_Entity {
	/**
	 * @param int      $post_id Post ID.
	 * @param WP_Post  $cpt_post CPT Post.
	 * @param Acf|null $acf_info ACF info.
	 * @throws ErrorException Exception.
	 */
	public function upsert( int $post_id, WP_Post $cpt_post, ?Acf $acf_info = null ) {
		if ( ! $this->is_allowed( $cpt_post ) ) {
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
			'schemaName'   => $cpt_post->post_type,
			'schemaData'   => $this->generate_json_schema( $cpt_post->post_type, $acf_info ) ?? array(),
			'dataName'     => $cpt_post->post_type,
			'dataObjectId' => (string) $post_id,
			'dataContext'  => $this->generate_json_schema_data( $cpt_post, $acf_info ) ?? array(),
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
	 * @param WP_Post $cpt_post CPT Post.
	 * @throws ErrorException Exception.
	 */
	public function delete( int $post_id, WP_Post $cpt_post ) {
		if ( ! $this->is_allowed( $cpt_post ) ) {
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
				'name'     => $cpt_post->post_type,
				'objectId' => (string) $post_id,
			),
			$access_token
		);
	}

	/**
	 * @return string[]
	 */
	public static function allowed_custom_post_types(): array {
		return get_post_types(
			array(
				'public'   => true,
				'_builtin' => false,
			)
		);
	}

	/**
	 * @param string $post_type Post Type.
	 * @return bool
	 */
	public static function is_custom_post_type( string $post_type ): bool {
		return post_type_exists( $post_type ) && empty(
			get_post_types(
				array(
					'name'     => $post_type,
					'_builtin' => true,
				)
			)
		);
	}

	/**
	 * @param WP_Post $cpt_post CPT Post.
	 * @return bool
	 */
	private function is_allowed( WP_Post $cpt_post ): bool {
		if ( Post_Status::AUTO_DRAFT === $cpt_post->post_status ) {
			return false;
		}

		if ( ! in_array( $cpt_post->post_type, self::allowed_custom_post_types() ) ) {
			return false;
		}

		return true;
	}

	/**
	 * @param string   $name Name.
	 * @param Acf|null $acf_info ACF Info.
	 * @return string[]
	 */
	private function generate_json_schema( string $name, ?Acf $acf_info = null ): array {
		$cpt = new Json_Schema( String_Transformation::camel_case( $name ) );

		$cpt->add_property( new Integer_Property( 'id' ), true )
			->add_property( new String_Property( 'title' ), true )
			->add_property( new String_Property( 'slug' ), true )
			->add_property( new String_Property( 'excerpt' ), true )
			->add_property( new String_Property( 'post_type' ), true )
			->add_property( new String_Property( 'content' ), true )
			->add_property( new String_Property( 'post_status' ), true )
			->add_property( new Date_Time_Property( 'published_at' ), true );

		if ( empty( $acf_info ) ) {
			return $cpt->generate();
		}

		$field_groups = $acf_info->get_field_structure();

		foreach ( $field_groups as $field_group ) {
			if ( empty( $field_group ) || ! $field_group['active'] ) {
				continue;
			}

			$name               = String_Transformation::camel_case( $field_group['title'] ) . 'ACF';
			$field_group_schema = new Json_Schema( $name, true );

			if ( empty( $field_group['fields'] ) ) {
				continue;
			}

			foreach ( $field_group['fields'] as $field ) {
				$acf_helper_obj = Acf_Factory::build( $field['type'], String_Transformation::camel_case( $field['name'], array( '_' ) ) );

				if ( $acf_helper_obj ) {
					$field_group_schema->add_property( $acf_helper_obj->to_json_schema_property(), (bool) $field['required'] );
				}
			}

			$cpt->add_property( $field_group_schema, false );
		}

		return $cpt->generate();
	}

	/**
	 * @param WP_Post  $cpt_post CPT Post.
	 * @param Acf|null $acf_info ACF Info.
	 * @return string[]
	 */
	private function generate_json_schema_data( WP_Post $cpt_post, ?Acf $acf_info = null ): array {
		$published_at = new DateTime( $cpt_post->post_date );

		return array_merge(
			array(
				'id'           => $cpt_post->ID,
				'title'        => $cpt_post->post_title,
				'excerpt'      => $cpt_post->post_excerpt,
				'slug'         => $cpt_post->post_name,
				'post_type'    => $cpt_post->post_type,
				'content'      => $cpt_post->post_content,
				'published_at' => $published_at->format( 'Y-m-d\TH:i:s.u\Z' ),
				'post_status'  => Data_Life_Cycle::map_status( $cpt_post->post_status, $cpt_post->post_password ),
			),
			isset( $acf_info ) ? $acf_info->get_data() : array()
		);
	}
}
