<?php

namespace Wpe_Content_Engine\Helper\Sync\Batches;

use ErrorException;
use WP_CLI;
use WP_Query;
use WP_Post;
use Wpe_Content_Engine\Helper\Acf_Support\Acf_Factory;
use Wpe_Content_Engine\Helper\Constants\Order;
use Wpe_Content_Engine\Helper\Constants\Order_By;
use Wpe_Content_Engine\Helper\Constants\Post_Status;
use Wpe_Content_Engine\Helper\Constants\Post_Type;
use Wpe_Content_Engine\Helper\Progress_Bar_Info_Trait;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\Post as Post_Entity;

class Page implements Batch_Sync_Interface {

	use Progress_Bar_Info_Trait;

	/**
	 * @var Post_Entity
	 */
	private Post_Entity $sync_page;

	public function __construct( Post_Entity $sync_page ) {
		$this->sync_page = $sync_page;
	}

	/**
	 * @param int   $offset Offset.
	 * @param mixed $number Offset.
	 * @return WP_Post[]
	 */
	public function get_items( $offset, $number ): array {
		$q   = array(
			'post_type'           => array( Post_Type::PAGE ),
			'post_status'         => Post_Status::PUBLISH,
			'posts_per_page'      => $number,
			'paged'               => $offset,
			'ignore_sticky_posts' => true,
			'orderby'             => Order_By::MODIFIED,
			'order'               => Order::ASCENDING,
		);
		$qry = new WP_Query( $q );

		return $qry->posts;
	}

	/**
	 * @param WP_Post[] $pages Pages.
	 *
	 * @throws ErrorException Exception.
	 */
	public function sync( $pages ) {
		if ( count( $pages ) <= 0 ) {
			return;
		}

		foreach ( $pages as $page ) {
			$acf_info = Acf_Factory::build_acf_helper_for_type( $page->ID, $page->post_type );
			$this->sync_page->upsert( $page->ID, $page, $acf_info );
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
		WP_CLI::log( WP_CLI::colorize( "%RSyncing WordPress Pages - Page:{$page} Ids:" . implode( ',', $o ) . '%n ' ) );
	}

	/**
	 * @return int
	 */
	public function get_total_items(): int {
		return wp_count_posts( Post_Type::PAGE )->publish;
	}
}
