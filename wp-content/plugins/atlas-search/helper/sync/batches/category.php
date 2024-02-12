<?php

namespace Wpe_Content_Engine\Helper\Sync\Batches;

use ErrorException;
use WP_CLI;
use WP_Term;
use Wpe_Content_Engine\Helper\Constants\Order;
use Wpe_Content_Engine\Helper\Constants\Order_By;
use Wpe_Content_Engine\Helper\Progress_Bar_Info_Trait;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\Term as Term_Entity;

class Category implements Batch_Sync_Interface {

	use Progress_Bar_Info_Trait;

	/**
	 * @var Term_Entity
	 */
	private Term_Entity $sync_term;

	public function __construct( Term_Entity $sync_term ) {
		$this->sync_term = $sync_term;
	}

	/**
	 * @param mixed $page Page.
	 * @param mixed $number Number.
	 * @return WP_Term[]
	 */
	public function get_items( $page, $number ): array {
		$q = array(
			'hide_empty' => false,
			'number'     => $number,
			'offset'     => ( $page - 1 ) * $number,
			'orderby'    => Order_By::MODIFIED,
			'order'      => Order::ASCENDING,
		);

		return get_categories( $q );
	}

	/**
	 * @param WP_Term[] $categories Categories.
	 *
	 * @throws ErrorException Exception.
	 */
	public function sync( $categories ) {
		if ( count( $categories ) <= 0 ) {
			return;
		}

		/** @var WP_Term $term */
		foreach ( $categories as $category ) {
			$this->sync_term->upsert( $category->term_id, $category->term_taxonomy_id, $category->taxonomy );
			$this->tick();
		}
		$this->finish();
	}

	/**
	 * @param mixed $items Items.
	 * @param mixed $page Page.
	 */
	public function format_items( $items, $page ) {
		$o = array_column( $items, 'term_id' );
		WP_CLI::log( WP_CLI::colorize( "%RSyncing WordPress Categories - Page:{$page} Ids:" . implode( ',', $o ) . '%n ' ) );
	}

	/**
	 * @return int
	 */
	public function get_total_items(): int {
		$q      = array(
			'hide_empty' => false,
			'taxonomy'   => 'category',
		);
		$result = wp_count_terms( $q );

		return ! ( $result instanceof \WP_Error ) ? (int) $result : $this->get_total_items_slow();
	}

	private function get_total_items_slow(): int {
		$q      = array(
			'hide_empty' => false,
		);
		$result = get_categories( $q );

		return ! ( $result instanceof \WP_Error ) ? (int) count( $result ) : 0;
	}
}
