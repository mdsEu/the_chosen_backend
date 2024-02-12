<?php

namespace WPML\Media\Classes;

use WPML\FP\Obj;

class WPML_Media_Attachment_By_URL_Query {
	/**
	 * @var wpdb
	 */
	private $wpdb;

	/**
	 * @var array
	 */
	private $id_from_guid_cache = [];

	/**
	 * @var array
	 */
	private $id_from_meta_cache = [];

	/**
	 * @var boolean Used in tests
	 */
	private $was_last_fetch_from_cache = false;

	/**
	 * \WPML\Media\Classes\WPML_Media_Attachment_By_URL_Query constructor.
	 *
	 * @param \wpdb $wpdb
	 */
	public function __construct( \wpdb $wpdb ) {
		$this->wpdb = $wpdb;
	}

	/**
	 * @return boolean
	 */
	public function getWasLastFetchFromCache() {
		return $this->was_last_fetch_from_cache;
	}

	/**
	 * Sometimes multiple rows are returned for one language(language_code field)/url(guid field) or language(language_code field)/relativePath(meta_value field) pair.
	 * We should set only first result in such cases same as with original get_var call, otherwise code with cache will not work in the same way as the original code.
	 * Example: [[post_id = 1, lang = en, url = otgs.com], [post_id = 2, lang = en, url = otgs.com]] => only first entry should be set to cache, second should be ignored.
	 *
	 * @param array  $item
	 * @param string $cache_prop
	 * @param string $item_index_in_cache
	 */
	private function setItemToCache( $item, $cache_prop, $item_index_in_cache ) {
		if ( array_key_exists( $item_index_in_cache, $this->$cache_prop ) ) {
			return;
		}

		$this->{$cache_prop}[$item_index_in_cache] = $item;
	}

	/**
	 * @param array $source_items
	 */
	private function filterItems( $source_items ) {
		return array_values( array_filter( array_unique( $source_items ) ) );
	}

	/**
	 * @param string $language
	 * @param array  $urls
	 */
	public function prefetchAllIdsFromGuids( $language, $urls ) {
		$urls = $this->filterItems( $urls );
		$urls = array_filter( $urls, function( $url ) use ( $language ) {
			$index = md5( $language . $url );
			return ! array_key_exists( $index, $this->id_from_guid_cache );
		} );

		if ( 0 === count( $urls ) ) {
			return;
		}

		$sql  = '';
		$sql .= "SELECT p.ID AS post_id, p.guid, t.language_code FROM {$this->wpdb->posts} p ";
		$sql .= "JOIN {$this->wpdb->prefix}icl_translations t ON t.element_id = p.ID ";
		$sql .= "WHERE t.element_type='post_attachment' AND t.language_code=%s ";
		$sql .= 'AND p.guid IN (' . wpml_prepare_in( $urls ) . ')';

		// phpcs:disable WordPress.WP.PreparedSQL.NotPrepared
		$results = $this->wpdb->get_results( $this->wpdb->prepare( $sql, $language ), ARRAY_A );
		foreach ( $results as $result ) {
			$index = md5( $result['language_code'] . $result['guid'] );
			$this->setItemToCache( $result, 'id_from_guid_cache', $index );
		}

		// We should put not found values into the cache too, otherwise they will be still queried later.
		$urls_count = count( $urls );
		for ( $i = 0; $i < $urls_count; $i++ ) {
			$index = md5( $language . $urls[ $i ] );
			$this->setItemToCache( null, 'id_from_guid_cache', $index );
		}
	}

	/**
	 * @param string $language
	 * @param string $url
	 */
	public function getIdFromGuid( $language, $url ) {
		$this->was_last_fetch_from_cache = false;
		$index                           = md5( $language . $url );
		if ( array_key_exists( $index, $this->id_from_guid_cache ) ) {
			$this->was_last_fetch_from_cache = true;
			return ( $this->id_from_guid_cache[ $index ] ) ? $this->id_from_guid_cache[ $index ]['post_id'] : null;
		}

		$attachment_id = $this->wpdb->get_var(
			// phpcs:disable WordPress.WP.PreparedSQL.NotPrepared
			$this->wpdb->prepare(
				"
					SELECT ID FROM {$this->wpdb->posts} p
					JOIN {$this->wpdb->prefix}icl_translations t ON t.element_id = p.ID
					WHERE t.element_type='post_attachment' AND t.language_code=%s AND p.guid=%s
				",
				$language,
				$url
			)
		);

		return $attachment_id;
	}

	/**
	 * @param string $language
	 * @param array  $pathes
	 */
	public function prefetchAllIdsFromMetas( $language, $pathes ) {
		$pathes = $this->filterItems( $pathes );
		$pathes = array_filter( $pathes, function( $path ) use ( $language ) {
			$index = md5( $language . $path );
			return ! array_key_exists( $index, $this->id_from_meta_cache );
		} );

		if ( 0 === count( $pathes ) ) {
			return;
		}

		$sql  = '';
		$sql .= "SELECT p.post_id, t.language_code, p.meta_value FROM {$this->wpdb->postmeta} p ";
		$sql .= "JOIN {$this->wpdb->prefix}icl_translations t ON t.element_id = p.post_id ";
		$sql .= "WHERE p.meta_key='_wp_attached_file' AND t.element_type='post_attachment' AND t.language_code=%s ";
		$sql .= 'AND p.meta_value IN (' . wpml_prepare_in( $pathes ) . ')';

		// phpcs:disable WordPress.WP.PreparedSQL.NotPrepared
		$results = $this->wpdb->get_results( $this->wpdb->prepare( $sql, $language ), ARRAY_A );
		foreach ( $results as $result ) {
			$index = md5( $result['language_code'] . $result['meta_value'] );
			$this->setItemToCache( $result, 'id_from_meta_cache', $index );
		}

		// We should put not found values into the cache too, otherwise they will be still queried later.
		$pathes_count = count( $pathes );
		for ( $i = 0; $i < $pathes_count; $i++ ) {
			$index = md5( $language . $pathes[ $i ] );
			$this->setItemToCache( null, 'id_from_meta_cache', $index );
		}
	}

	/**
	 * @param string $relative_path
	 * @param string $language
	 */
	public function getIdFromMeta( $relative_path, $language ) {
		$this->was_last_fetch_from_cache = false;
		$index                           = md5( $language . $relative_path );
		if ( array_key_exists( $index, $this->id_from_meta_cache ) ) {
			$this->was_last_fetch_from_cache = true;
			return ( $this->id_from_meta_cache[ $index ] ) ? $this->id_from_meta_cache[ $index ]['post_id'] : null;
		}

		$attachment_id = $this->wpdb->get_var(
			// phpcs:disable WordPress.WP.PreparedSQL.NotPrepared
			$this->wpdb->prepare(
				"
			SELECT post_id 
			FROM {$this->wpdb->postmeta} p 
			JOIN {$this->wpdb->prefix}icl_translations t ON t.element_id = p.post_id 
			WHERE p.meta_key='_wp_attached_file' AND p.meta_value=%s 
				AND t.element_type='post_attachment' AND t.language_code=%s
			",
				$relative_path,
				$language
			)
		);

		return $attachment_id;
	}
}
