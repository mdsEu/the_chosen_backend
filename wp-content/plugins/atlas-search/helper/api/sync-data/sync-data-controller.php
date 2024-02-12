<?php

namespace Wpe_Content_Engine\Helper\API\Sync_Data;

use ErrorException;
use WP_REST_Controller;
use WP_REST_Request;
use Wpe_Content_Engine;
use Wpe_Content_Engine\Helper\Client_Interface;
use Wpe_Content_Engine\Helper\Sync\Batches\Batch_Sync_Factory;
use Wpe_Content_Engine\Helper\Sync\Batches\Options\Batch_Options;
use Wpe_Content_Engine\Helper\Sync\Batches\Options\Progress;
use Wpe_Content_Engine\Helper\Sync\Batches\Options\Resume_Options;
use Wpe_Content_Engine\Helper\Sync\Batches\Options\Sync_Lock_Options;
use Wpe_Content_Engine\Helper\Sync\Batches\Sync_Lock_Manager;
use Wpe_Content_Engine\Helper\Sync\Batches\Sync_Lock_Status_Store_Wordpress;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\Delete_All;
use Wpe_Content_Engine\Settings_Interface;
use Wpe_Content_Engine\Helper\Logging\Debug_Logger;
use Wpe_Content_Engine\Helper\Sync\Batches\Delete_All as Delete_All_Batch;
use Wpe_Content_Engine\Helper\Constants\Sync_Response_Status as Status;
use DateTime;
use Wpe_Content_Engine\Helper\Logging\Server_Log_Info;
use Wpe_Content_Engine\WPSettings;
use const Wpe_Content_Engine\Helper\Notifications\WPE_CONTENT_ENGINE_RE_SYNC_HAS_OCCURRED;

/**
 * Sync data controller allowing syncing data from sync button
 */
class Sync_Data_Controller extends WP_REST_Controller {

	private const DEFAULT_LOCK_ROLLING_TIMEOUT = 10;

	private string $resource_name;

	/**
	 * @var Client_Interface $client
	 */
	protected $client;

	/**
	 * @var Settings_Interface $settings
	 */
	protected $settings;


	public function __construct( Client_Interface $client, Settings_Interface $settings ) {
		$this->client        = $client;
		$this->settings      = $settings;
		$this->namespace     = 'atlas-search/v1';
		$this->resource_name = '/sync-data';
	}

	public function register_routes() {
		register_rest_route(
			$this->namespace,
			$this->resource_name,
			array(
				array(
					'methods'             => 'PUT',
					'callback'            => array(
						$this,
						'sync_data',
					),
					'permission_callback' => array(
						$this,
						'permission_callback',
					),
				),
				'schema' => array(
					$this,
					'get_schema',
				),
			)
		);

		register_rest_route(
			$this->namespace,
			$this->resource_name,
			array(
				array(
					'methods'             => 'DELETE',
					'callback'            => array(
						$this,
						'delete_sync_data',
					),
					'permission_callback' => array(
						$this,
						'permission_callback',
					),
				),
			)
		);

		register_rest_route(
			$this->namespace,
			'/register_sync_as_success',
			array(
				array(
					'methods'             => 'POST',
					'callback'            => array(
						$this,
						'register_sync_as_success',
					),
					'permission_callback' => array(
						$this,
						'permission_callback',
					),
				),
			)
		);

		register_rest_route(
			$this->namespace,
			'/register_sync_as_failure',
			array(
				array(
					'methods'             => 'POST',
					'callback'            => array(
						$this,
						'register_sync_as_failure',
					),
					'permission_callback' => array(
						$this,
						'permission_callback',
					),
				),
			)
		);
	}

