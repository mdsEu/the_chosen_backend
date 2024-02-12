<?php

namespace Wpe_Content_Engine\Helper\Sync\Batches;

use ErrorException;
use WP_CLI;
use WP_User;
use WP_User_Query;
use Wpe_Content_Engine;
use Wpe_Content_Engine\Core_Wp_Wrapper\Wp_Progress_Bar;
use Wpe_Content_Engine\Helper\Constants\Order_By;
use Wpe_Content_Engine\Helper\Progress_Bar_Info_Trait;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\User as User_Entity;

class User implements Batch_Sync_Interface {

	use Progress_Bar_Info_Trait;

	/**
	 * @var User_Entity
	 */
	private User_Entity $sync_user;

	public function __construct( User_Entity $sync_user ) {
		$this->sync_user = $sync_user;
	}

	/**
	 * @param int $offset Offset.
	 * @param int $number Number.
	 * @return WP_User[]
	 */
	public function get_items( $offset, $number ): array {
		$q = array(
			'number'  => $number,
			'paged'   => $offset,
			'orderby' => Order_By::ID,
		);

		$qry = new WP_User_Query( $q );

		return $qry->get_results();
	}

	/**
	 * @param WP_User[] $users Users.
	 *
	 * @throws ErrorException Exception.
	 */
	public function sync( $users ) {
		if ( count( $users ) <= 0 ) {
			return;
		}

		// $progress  = make_progress_bar( '', count( $users ) );
		foreach ( $users as $user ) {
			$this->sync_user->upsert( $user->ID );
			$this->tick();
		}
		$this->finish();
	}

	/**
	 * @param mixed $items Items.
	 * @param mixed $page Page.
	 */
	public function format_items( $items, $page ) {
		$o = array_column( $items, 'ID' );
		WP_CLI::log( WP_CLI::colorize( "%RSyncing WordPress Users - Page:{$page} Ids:" . implode( ',', $o ) . '%n ' ) );
	}

	/**
	 * @return int
	 */
	public function get_total_items(): int {
		$result = count_users();

		return $result['total_users'];
	}
}
