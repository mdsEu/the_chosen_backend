<?php

/**
 * Class WPML_Media_Translated_Images_Update
 * Translates images in a given text
 */
class WPML_Media_Translated_Images_Update {

	/**
	 * @var \WPML\Media\Factories\WPML_Media_Element_Parser_Factory
	 */
	private $media_parser_factory;

	/**
	 * @var \WPML_Media_Image_Translate
	 */
	private $image_translator;
	/**
	 * @var \WPML_Media_Sizes
	 */
	private $media_sizes;

	/**
	 * WPML_Media_Translated_Images_Update constructor.
	 *
	 * @param \WPML\Media\Factories\WPML_Media_Element_Parser_Factory $media_parser_factory
	 * @param WPML_Media_Image_Translate                              $image_translator
	 * @param WPML_Media_Sizes                                        $media_sizes
	 */
	public function __construct(
		\WPML\Media\Factories\WPML_Media_Element_Parser_Factory $media_parser_factory,
		WPML_Media_Image_Translate $image_translator,
		WPML_Media_Sizes $media_sizes
	) {
		$this->media_parser_factory = $media_parser_factory;
		$this->image_translator     = $image_translator;
		$this->media_sizes          = $media_sizes;
	}

	/**
	 * @param string $text
	 * @param string $target_language
	 * @param string $source_language
	 *
	 * @return string
	 */
	public function replace_images_with_translations( $text, $target_language, $source_language = null ) {
		$media_parsers = $this->media_parser_factory->create( $text );

		// We have original and translated attachment IDs already saved in the $_POST variable.
		// So I started using them instead of grabbing them again.
		// phpcs:disable WordPress.CSRF.NonceVerification.NoNonceVerification
		$attachment_id = isset( $_POST['original-attachment-id'] ) ? $_POST['original-attachment-id'] : null;
		$translated_id = isset( $_POST['translated-attachment-id'] ) ? $_POST['translated-attachment-id'] : null;

		$pre_update_translated_media_guid = isset( $_POST['pre-update-translated-media-guid'] ) ? $_POST['pre-update-translated-media-guid'] : '';

		/**
		 * Checks if media src in post content (not updated yet) is equal to old media that was uploaded but now its guid replaced in database.
		 *
		 * @param $media_src
		 *
		 * @return bool
		 */
		$media_src_same_as_pre_update = function ( $media_src ) use ( $pre_update_translated_media_guid ) {
			return $media_src === $pre_update_translated_media_guid;
		};

		/**
		 * Checks if media src in post content (not updated yet) contains old media that was uploaded but now its guid replaced in database.
		 *
		 * @param $media_src
		 *
		 * @return bool
		 */
		$media_src_contains_pre_update = function ( $media_src ) use ( $pre_update_translated_media_guid ) {
			$thumb_file_name                   = basename( $pre_update_translated_media_guid );
			$pre_update_translated_media_parts = explode( '.', $thumb_file_name );

			$media_src_extension                   = pathinfo( $media_src, PATHINFO_EXTENSION );
			$pre_update_translated_media_extension = is_array( $pre_update_translated_media_parts ) ? end( $pre_update_translated_media_parts ) : null;

			return $pre_update_translated_media_parts[0] && false !== strpos( $media_src, $pre_update_translated_media_parts[0] ) && $media_src_extension === $pre_update_translated_media_extension;
		};

		if ( ! empty( $media_parsers ) ) {
			$items_to_translate = [];
			foreach ( $media_parsers as $media_parser ) {
				$media_items = $media_parser->getMediaElements();

				foreach ( $media_items as $media ) {
					$media_src           = $media_parser->getMediaSrcFromAttributes( $media['attributes'] );
					$original_media_guid = isset( $attachment_id ) ? $this->getSizedOriginalMediaGuid( $attachment_id, $source_language ) : $media_src;

					// This if condition checks that the value for media GUID saved in $_POST is same as media subject to get updated.
					// OR if the media src is equal to original src (in case of translated post contains same already uploaded media) so media that exists will be replaced with the translated one.
					if (
						( $media_src_same_as_pre_update( $media_src ) || $media_src_contains_pre_update( $media_src ) ) || ( $media_src === $original_media_guid )
					) {
						$items_to_translate[] = [
							'attachment_id'   => $attachment_id,
							'translated_id'   => $translated_id,
							'media'           => $media,
							'mediaParser'     => $media_parser,
							'mediaSrc'        => $media_src,
							'target_language' => $target_language,
						];
					} else { // to handle reverting media to original.
						if ( empty( $pre_update_translated_media_guid ) && $this->mediaSrcContainsMediaFileName( $translated_id, $media_src ) ) {
							$text = $this->replace_image_src( $text, $media_src, $original_media_guid );
							$text = $this->replace_att_class( $text, $translated_id, $attachment_id );
							$text = $this->replace_att_in_block( $text, $translated_id, $attachment_id );
						}
					}
				}
			}

			$this->image_translator->prefetchDataForFutureGetTranslatedImageCalls(
				$this->getSourceLanguage( $source_language ),
				array_map(
					function( $source_item ) {
						$item        = $source_item;
						$item['url'] = $this->getMediaParserImgSrc( $item['mediaParser'], $item['media'] );

						return $item;
					},
					$items_to_translate
				)
			);

			foreach ( $items_to_translate as $item_to_translate ) {
				$attachment_id   = $item_to_translate['attachment_id'];
				$translated_id   = $item_to_translate['translated_id'];
				$media           = $item_to_translate['media'];
				$media_parser    = $item_to_translate['mediaParser'];
				$media_src       = $item_to_translate['mediaSrc'];
				$target_language = $item_to_translate['target_language'];

				if ( isset( $attachment_id ) && $attachment_id ) {
					$size           = $this->media_sizes->get_attachment_size( $media );
					$translated_src = $this->image_translator->get_translated_image( $attachment_id, $target_language, $size );
				} else {
					$translated_src = $this->get_translated_image_by_url( $media_parser, $target_language, $source_language, $media );
				}

				if ( $translated_src ) {
					if ( $translated_src !== $media_src ) {
						$text = $this->replace_image_src( $text, $media_src, $translated_src );
					}

					// to replace value in href if it couldn't be replaced in replace_image_src.
					$text = $this->replaceAttributeInHref( $text, $media_src, $translated_src, $source_language );
				}
				if ( $attachment_id && $attachment_id !== $translated_id ) {
					$text = $this->replace_att_class( $text, $attachment_id, $translated_id );
					$text = $this->replace_att_in_block( $text, $attachment_id, $translated_id );
				}
			}
		}

		return $text;
	}