	/**
	 * Returns the Atlas Search sync data info.
	 *
	 * @param  WP_REST_Request $request WP Rest request.
	 *
	 * @return Response
	 *
	 * @throws \Exception|ErrorException Thrown if there is an issue processing the sync.
	 */
	public function sync_data( WP_REST_Request $request ) {
		// validate the REST parameters.
		$json   = $request->get_json_params();
		$schema = $this->get_schema();
		$result = rest_validate_value_from_schema( $request->get_json_params(), $schema, 'Body' );
		if ( is_wp_error( $result ) ) {
			return new Response( Status::ERROR, 100, $result->get_error_message() );
		}

		$batch_options = new Batch_Options(
			Batch_Options::DEFAULT_BATCH_SIZE,
			1,
			Batch_Sync_Factory::DATA_TO_SYNC
		);

		/** @var Resume_Options|null $resume_options */
		$resume_options = $this->get_option( Batch_Options::OPTIONS_WPE_CONTENT_ENGINE_SYNC_RESUME, null );

		if ( ! empty( $resume_options ) && ( $resume_options instanceof Resume_Options ) ) {
			$batch_options->calculate_with_resume( $resume_options );
		}

		if ( ! isset( $resume_options ) || ! $resume_options->get_progress() ) {
			$progress = new Progress( $this->get_count_data_to_be_synced(), 0 );
		} else {
			$progress = $resume_options->get_progress();
		}

		$logger                 = new Debug_Logger();
		$sync_lock_options      = new Sync_Lock_Options( self::DEFAULT_LOCK_ROLLING_TIMEOUT );
		$sync_lock_status_store = new Sync_Lock_Status_Store_Wordpress();
		$sync_lock_manager      = new Sync_Lock_Manager( $sync_lock_status_store );
		$uuid                   = $json['uuid'];
		$logger->log( "Sync lock ID given: {$uuid}" );

		$moment         = new DateTime();
		$complete       = false;
		$can_start      = $sync_lock_manager->can_start( $moment, $sync_lock_options, $uuid );
		$can_start_text = $can_start ? 'yes' : 'no';
		$logger->log( "Init check, can start: {$can_start_text}, Uuid supplied: {$uuid}" );

		if ( $can_start ) {
			// activate sync lock.
			$logger->log( 'No lock present, starting sync...' );
			try {
				$uuid = $sync_lock_manager->start( $moment, $sync_lock_options, $uuid );
			} catch ( \Exception $e ) {
				$logger->log( "Something went wrong. Error message: {$e->getMessage()}" );

				return new Response( Status::ERROR, $progress->get_rounded_percentage(), 'A sync error occurred!', $uuid );
			}
			$logger->log( "Sync lock acquired. Sync lock ID: {$uuid}" );
		} else {
			// log details of the lock in place for diagnosis.
			$last_status = $sync_lock_manager->get_status();
			$active_uuid = $last_status->get_uuid();
			$ids_equal   = $active_uuid === $uuid ? 'yes' : 'no';
			$logger->log( "UUIDs equal? {$ids_equal}" );
			$last_updated      = $last_status->get_last_updated();
			$last_updated_text = $last_updated->format( 'Y-m-d H:i:s' );
			$logger->log( "Lock active [{$active_uuid}], last updated {$last_updated_text}! Cannot start a new sync! Exiting..." );
			$uuid = null;

			return new Response( Status::ERROR, 100, 'A data sync is already in progress. You or another user may have begun this process. Please wait a few seconds and try again.', $uuid );
		}

		$this->delete_option( Batch_Options::OPTIONS_WPE_CONTENT_ENGINE_SYNC_RESUME );
		$current_data = $batch_options->get_current_class_to_be_synced();
		$short_name   = $current_data['short_name'];
		$obj          = Batch_Sync_Factory::build( $current_data['class'], $this->client, $this->settings );
		$page         = $batch_options->get_page();
		$items        = $obj->get_items( $page, Batch_Options::DEFAULT_BATCH_SIZE );

		if ( empty( $items ) || ( Delete_All_Batch::class == $current_data['class'] ) ) {
			if ( $batch_options->is_last_class_to_be_synced() ) {
				$this->delete_option( Batch_Options::OPTIONS_WPE_CONTENT_ENGINE_SYNC_RESUME );

				if ( ! empty( $uuid ) ) {
					$moment = new DateTime();
					$sync_lock_manager->finish( $moment, $uuid );
					$logger->log( "Sync lock ID {$uuid} released!" );
				} else {
					$logger->log( 'No sync lock acquired this run.!' );
				}

				$logger->log( 'Returning a status of COMPLETED' );
				$complete = true;

				update_option( WPE_CONTENT_ENGINE_RE_SYNC_HAS_OCCURRED, true );

				return new Response( Status::COMPLETED, 100, '', $uuid );
			}
			$debug_message = "{$short_name}: page -> {$page}";
			$short_name    = $batch_options->get_next_class_name();
			$this->update_option( Batch_Options::OPTIONS_WPE_CONTENT_ENGINE_SYNC_RESUME, new Resume_Options( $short_name, Batch_Options::DEFAULT_BATCH_SIZE, 1, $progress ) );

			$logger->log( "Returning a status of PENDING with lockID [{$uuid}] for object {$short_name}, {$debug_message}." );
			return new Response( Status::PENDING, $progress->get_rounded_percentage(), "Syncing {$short_name}", $uuid );
		}

		$logger->log( "Performing sync batch and incrementing page with lockID [{$uuid}] for object {$short_name}." );
		try {
			$obj->sync( $items );
			$page ++;
		} catch ( \Throwable $e ) {
			$message = $e->getMessage();
			$logger->log( "Something went wrong. Error message: {$message}" );

			if ( ! empty( $uuid ) ) {
				$moment = new DateTime();
				$sync_lock_manager->finish( $moment, $uuid );
				$logger->log( "Sync lock ID {$uuid} released!" );
			} else {
				$logger->log( 'No sync lock acquired this run.!' );
			}
		} finally {
			if ( ! $complete && $can_start ) {
				$progress->increase_synced_items( count( $items ) );
				$this->update_option( Batch_Options::OPTIONS_WPE_CONTENT_ENGINE_SYNC_RESUME, new Resume_Options( $short_name, Batch_Options::DEFAULT_BATCH_SIZE, $page, $progress ) );
				if ( isset( $e ) && ( $e instanceof ErrorException ) ) {
					/** @var ErrorException|null $e */
					$logger->log( "Returning a status of ERROR with lockID [{$uuid}] for object {$short_name}." );
					$message = ( 401 === $e->getCode() || 404 === $e->getCode() ) ? $e->getMessage() : 'A sync error occurred!';

					return new Response( Status::ERROR, $progress->get_rounded_percentage(), $message, $uuid );
				}

				$logger->log( "Finally{} Returning a status of PENDING with lockID [{$uuid}] for object {$short_name}." );
				return new Response( Status::PENDING, $progress->get_rounded_percentage(), "Syncing {$short_name}", $uuid );
			}
		}
	}

