<?php

class WPML_Media_Attachment_By_URL {

	/**
	 * @var wpdb
	 */
	private $wpdb;

	/**
	 * @var string
	 */
	private $url;

	/**
	 * @var string
	 */
	private $language;

	/**
	 * @var \WPML\Media\Classes\WPML_Media_Attachment_By_URL_Query
	 */
	private $media_attachment_by_url_query;

	const SIZE_SUFFIX_REGEXP = '/-([0-9]+)x([0-9]+)\.([a-z]{3,4})$/';

	const CACHE_KEY_PREFIX = 'attachment-id-from-guid-';
	const CACHE_GROUP      = 'wpml-media-setup';
	const CACHE_EXPIRATION = 1800;

	/** @var null|boolean */
	public $cache_hit_flag = null;

	/**
	 * WPML_Media_Attachment_By_URL constructor.
	 *
	 * @param wpdb                                                   $wpdb
	 * @param string                                                 $url
	 * @param string                                                 $language
	 * @param \WPML\Media\Classes\WPML_Media_Attachment_By_URL_Query $media_attachment_by_url_query
	 */
	public function __construct(
		wpdb $wpdb,
		$url,
		$language,
		\WPML\Media\Classes\WPML_Media_Attachment_By_URL_Query $media_attachment_by_url_query
	) {
		$this->url                           = $url;
		$this->language                      = $language;
		$this->wpdb                          = $wpdb;
		$this->media_attachment_by_url_query = $media_attachment_by_url_query;
	}

	/**
	 * @param string $url
	 *
	 * @return string
	 */
	public static function getUrl( $url ) {
		$url = preg_replace( self::SIZE_SUFFIX_REGEXP, '.$3', $url );

		return $url;
	}

	/**
	 * @param string $url
	 *
	 * @return string
	 */
	public static function getUrlNotScaled( $url ) {
		$url = preg_replace( self::SIZE_SUFFIX_REGEXP, '.$3', $url );
		$url = str_replace( '-scaled', '', $url );

		return $url;
	}

	/**
	 * @param string $url
	 *
	 * @return string
	 */
	public static function getUrlRelativePath( $url ) {
		$uploads_dir   = wp_get_upload_dir();
		$relative_path = ltrim( preg_replace( '@^' . $uploads_dir['baseurl'] . '@', '', $url ), '/' );

		return $relative_path;
	}

	/**
	 * @param string $relative_path
	 *
	 * @return string
	 */
	public static function getUrlRelativePathOriginal( $relative_path ) {
		return preg_replace( self::SIZE_SUFFIX_REGEXP, '.$3', $relative_path );
	}

	/**
	 * @param string $url
	 *
	 * @return string
	 */
	public static function getUrlRelativePathScaled( $url ) {
		$relative_path = self::getUrlRelativePath( $url );
		$relative_path = str_replace( '-scaled', '', $relative_path );
		$relative_path = preg_replace( '/(\.[^.]+)$/', '-scaled$1', $relative_path );

		return $relative_path;
	}

	public function get_id() {
		if ( ! $this->url ) {
			return 0;
		}

		$cache_key = self::CACHE_KEY_PREFIX . md5( $this->language . '#' . $this->url );

		$attachment_id = wp_cache_get( $cache_key, self::CACHE_GROUP, false, $this->cache_hit_flag );
		if ( ! $this->cache_hit_flag ) {
			$attachment_id = $this->get_id_from_guid();
			if ( ! $attachment_id ) {
				$attachment_id = $this->get_id_from_meta();
			}

			wp_cache_add( $cache_key, $attachment_id, self::CACHE_GROUP, self::CACHE_EXPIRATION );
		}

		return $attachment_id;
	}

	private function get_id_from_guid() {
		$attachment_id = $this->media_attachment_by_url_query->getIdFromGuid( $this->language, $this->url );
		if ( ! $attachment_id ) {
			$attachment_id = $this->media_attachment_by_url_query->getIdFromGuid( $this->language, self::getUrlNotScaled( $this->url ) );
		}

		return $attachment_id;
	}

	private function get_id_from_meta() {
		$relative_path        = self::getUrlRelativePath( $this->url );
		$relative_path_scaled = self::getUrlRelativePathScaled( $this->url );

		// Using _wp_attached_file.
		$attachment_id = $this->media_attachment_by_url_query->getIdFromMeta( $relative_path, $this->language );
		if ( ! $attachment_id ) {
			$attachment_id = $this->media_attachment_by_url_query->getIdFromMeta( $relative_path_scaled, $this->language );
		}

		// Using attachment meta (fallback).
		if ( ! $attachment_id && preg_match( self::SIZE_SUFFIX_REGEXP, $relative_path ) ) {
			$attachment_id = $this->get_attachment_image_from_meta_fallback( $relative_path );
		}

		return $attachment_id;
	}

	private function get_attachment_image_from_meta_fallback( $relative_path ) {
		$attachment_id = null;

		$relative_path_original = self::getUrlRelativePathOriginal( $relative_path );
		$attachment_id_original = $this->media_attachment_by_url_query->getIdFromMeta( $relative_path_original, $this->language );

		// Validate size.
		if ( $attachment_id_original ) {
			$attachment_meta_data = wp_get_attachment_metadata( $attachment_id_original );
			if ( $this->validate_image_size( $relative_path, $attachment_meta_data ) ) {
				$attachment_id = $attachment_id_original;
			}
		}

		return $attachment_id;
	}

	private function validate_image_size( $path, $attachment_meta_data ) {
		$valid     = false;
		$file_name = basename( $path );

		foreach ( $attachment_meta_data['sizes'] as $size ) {
			if ( $file_name === $size['file'] ) {
				$valid = true;
				break;
			}
		}

		return $valid;
	}

}
