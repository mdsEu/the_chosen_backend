<?php

namespace Wpe_Content_Engine\Helper\Sync\Entity\Wordpress;

use Wpe_Content_Engine\Helper\Client_Interface;
use Wpe_Content_Engine\Settings_Interface;

abstract class WP_Entity {

	/**
	 * @var Client_Interface $client
	 */
	protected $client;

	/**
	 * @var Settings_Interface $settings
	 */
	protected $settings;

	public function __construct( Client_Interface $client, Settings_Interface $settings ) {
		$this->client   = $client;
		$this->settings = $settings;
	}
}
