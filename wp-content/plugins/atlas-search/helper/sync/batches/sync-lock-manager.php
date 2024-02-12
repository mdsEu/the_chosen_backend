<?php

namespace Wpe_Content_Engine\Helper\Sync\Batches;

use Cassandra\Uuid;
use DateTime;
use Wpe_Content_Engine\Helper\Sync\Batches\Options\Sync_Lock_Options;
use Wpe_Content_Engine\Helper\Sync\Batches\Options\Sync_Lock_State;
use Wpe_Content_Engine\Helper\Sync\Batches\Options\Sync_Lock_Status;

class Sync_Lock_Manager {
	private Sync_Lock_Status_Store_Interface $sync_lock_status_store;

	public function __construct( Sync_Lock_Status_Store_Interface $sync_lock_status_store ) {
		$this->set_sync_lock_status_store( $sync_lock_status_store );
	}

	private function get_sync_lock_status_store(): Sync_Lock_Status_Store_Interface {
		return $this->sync_lock_status_store;
	}

	private function set_sync_lock_status_store( Sync_Lock_Status_Store_Interface $sync_lock_status_store ) {
		$this->sync_lock_status_store = $sync_lock_status_store;
	}

	public function get_status() {
		return $this->get_sync_lock_status_store()->get_status();
	}

	private function set_status( Sync_Lock_Status $status ) {
		$this->sync_lock_status_store->set_status( $status );
	}

	/**
	 * Determines if the task can/should be run based on the current moment
	 * and lock status.
	 *
	 * @param DateTime          $moment The moment in time to start.
	 * @param Sync_Lock_Options $options The expiry options for the lock.
	 * @param string|null       $uuid The sync lock ID of the session attempting to resume.
	 *
	 * @return bool
	 */
	public function can_start( DateTime $moment, Sync_Lock_Options $options, ?string $uuid = null ): bool {
		// are we already in a running state?
		$status = $this->get_status();
		if ( Sync_Lock_State::RUNNING !== $status->get_state() ) {
			return true;
		}

		// was a sync ID was specified?
		if ( ! empty( $uuid ) ) {
			// does the ID match the session ID?
			if ( $uuid === $status->get_uuid() ) {
				return true;
			}
		}

		// have we gone past the expiry?
		$expiry_threshold = $status->get_last_updated()->add( new \DateInterval( "PT{$options->get_rolling_timeout_expiry_seconds()}S" ) );
		if ( $moment >= $expiry_threshold ) {
			// timeout has expired.
			return true;
		}

		// we're still running/haven't expired.
		return false;
	}

	/**
	 * Starts/creates the lock, if available.
	 *
	 * @param DateTime          $start_at The starting date/time that the lock is initiating.
	 * @param Sync_Lock_Options $sync_lock_options The expiry options for the lock.
	 * @param ?string           $uuid The UUID of the existing sync lock, if any.
	 *
	 * @return string The UUID of the sync lock, if acquired.
	 * @throws \Exception Thrown if arguments are missing.
	 * @throws \Exception Thrown if a sync lock cannot be established.
	 */
	public function start( DateTime $start_at, Sync_Lock_Options $sync_lock_options, ?string $uuid ): string {
		if ( empty( $start_at ) || empty( $sync_lock_options ) ) {
			throw new \Exception( 'Argument(s) missing' );
		}

		if ( ! $this->can_start( $start_at, $sync_lock_options, $uuid ) ) {
			throw new \Exception( 'Cannot start as the sync is locked' );
		}

		if ( empty( $uuid ) ) {
			$uuid = $this->generate_uuid();
		}

		$this->save_changes( Sync_Lock_State::RUNNING, $start_at, $uuid );
		return $uuid;
	}

	/**
	 * Updates the state of the lock.
	 *
	 * @param string   $state     The state to update to.
	 * @param DateTime $moment The moment in time the update is occurring.
	 *
	 * @return void
	 */
	public function update( string $state, DateTime $moment ): void {
		$this->save_changes( $state, $moment );
	}

	/**
	 * This closes the sync, releasing the lock and resetting the sync
	 * state to be ready to start again.
	 *
	 * @param DateTime $moment The moment in time that the lock is being released.
	 * @param string   $uuid The UUID of the lock to release. The lock will only be released
	 *                       if the UUID matches what's stored.
	 *
	 * @return void
	 */
	public function finish( DateTime $moment, ?string $uuid ) {
		$status = $this->get_status();

		if ( ! empty( $uuid ) && $uuid !== $status->get_uuid() ) {
			// this isn't the call chain that acquired the lock so don't release it, just exit.
			return;
		}

		$status->set_state( Sync_Lock_State::STOPPED );
		$status->set_last_updated( $moment );
		$status->set_uuid( null );

		$this->set_status( $status );
	}

	private function save_changes( string $state, DateTime $moment, ?string $uuid = null ): void {
		$status = $this->get_status();

		$status->set_state( $state );
		$status->set_last_updated( $moment );
		if ( ! empty( $uuid ) ) {
			$status->set_uuid( $uuid );
		}

		$this->set_status( $status );
	}

	/**
	 * Generates a new UUID that is guaranteed to be unique.
	 *
	 * @return string|void
	 * @throws \Exception Thrown if invalid values are passed do random_bytes(). See https://www.php.net/manual/en/function.random-bytes.php .
	 */
	private function generate_uuid(): string {
		// Generate 16 bytes (128 bits) of random data or use the data passed into the function.
		$data = $data ?? random_bytes( 16 );
		assert( strlen( $data ) === 16 );

		// Set version to 0100.
		$data[6] = chr( ord( $data[6] ) & 0x0f | 0x40 );
		// Set bits 6-7 to 10.
		$data[8] = chr( ord( $data[8] ) & 0x3f | 0x80 );

		// Output the 36 character UUID.
		return vsprintf( '%s%s-%s-%s-%s-%s%s%s', str_split( bin2hex( $data ), 4 ) );
	}
}
