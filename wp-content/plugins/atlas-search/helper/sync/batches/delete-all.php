<?php

namespace Wpe_Content_Engine\Helper\Sync\Batches;

use ErrorException;
use WP_CLI;
use Wpe_Content_Engine;
use Wpe_Content_Engine\Helper\Progress_Bar_Info_Trait;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\Delete_All as Delete_All_Entity;

class Delete_All implements Batch_Sync_Interface {

	use Progress_Bar_Info_Trait;

	/**
	 * @var Delete_All_Entity
	 */
	private Delete_All_Entity $delete_all;

	public function __construct( Delete_All_Entity $delete_all ) {
		$this->delete_all = $delete_all;
	}

	/**
	 * @param int   $offset Offset.
	 * @param mixed $number Number.
	 * @return array
	 */
	public function get_items( $offset, $number ): array {

		return array( 'delete all' );
	}

	/**
	 * @param array $items Just a dummy parameter that is not used in this case.
	 *
	 * @throws ErrorException Exception.
	 */
	public function sync( $items ) {
		$this->delete_all->delete();
		$this->tick();
		$this->finish();
	}

	/**
	 * @param mixed $items Items.
	 * @param mixed $page Page.
	 */
	public function format_items( $items, $page ) {
		WP_CLI::log( WP_CLI::colorize( '%RAtlas Search data cleared successfully.%n ' ) );
	}

	/**
	 * @return int
	 */
	public function get_total_items(): int {
		return 0;
	}
}
