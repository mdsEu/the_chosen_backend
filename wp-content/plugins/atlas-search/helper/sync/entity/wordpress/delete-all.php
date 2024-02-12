<?php

namespace Wpe_Content_Engine\Helper\Sync\Entity\Wordpress;

use ErrorException;
use Wpe_Content_Engine\Helper\Logging\Server_Log_Info;
use Wpe_Content_Engine\WPSettings;

class Delete_All extends WP_Entity {
	/**
	 * @throws ErrorException Exception.
	 */
	public function delete() {
		$query = <<<'GRAPHQL'
			mutation ResetSyncedData {
				resetSyncedData {
					status
					message
				}
			}
		GRAPHQL;

		$graphql_vars               = array();
		$wpe_content_engine_options = $this->settings->get( WPSettings::WPE_CONTENT_ENGINE_OPTION_NAME );

		$this->client->query(
			$wpe_content_engine_options['url'],
			$query,
			$graphql_vars,
			$wpe_content_engine_options['access_token'],
			( new Server_Log_Info() )->get_data()
		);
	}
}
