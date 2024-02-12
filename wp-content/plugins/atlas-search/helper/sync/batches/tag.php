<?php

namespace Wpe_Content_Engine\Helper\Sync\Batches;

use ErrorException;
use WP_CLI;
use WP_Term;
use Wpe_Content_Engine;
use Wpe_Content_Engine\Helper\Constants\Order_By;
use Wpe_Content_Engine\Helper\Progress_Bar_Info_Trait;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\Term as Term_Entity;

class Tag implements Batch_Sync_Interface {

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
			'orderby'    => Order_By::ID,
		);

		return get_tags( $q );
	}

	/**
	 * @param WP_Term[] $tags Tags.
	 *
	 * @throws ErrorException Exception.
	 */
	public function sync( $tags ) {
		if ( count( $tags ) <= 0 ) {
			return;
		}

		/** @var WP_Term $tag */
		foreach ( $tags as $tag ) {
			$this->sync_term->upsert( $tag->term_id, $tag->term_taxonomy_id, $tag->taxonomy );
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
		WP_CLI::log( WP_CLI::colorize( "%RSyncing WordPress Tags - Page:{$page} Ids:" . implode( ',', $o ) . '%n ' ) );
	}

	/**
	 * @return int
	 */
	public function get_total_items(): int {
		$q      = array(
			'hide_empty' => false,
			'taxonomy'   => 'post_tag',
		);
		$result = wp_count_terms( $q );

		return ! ( $result instanceof \WP_Error ) ? (int) $result : $this->get_total_items_slow();
	}

	private function get_total_items_slow(): int {
		$q = array(
			'hide_empty' => false,
			'count'      => true,
		);

		$result = get_tags( $q );
		return ! ( $result instanceof \WP_Error ) ? (int) $result : 0;
	}
}
