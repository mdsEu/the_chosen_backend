<?php

namespace Wpe_Content_Engine\Helper;

use Wpe_Content_Engine\Helper\Constants\Post_Status;

class Data_Life_Cycle {

	/**
	 * @param string $wp_post_status WordPress post_status field.
	 * @param string $wp_post_password WordPress post_password field.
	 *
	 * @return string Content Engine mapped status.
	 */
	public static function map_status( string $wp_post_status, string $wp_post_password ): string {

		return ( Post_Status::PUBLISH === $wp_post_status && empty( $wp_post_password ) ) ? Post_Status::PUBLISH : Post_Status::UNPUBLISH;
	}
}
