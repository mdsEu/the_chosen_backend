<?php

if ( ! defined( 'WP_CLI' ) ) {
	return;
}

use Wpe_Content_Engine\Core_Wp_Wrapper\Wp_Progress_Bar;
use Wpe_Content_Engine\Helper\Progress_Bar_Info_Trait;
use Wpe_Content_Engine\Helper\Sync\Batches\Delete_All as Delete_All_Batch;
use Wpe_Content_Engine\Helper\Sync\Batches\Batch_Sync_Factory;
use Wpe_Content_Engine\Helper\Sync\Batches\Options\Batch_Options;
use Wpe_Content_Engine\Helper\Sync\Batches\Options\Resume_Options;
use Wpe_Content_Engine\Helper\Sync\Batches\Options\Sync_Lock_Options;
use Wpe_Content_Engine\Helper\Sync\Batches\Sync_Lock_Manager;
use Wpe_Content_Engine\Helper\Sync\Batches\Sync_Lock_Status_Store_Wordpress;
use Wpe_Content_Engine\Helper\Sync\Batches\Batch_Sync_Interface;
use Wpe_Content_Engine\Helper\Sync\GraphQL\Client;
use Wpe_Content_Engine\WPSettings;
use Wpe_Content_Engine\Helper\Logging\Server_Log_Info;

// @codingStandardsIgnoreStart

/**
 * Implements example command.
 */
class Wpe_Content_Engine_Sync_Data {

