<?php

namespace Wpe_Content_Engine\Helper\API\Sync_Data;

use Wpe_Content_Engine;

/**
 * Settings controller allowing getting and setting of
 * Atlas search settings
 */
class Response {
	public string $status;
	public int $progress;
	public ?string $message;
	public ?string $uuid;

	public function __construct( string $status, int $progress, ?string $message = null, ?string $uuid = null ) {
		$this->status   = $status;
		$this->progress = $progress;
		if ( empty( $message ) ) {
			unset( $this->message );
		} else {
			$this->message = $message;
		}
		if ( empty( $uuid ) ) {
			$this->uuid = '';
		} else {
			$this->uuid = $uuid;
		}
	}
}


