<?php

namespace Wpe_Content_Engine\Helper\Sync\Batches\Options;

class Sync_Lock_Options {
	/**
	 * @var int
	 */
	private $rolling_timeout_expiry_seconds;

	public function __construct( int $rolling_timeout_expiry_seconds = 60 ) {
		$this->rolling_timeout_expiry_seconds = $rolling_timeout_expiry_seconds;
	}

	public function get_rolling_timeout_expiry_seconds(): int {
		return $this->rolling_timeout_expiry_seconds;
	}

	public function set_rolling_timeout_expiry_seconds( int $rolling_timeout_expiry_seconds ): void {
		$this->rolling_timeout_expiry_seconds = $rolling_timeout_expiry_seconds;
	}
}