	/**
	 * Syncs all data to Atlas Search.
	 *
	 * ## EXAMPLES
	 *
	 *    wp as sync_data --size=10 --no-resume
	 *    or
	 *    wp as sync_data
	 *    or
	 *    wp as sync_data --reset
	 *
	 * [--size=<batch-size>]
	 * : Used to sync ALL data in batches of <batch-size>. Batch size should be a positive integer. If is set to a very big integer the system might run out of memory or fail to sync all data. If no value is specified then defaults to 20
	 *
	 * [--no-resume]
	 * : Start sync from the start and not from last error
	 * default: true
	 *
	 * [--reset]
	 * : Clear all data before sync
	 * default: false
	 *
	 * @when after_wp_load
	 *
	 */
	public function sync_data( $args, $assoc_args ) {
		$batch_size = (int) ( $assoc_args['size'] ?? Batch_Options::DEFAULT_BATCH_SIZE );

		if ( $batch_size <= 0 ) {
			WP_CLI::error( 'Batch size should be an integer greater than zero' );
			return;
		}

		$with_reset = $assoc_args['reset'] ?? false;
		$with_resume = $assoc_args['resume'] ?? true;

		$batch_options = new Batch_Options(
			$batch_size,
			1,
			Batch_Sync_Factory::DATA_TO_SYNC
		);

		/** @var Resume_Options|null $resume_options */
		$resume_options = get_option( Batch_Options::OPTIONS_WPE_CONTENT_ENGINE_SYNC_RESUME, null );

		if ( $with_resume && !$with_reset && !empty( $resume_options ) && ( $resume_options instanceof Resume_Options ) ) {
			$batch_options->calculate_with_resume( $resume_options );
			WP_CLI::log( "Resume started! Starting with these parameters --> Table:{$resume_options->get_entity()}, Page: {$batch_options->get_page()}, Batch Size: {$batch_options->get_batch_size()}" );
		}

		$sync_lock_options = new Sync_Lock_Options( 60 );
		$sync_lock_status_store = new Sync_Lock_Status_Store_Wordpress();
		$sync_lock_manager = new Sync_Lock_Manager( $sync_lock_status_store );
		$uuid = null;
		try {
			$time_start = new DateTime();
			$start = microtime(true);
			$settings = new WPSettings();
			$client = new Client( Wpe_Content_Engine::get_plugin_name(), Wpe_Content_Engine::get_version());

			$moment = new DateTime();
			$can_start = $sync_lock_manager->can_start( $moment, $sync_lock_options );
			$cannot_start_text = !$can_start ? 'yes' : 'no';
			WP_CLI::log( "Init check, lock present: {$cannot_start_text}" );

			if ( $can_start ) {
				// activate
				WP_CLI::log( "No lock present, starting sync..." );
				$uuid = $sync_lock_manager->start( $moment, $sync_lock_options, null );
				WP_CLI::log( "Sync lock acquired. Sync lock ID: {$uuid}" );
			}
			else {
				WP_CLI::log( "Lock active! Cannot start a new sync! Exiting..." );
				return;
			}

			delete_option( Batch_Options::OPTIONS_WPE_CONTENT_ENGINE_SYNC_RESUME );

			foreach ( $batch_options->get_data_to_be_synced() as $short_name => $class ) {

				if ( ! $with_reset && ( Delete_All_Batch::class == $class ) ) {
					continue;
				}

				/** @var Batch_Sync_Interface| Progress_Bar_Info_Trait $obj ,
				 * @var string $class
				 */
				$obj = Batch_Sync_Factory::build( $class, $client, $settings );
				$page = $batch_options->get_page();
				WP_CLI::log( "Sync started : {$short_name}" );

				do {
					try {
						$items = $obj->get_items( $page, $batch_size );

						if ( empty( $items ) ) {
							continue;
						}

						$obj->format_items( $items, $page );
						$obj->set_progress_bar( new Wp_Progress_Bar( count( $items ) ) );
						$obj->sync( $items );
						$page ++;
					} catch ( ErrorException $e ) {
						WP_CLI::error( "Something went wrong. Error message: {$e->getMessage()}", false );

						try {
							$end = round(microtime(true) - $start,3)*1000;
							$this->register_sync_as_failure($client, $end);
						} catch ( ErrorException $e) {
							WP_CLI::error( "Sync Statistics couldn't be updated", false );
						}
					} finally {
						update_option( Batch_Options::OPTIONS_WPE_CONTENT_ENGINE_SYNC_RESUME, new Resume_Options( $short_name, $batch_size, $page ) );

						if ( isset( $e ) && ( $e instanceof ErrorException ) ) {
							/** @var ErrorException|null $e */
							throw $e;
						}
					}
				} while ( count( $items ) >= $batch_size );

				$batch_options->set_page( 1 );
				WP_CLI::log( empty( $obj->get_items( 1, $batch_size ) ) ? "No {$short_name} data to sync" : "Sync Success: {$short_name}" );
			}

			delete_option( Batch_Options::OPTIONS_WPE_CONTENT_ENGINE_SYNC_RESUME );
			WP_CLI::log( 'Success syncing all data' );

			$fd = ( new DateTime() )->diff( $time_start );
			WP_CLI::log( WP_CLI::colorize( "%GTotal time: {$fd->format('%H:%i:%s.%f')}%n " ) );

			try {
				$end = round(microtime(true) - $start,3)*1000;
				$this->register_sync_as_failure($client, $end);
			} catch (ErrorException $e) {
				WP_CLI::error( "Sync Statistics couldn't be updated", false );
			}
		} catch ( ErrorException $e ) {
			WP_CLI::error( "There was an error during sync. Error message: {$e->getMessage()}", false );
		}
		finally {
			// make sure that we always release the lock if we acquired one this run.
			if ( !empty( $uuid ) ) {
				$moment = new DateTime();
				$sync_lock_manager->finish( $moment, $uuid );
				WP_CLI::log( "Sync lock ID {$uuid} released!" );
			}
			else {
				WP_CLI::log( 'No sync lock acquired this run.!' );
			}
		}
	}

	private function register_sync_as_success(Client $client, int $time_taken) {
		$query = <<<'GRAPHQL'
			mutation RecordSuccessfulSync {
				recordSuccessfulSync {
					status
					message
				}
			}
		GRAPHQL;

		$graphql_vars = array();
		$ce_options = get_option( WPSettings::WPE_CONTENT_ENGINE_OPTION_NAME );
		$log_info = ( new Server_Log_Info() )->get_data();
		$log_info['timeTaken'] = $time_taken;

		$client->query(
			$ce_options['url'],
			$query,
			$graphql_vars,
			$ce_options['access_token'],
			$log_info
		);
	}

	private function register_sync_as_failure(Client $client, int $time_taken) {
		$query = <<<'GRAPHQL'
			mutation RecordFailedSync {
				recordFailedSync {
					status
					message
				}
			}
		GRAPHQL;

		$graphql_vars = array();
		$ce_options = get_option( WPSettings::WPE_CONTENT_ENGINE_OPTION_NAME );
		$log_info = ( new Server_Log_Info() )->get_data();
		$log_info['timeTaken'] = $time_taken;

		$client->query(
			$ce_options['url'],
			$query,
			$graphql_vars,
			$ce_options['access_token'],
			$log_info
		);
	}
}

WP_CLI::add_command( 'as', 'Wpe_Content_Engine_Sync_Data' );

// @codingStandardsIgnoreEnd