	/**
	 * Reset sync data progress.
	 *
	 * @param WP_REST_Request        $request WP Rest request.
	 * @param null|Sync_Lock_Manager $sync_lock_manager WP Sync Lock manager.
	 * @param null|Delete_All        $delete_entity Class that deletes all data in atlas search server.
	 *
	 * @return \WP_REST_Response
	 */
	public function delete_sync_data( WP_REST_Request $request, Sync_Lock_Manager $sync_lock_manager = null, Delete_All $delete_entity = null ) {

		$sync_lock_manager = $sync_lock_manager ?? new Sync_Lock_Manager( new Sync_Lock_Status_Store_Wordpress() );
		$sync_lock_options = new Sync_Lock_Options( self::DEFAULT_LOCK_ROLLING_TIMEOUT );
		$can_start         = $sync_lock_manager->can_start( new DateTime(), $sync_lock_options );

		if ( ! $can_start ) {
			return new \WP_REST_Response(
				array(
					'status'  => Status::ERROR,
					'message' => 'A data sync seems to already be active! Please wait for it to finish!!',
				),
			);
		}

		try {
			$delete_entity = $delete_entity ?? new Delete_All( $this->client, $this->settings );
			$delete_entity->delete();
			$this->delete_option( Batch_Options::OPTIONS_WPE_CONTENT_ENGINE_SYNC_RESUME );
		} catch ( \Exception $e ) {
			$logger = new Debug_Logger();
			$logger->log( "An error occurred while trying to delete all data. Error message: {$e->getMessage()} \n Trace: {$e->getTraceAsString()} " );

			return new \WP_REST_Response(
				array(
					'status'  => Status::ERROR,
					'message' => 'An error occurred while trying to delete all data!',
				),
			);
		}

		return new \WP_REST_Response(
			array(
				'status'  => Status::COMPLETED,
				'message' => 'Synced data were deleted successfully!',
			),
		);
	}

