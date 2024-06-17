<?php

use WPML\FP\Fns;
use WPML\LIB\WP\Post;
use WPML\Media\Classes\WPML_Media_Element_Translation_Factory;

class WPML_Media_Post_With_Media_Files {

	/**
	 * @var int
	 */
	private $post_id;
	/**
	 * @var WPML_Media_Img_Parse
	 */
	private $media_parser_factory;
	/**
	 * @var WPML_Media_Attachment_By_URL_Factory
	 */
	private $attachment_by_url_factory;
	/**
	 * @var SitePress $sitepress
	 */
	private $sitepress;
	/**
	 * @var WPML_Custom_Field_Setting_Factory
	 */
	private $cf_settings_factory;

	/**
	 * @var \WPML\Media\Classes\WPML_Media_Attachment_By_URL_Query
	 */
	private $mediaAttachmentByURLQuery;

	/**
	 * WPML_Media_Post_With_Media_Files constructor.
	 *
	 * @param $post_id
	 * @param \WPML\Media\Factories\WPML_Media_Element_Parser_Factory $media_parser_factory
	 * @param WPML_Media_Attachment_By_URL_Factory $attachment_by_url_factory
	 * @param SitePress $sitepress
	 * @param WPML_Custom_Field_Setting_Factory $cf_settings_factory
	 * @param \WPML\Media\Factories\WPML_Media_Attachment_By_URL_Query_Factory $mediaAttachmentByURLQueryFactory
	 */
	public function __construct(
		$post_id,
		\WPML\Media\Factories\WPML_Media_Element_Parser_Factory $media_parser_factory,
		WPML_Media_Attachment_By_URL_Factory $attachment_by_url_factory,
		SitePress $sitepress,
		WPML_Custom_Field_Setting_Factory $cf_settings_factory,
		\WPML\Media\Factories\WPML_Media_Attachment_By_URL_Query_Factory $mediaAttachmentByURLQueryFactory
	) {
		$this->post_id                   = $post_id;
		$this->media_parser_factory      = $media_parser_factory;
		$this->attachment_by_url_factory = $attachment_by_url_factory;
		$this->sitepress                 = $sitepress;
		$this->cf_settings_factory       = $cf_settings_factory;
		$this->mediaAttachmentByURLQuery = $mediaAttachmentByURLQueryFactory->create();
	}

	public function get_media_ids() {
		$media_ids = array();

		if ( $post = get_post( $this->post_id ) ) {

			$content_to_parse   = apply_filters( 'wpml_media_content_for_media_usage', $post->post_content, $post );
			$media_parsers       = $this->media_parser_factory->create( $content_to_parse );

			$this->prefetchDataForFutureAttachmentByUrlGetIdCalls( $media_parsers );

			foreach ( $media_parsers as $media_parser ) {
				$media_ids = $this->unique_array_merge( $media_ids, $this->_get_ids_from_media_array( $media_parser, $media_parser->getMediaElements() ) );

				if ( $featured_image = get_post_meta( $this->post_id, '_thumbnail_id', true ) ) {
					$media_ids[] = $featured_image;
				}
			}

			$media_localization_settings = WPML_Media::get_setting( 'media_files_localization' );
			if ( $media_localization_settings['custom_fields'] ) {
				$custom_fields_content = $this->get_content_in_translatable_custom_fields();
				$media_parsers         = $this->media_parser_factory->create( $custom_fields_content );

				foreach ( $media_parsers as $media_parser ) {
					$media_ids = $this->unique_array_merge( $media_ids, $this->_get_ids_from_media_array( $media_parser, $media_parser->getMediaElements() ) );
				}
			}

			if ( $gallery_media_ids = $this->get_gallery_media_ids( $content_to_parse ) ) {
				$media_ids = array_unique( array_values( array_merge( $media_ids, $gallery_media_ids ) ) );
				$media_ids = $this->unique_array_merge( $media_ids, $gallery_media_ids );
			}

			if ( $attached_media_ids = $this->get_attached_media_ids( $this->post_id ) ) {
				$media_ids = $this->unique_array_merge( $media_ids, $attached_media_ids );
			}

		}

		return Fns::filter( Post::get(), apply_filters( 'wpml_ids_of_media_used_in_post', $media_ids, $this->post_id ) );
	}

	/**
	 * @param array $first_array
	 * @param array $second_array
	 *
	 * @return array
	 */
	private function unique_array_merge( $first_array, $second_array) {
		return array_unique( array_values( array_merge( $first_array, $second_array ) ) );
	}

