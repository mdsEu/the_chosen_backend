<?php

namespace WPML\Media\Classes;

class WPML_Media_Element_Translation_Factory {

	/**
	 * @param int $mediaId
	 *
	 * @return \WPML_Post_Element
	 */
	public static function create( $mediaId ) {
		/** @var \SitePress $sitepress */
		global $sitepress;

		return ( new \WPML_Translation_Element_Factory( $sitepress ) )->create_post( $mediaId );
	}
}
