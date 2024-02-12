<?php

namespace Wpe_Content_Engine\Helper\Sync\Batches;

use \Wpe_Content_Engine\Helper\Sync\Batches\Options\Sync_Lock_Status;

interface Sync_Lock_Status_Store_Interface {
	public function get_status(): ?Sync_Lock_Status;
	public function set_status( ?Sync_Lock_Status $status );
}