	/**
	 * @param \WPML\Media\Classes\WPML_Media_Element_Parser $media_parser
	 * @param array $media_array
	 *
	 * @return array
	 */
	private function _get_ids_from_media_array( $media_parser, $media_array ) {
		$media_ids = array();
		foreach ( $media_array as $media ) {
			if ( isset( $media['attachment_id'] ) ) {
				$media_ids[] = $media['attachment_id'];
			} else {
				$attachment_by_url = $this->attachment_by_url_factory->create(
					$media_parser->getMediaSrcFromAttributes( $media['attributes'] ),
					wpml_get_current_language(),
					$this->mediaAttachmentByURLQuery
				);
				if ( $attachment_by_url->get_id() ) {
					$media_ids[] = $attachment_by_url->get_id();
				}
			}
		}

		return $media_ids;
	}

	/**
	 * @param WPML_Media_Element_Parser[] $mediaParsers
	 */
	private function prefetchDataForFutureAttachmentByUrlGetIdCalls( $mediaParsers ) {
		$urls = [];
		foreach ( $mediaParsers as $mediaParser ) {
			foreach( $mediaParser->getMediaElements() as $media ) {
				if ( isset( $media['attachment_id'] ) ) {
					continue;
				}

				$urls[] = $mediaParser->getMediaSrcFromAttributes( $media['attributes'] );
			}
		}

		$this->mediaAttachmentByURLQuery->prefetchAllIdsFromGuids(
			wpml_get_current_language(),
			array_merge(
				array_map(
					function( $url ) {
						return WPML_Media_Attachment_By_URL::getUrl( $url );
					},
					$urls
				),
				array_map(
					function( $url ) {
						return WPML_Media_Attachment_By_URL::getUrlNotScaled( $url );
					},
					$urls
				)
			)
		);
		$this->mediaAttachmentByURLQuery->prefetchAllIdsFromMetas(
			wpml_get_current_language(),
			array_merge(
				array_map(
					function( $url ) {
						return WPML_Media_Attachment_By_URL::getUrlRelativePath( $url );
					},
					$urls
				),
				array_map(
					function( $url ) {
						return WPML_Media_Attachment_By_URL::getUrlRelativePathOriginal(
							WPML_Media_Attachment_By_URL::getUrlRelativePath( $url )
						);
					},
					$urls
				),
				array_map(
					function( $url ) {
						return WPML_Media_Attachment_By_URL::getUrlRelativePathScaled( $url );
					},
					$urls
				)
			)
		);
	}

	/**
	 * @param string $post_content
	 *
	 * @return array
	 */
	private function get_gallery_media_ids( $post_content ) {

		$galleries_media_ids     = array();
		$gallery_shortcode_regex = '/\[gallery [^[]*ids=["\']([0-9,\s]+)["\'][^[]*\]/m';
		if ( preg_match_all( $gallery_shortcode_regex, $post_content, $matches ) ) {
			foreach ( $matches[1] as $gallery_ids_string ) {
				$media_ids_array = explode( ',', $gallery_ids_string );
				$media_ids_array = Fns::map( Fns::unary( 'intval' ), $media_ids_array );

				foreach ( $media_ids_array as $media_id ) {
					if ( 'attachment' === get_post_type( $media_id ) ) {
						$galleries_media_ids[] = $media_id;
					}

				}
			}
		}

		return $galleries_media_ids;
	}

	/**
	 * @param $languages
	 *
	 * @return array
	 */
	public function get_untranslated_media( $languages ) {

		$untranslated_media = array();

		$post_media = $this->get_media_ids();

		foreach ( $post_media as $attachment_id ) {

			$post_element = WPML_Media_Element_Translation_Factory::create( $attachment_id );
			foreach ( $languages as $language ) {
				$translation = $post_element->get_translation( $language );
				if ( null === $translation || ! $this->media_file_is_translated( $attachment_id, $translation->get_id() ) ) {
					$untranslated_media[] = $attachment_id;
					break;
				}
			}

		}

		return $untranslated_media;
	}

	private function media_file_is_translated( $attachment_id, $translated_attachment_id ) {
		return get_post_meta( $attachment_id, '_wp_attached_file', true )
		       !== get_post_meta( $translated_attachment_id, '_wp_attached_file', true );
	}

	private function get_content_in_translatable_custom_fields() {
		$content = '';

		$post_meta = get_metadata( 'post', $this->post_id );

		if ( is_array( $post_meta ) ) {
			foreach ( $post_meta as $meta_key => $meta_value ) {
				$setting         = $this->cf_settings_factory->post_meta_setting( $meta_key );
				$is_translatable = $this->sitepress->get_wp_api()
				                                   ->constant( 'WPML_TRANSLATE_CUSTOM_FIELD' ) === $setting->status();
				if ( is_string( $meta_value[0] ) && $is_translatable ) {
					$content .= $meta_value[0];
				}
			}
		}

		return $content;
	}

	private function get_attached_media_ids( $post_id ) {
		$attachments = get_children(
			array(
				'post_parent' => $post_id,
				'post_status' => 'inherit',
				'post_type'   => 'attachment',
			)
		);

		return array_keys( $attachments );
	}
}