	/**
	 * Check permissions.
	 *
	 * @param WP_REST_Request $request The WP Rest request.
	 * @return bool
	 */
	public function permission_callback( WP_REST_Request $request ): bool {
		return current_user_can( 'manage_options' );
	}

	/**
	 * @param string $option Option to retrieve.
	 * @param false  $default Default value.
	 *
	 * @return false|mixed|void
	 */
	public function get_option( string $option, $default = false ) {
		return get_option( $option, $default );
	}

	/**
	 * @param string $option Option to delete.
	 */
	public function delete_option( string $option ) {
		delete_option( $option );
	}

	/**
	 * @param string $option Option to update.
	 * @param mixed  $value Value for the update.
	 */
	public function update_option( string $option, $value ) {
		update_option( $option, $value );
	}

	/**
	 * Schema of the REST Endpoints
	 *
	 * @return array
	 */
	public function get_schema(): array {
		$properties = array(
			'uuid' => array( 'type' => 'string' ),
		);

		return array(
			'$schema'              => 'http://json-schema.org/draft-04/schema#',
			'title'                => 'sync-data',
			'type'                 => 'object',
			'properties'           => $properties,
			'additionalProperties' => false,
		);
	}

	/**
	 * @return int
	 */
	private function get_count_data_to_be_synced() {
		$counter = 0;
		foreach ( Batch_Sync_Factory::DATA_TO_SYNC as $item ) {
			$obj      = Batch_Sync_Factory::build( $item, $this->client, $this->settings );
			$counter += $obj->get_total_items();
		}

		return $counter;
	}

	public function register_sync_as_success( WP_REST_Request $request ) {
		$query = <<<'GRAPHQL'
			mutation RecordSuccessfulSync {
				recordSuccessfulSync {
					status
					message
				}
			}
		GRAPHQL;

		$graphql_vars               = array();
		$wpe_content_engine_options = $this->settings->get( WPSettings::WPE_CONTENT_ENGINE_OPTION_NAME );
		$request_data               = $request->get_json_params();
		$time_taken                 = $request_data['timeTaken'] ?? null;
		$log_info                   = ( new Server_Log_Info() )->get_data();
		$log_info['timeTaken']      = $time_taken;

		$this->client->query(
			$wpe_content_engine_options['url'],
			$query,
			$graphql_vars,
			$wpe_content_engine_options['access_token'],
			$log_info
		);
	}

	public function register_sync_as_failure( WP_REST_Request $request ) {
		$query = <<<'GRAPHQL'
			mutation RecordFailedSync {
				recordFailedSync {
					status
					message
				}
			}
		GRAPHQL;

		$graphql_vars               = array();
		$wpe_content_engine_options = $this->settings->get( WPSettings::WPE_CONTENT_ENGINE_OPTION_NAME );
		$request_data               = $request->get_json_params();
		$time_taken                 = $request_data['timeTaken'] ?? null;
		$log_info                   = ( new Server_Log_Info() )->get_data();
		$log_info['timeTaken']      = $time_taken;

		$this->client->query(
			$wpe_content_engine_options['url'],
			$query,
			$graphql_vars,
			$wpe_content_engine_options['access_token'],
			$log_info
		);
	}
}

