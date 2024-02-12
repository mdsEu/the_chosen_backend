<?php

namespace Wpe_Content_Engine\Helper\Notifications;

use Wpe_Content_Engine\Helper\Admin_Notice;
const  WPE_CONTENT_ENGINE_RE_SYNC_HAS_OCCURRED = 'wpe_content_engine_re_sync_has_occurred';

if ( ! function_exists( 'handle_re_sync_notification' ) ) {

	/**
	 * Show notification when option WPE_CONTENT_ENGINE_ASK_TO_RUN_SYNC false.
	 *
	 * @param Admin_Notice $notification Notification.
	 * @return void
	 */
	function handle_re_sync_notification( Admin_Notice $notification ): void {
		if ( ! get_option( WPE_CONTENT_ENGINE_RE_SYNC_HAS_OCCURRED ) ) {
			$notification->add_message( 'Atlas Search plugin: there was an error with Atlas Search. Please head to <a href="admin.php?page=atlas-search-settings&view=sync-data">settings</a> and resync your data now' );
		}
	}
}
