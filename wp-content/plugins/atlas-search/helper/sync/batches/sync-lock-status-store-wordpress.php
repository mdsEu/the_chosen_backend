<?php

namespace Wpe_Content_Engine\Helper\Sync\Batches;

use \Wpe_Content_Engine\Helper\Sync\Batches\Options\Sync_Lock_Status;

class Sync_Lock_Status_Store_WordPress implements Sync_Lock_Status_Store_Interface {

	public function get_status(): ?Sync_Lock_Status {
		$deserialized = get_option( Sync_Lock_Status::OPTIONS_WPE_ATLAS_SEARCH_SYNC_STATUS, new Sync_Lock_Status() );
		if ( empty( $deserialized ) || ! ( $deserialized instanceof Sync_Lock_Status ) ) {
			// we cannot get a value for this.
			return null;
		}
		return $deserialized;
	}

	/**
	 * @param Sync_Lock_Status|null $status Lock status.
	 *
	 * @return void
	 */
	public function set_status( ?Sync_Lock_Status $status ) {
		update_option( Sync_Lock_Status::OPTIONS_WPE_ATLAS_SEARCH_SYNC_STATUS, $status );
	}

	public function clear_status() {
		delete_option( Sync_Lock_Status::OPTIONS_WPE_ATLAS_SEARCH_SYNC_STATUS );
	}
}