	private function getMediaGuid( $id ) {
		return get_post_field( 'guid', $id );
	}

	private function mediaSrcContainsMediaFileName( $attachment_id, $media_src ) {
		$guid            = $this->getMediaGuid( $attachment_id );
		$media_extension = substr( $guid, - 4 );
		$media_filename  = explode( $media_extension, basename( $guid ) )[0];

		return \WPML\FP\Str::includes( $media_filename, $media_src );
	}

	private function getSizedOriginalMediaGuid( $attachment_id, $source_lang ) {
		$original_media_guid = $this->getMediaGuid( $attachment_id );
		$original_media_size = $this->media_sizes->get_image_size_from_url( $original_media_guid, $attachment_id );

		return $this->image_translator->get_translated_image( $attachment_id, $source_lang, $original_media_size );
	}

	/**
	 * @param string $text
	 * @param string $from
	 * @param string $to
	 *
	 * @return string
	 */
	private function replace_image_src( $text, $from, $to ) {
		return str_replace( $from, $to, $text );
	}

	/**
	 * @param string $text
	 * @param string $from
	 * @param string $to
	 *
	 * @return string
	 */
	private function replace_att_class( $text, $from, $to ) {
		$pattern     = '/\bwp-image-' . $from . '\b/u';
		$replacement = 'wp-image-' . $to;

		return preg_replace( $pattern, $replacement, $text );
	}

	/**
	 * @param string $text
	 * @param string $from
	 * @param string $to
	 *
	 * @return string
	 */
	private function replace_att_in_block( $text, $from, $to ) {
		$pattern = '';

		$blocks = [ 'wp:image', 'wp:file', 'wp:audio', 'wp:video' ];
		foreach ( $blocks as $block ) {
			if ( \WPML\FP\Str::startsWith( '<!-- ' . $block, $text ) ) {
				// phpcs:disable Generic.Strings.UnnecessaryStringConcat.Found
				$pattern = '/<!-- ' . $block . ' ' . '{.*?"id":(' . $from . '),.*?-->/u';
			}
		}

		$replacement = function ( $matches ) use ( $to ) {
			return str_replace( '"id":' . $matches[1], '"id":' . $to, $matches[0] );
		};

		return (bool) strlen( $pattern ) ? preg_replace_callback( $pattern, $replacement, $text ) : $text;
	}

	/**
	 * Replaces value in href for classic images and files added in classic editor
	 *
	 * @param string $text
	 * @param string $from
	 * @param string $to
	 * @param string $source_lang
	 *
	 * @return array|string|string[]|null
	 */
	private function replaceAttributeInHref( $text, $from, $to, $source_lang ) {
		$pattern = '/<a.*?href="(.*?)".*?>/u';

		$attach_id = $this->image_translator->get_attachment_id_by_url( $from, $source_lang );
		$from      = get_post_field( 'guid', $attach_id );

		$replacement = function ( $matches ) use ( $from, $to ) {
			return str_replace( 'href="' . $from . '"', 'href="' . $to . '"', $matches[0] );
		};

		return preg_replace_callback( $pattern, $replacement, $text );
	}

	/**
	 * @param null|string $source_language
	 *
	 * @return string
	 */
	private function getSourceLanguage( $source_language ) {
		if ( null === $source_language ) {
			$source_language = wpml_get_current_language();
		}

		return $source_language;
	}

	/**
	 * @param WPML_Media_Element_Parser $media_parser
	 * @param array                     $img
	 *
	 * @return string
	 */
	private function getMediaParserImgSrc( $media_parser, $img ) {
		return $media_parser->getMediaSrcFromAttributes( $img['attributes'] );
	}

	/**
	 * @param WPML_Media_Element_Parser $media_parser
	 * @param string                    $target_language
	 * @param string                    $source_language
	 * @param array                     $img
	 *
	 * @return bool|string
	 */
	private function get_translated_image_by_url( $media_parser, $target_language, $source_language, $img ) {
		$source_language = $this->getSourceLanguage( $source_language );
		$translated_src  = $this->image_translator->get_translated_image_by_url(
			$this->getMediaParserImgSrc( $media_parser, $img ),
			$source_language,
			$target_language
		);

		return $translated_src;
	}

}
