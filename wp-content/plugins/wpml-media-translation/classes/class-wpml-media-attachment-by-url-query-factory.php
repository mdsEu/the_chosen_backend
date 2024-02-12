<?php

namespace WPML\Media\Factories;

class WPML_Media_Attachment_By_URL_Query_Factory {
	public function create() {
		global $wpdb;

		return new \WPML\Media\Classes\WPML_Media_Attachment_By_URL_Query( $wpdb );
	}
}
