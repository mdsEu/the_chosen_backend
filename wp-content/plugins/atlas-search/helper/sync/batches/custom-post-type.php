<?php

namespace Wpe_Content_Engine\Helper\Sync\Batches;

use ErrorException;
use WP_CLI;
use WP_Post;
use WP_Post_Type;
use WP_Query;
use Wpe_Content_Engine;
use Wpe_Content_Engine\Core_Wp_Wrapper\Wp_Progress_Bar;
use Wpe_Content_Engine\Helper\Acf_Support\Acf_Factory;
use Wpe_Content_Engine\Helper\Constants\Post_Status;
use Wpe_Content_Engine\Helper\Constants\Post_Type;
use Wpe_Content_Engine\Helper\Progress_Bar_Info_Trait;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\Custom_Post_Type as Custom_Post_Type_Entity;

class Custom_Post_Type implements Batch_Sync_Interface {

	use Progress_Bar_Info_Trait;

	/**
	 * @var Custom_Post_Type_Entity
	 */
	private Custom_Post_Type_Entity $sync_cpt;

	public function __construct( Custom_Post_Type_Entity $sync_cpt ) {
		$this->sync_cpt = $sync_cpt;
	}

	/**
	 * @param int   $offset Offset.
	 * @param mixed $number Offset.
	 * @return WP_Post_Type[]
	 */
	public function get_items( $offset, $number ): array {
		$post_types = Custom_Post_Type_Entity::allowed_custom_post_types();

		if ( empty( $post_types ) ) {
			return array();
		}

		$q   = array(
			'post_type'           => $post_types,
			'post_status'         => Post_Status::PUBLISH,
			'posts_per_page'      => $number,
			'paged'               => $offset,
			'ignore_sticky_posts' => true,
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
			$acf_info = Acf_Factory::build_acf_helper_for_type( $cpt_post->ID, $cpt_post->post_type );
			$this->sync_cpt->upsert( $cpt_post->ID, $cpt_post, $acf_info );
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
		WP_CLI::log( WP_CLI::colorize( "%RSyncing Custom Post Type Data - Page:{$page} Ids:" . implode( ',', $o ) . '%n ' ) );
	}

	/**
	 * @return int
	 */
	public function get_total_items(): int {
		$post_types = Custom_Post_Type_Entity::allowed_custom_post_types();
		if ( empty( $post_types ) ) {
			return 0;
		}
		$total_items = 0;
		foreach ( $post_types as $post_type ) {
			$total_items += (int) wp_count_posts( $post_type )->publish;
		}

		return $total_items;
	}
}
