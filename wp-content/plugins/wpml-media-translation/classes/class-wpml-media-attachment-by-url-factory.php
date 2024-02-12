<?php

class WPML_Media_Attachment_By_URL_Factory {

	public function create( $url, $language, \WPML\Media\Classes\WPML_Media_Attachment_By_URL_Query $media_attachment_by_url_query ) {
		global $wpdb;

		return new WPML_Media_Attachment_By_URL( $wpdb, $url, $language, $media_attachment_by_url_query );
	}

}
