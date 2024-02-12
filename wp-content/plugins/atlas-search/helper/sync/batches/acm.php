<?php

namespace Wpe_Content_Engine\Helper\Sync\Batches;

use ErrorException;
use WP_CLI;
use WP_Post;
use WP_Post_Type;
use WP_Query;
use Wpe_Content_Engine;
use Wpe_Content_Engine\Helper\Constants\Post_Status;
use Wpe_Content_Engine\Helper\Progress_Bar_Info_Trait;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\ACM as ACM_Entity;

class ACM implements Batch_Sync_Interface {

	use Progress_Bar_Info_Trait;

	/**
	 * @var ACM_Entity
	 */
	private ACM_Entity $sync_acm;

	public function __construct( ACM_Entity $sync_acm ) {
		$this->sync_acm = $sync_acm;
	}

	/**
	 * @param int   $offset Offset.
	 * @param mixed $number Number.
	 * @param bool  $ignore_sticky_posts Ignore sticky posts.
	 * @return WP_Post_Type[]
	 */
	public function get_items( $offset, $number, $ignore_sticky_posts = true ): array {
		if ( ! ACM_Entity::is_acm_loaded() ) {
			return array();
		}

		$post_types = ACM_Entity::allowed_custom_post_types();

		if ( empty( $post_types ) ) {
			return array();
		}

		$q   = array(
			'post_type'           => $post_types,
			'post_status'         => Post_Status::PUBLISH,
			'posts_per_page'      => $number,
			'paged'               => $offset,
			'ignore_sticky_posts' => $ignore_sticky_posts,
		);
		$qry = new WP_Query( $q );

		return $qry->posts;
	}

	/**
	 * @param WP_Post[] $custom_post_type_posts WordPress custom post types that are flagged to be showed in graphql.
	 *
	 * @throws ErrorException Exception.
	 */
	public function sync( $custom_post_type_posts ) {
		if ( count( $custom_post_type_posts ) <= 0 ) {
			return;
		}

		foreach ( $custom_post_type_posts as $cpt_post ) {
			$this->sync_acm->upsert( $cpt_post->ID, $cpt_post );
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
		WP_CLI::log( WP_CLI::colorize( "%RSyncing Atlas Content Modeler (ACM) Data - Page:{$page} Ids:" . implode( ',', $o ) . '%n ' ) );
	}

	/**
	 * @return int
	 */
	public function get_total_items(): int {
		if ( ! ACM_Entity::is_acm_loaded() ) {
			return 0;
		}

		$post_types = ACM_Entity::allowed_custom_post_types();

		if ( empty( $post_types ) ) {
			return 0;
		}
		$total_number_of_items = 0;
		foreach ( $post_types as $post_type ) {
			$total_number_of_items += wp_count_posts( $post_type )->publish;
		}

		return $total_number_of_items;
	}
}
