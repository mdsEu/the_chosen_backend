<?php

/**
 * Class WPML_Media_Attachment_Image_Update
 * Allows adding a custom image to a translated attachment
 */
class WPML_Media_Attachment_Image_Update implements IWPML_Action {

	const TRANSIENT_FILE_UPLOAD_PREFIX = 'wpml_media_file_update_';

	/**
	 * @var wpdb
	 */
	private $wpdb;

	/**
	 * WPML_Media_Attachment_Image_Update constructor.
	 *
	 * @param wpdb $wpdb
	 */
	public function __construct( wpdb $wpdb ) {
		$this->wpdb = $wpdb;
	}

	public function add_hooks() {
		add_action( 'wp_ajax_wpml_media_upload_file', array( $this, 'handle_upload' ) );
	}

	public function handle_upload() {
		if ( $this->is_valid_action() ) {

			$original_attachment_id = (int) $_POST['original-attachment-id'];
			$attachment_id          = (int) $_POST['attachment-id'];
			$file_array             = $_FILES['file'];
			$target_language        = $_POST['language'];

			$thumb_path = '';
			$thumb_url  = '';

			$upload_overrides = apply_filters( 'wpml_media_wp_upload_overrides', array( 'test_form' => false ) );
			$file             = wp_handle_upload( $file_array, $upload_overrides );

			if ( ! isset( $file['error'] ) ) {

				if ( wp_image_editor_supports( array( 'mime_type' => $file['type'] ) ) ) {

					$editor = wp_get_image_editor( $file['file'] );
					if ( ! is_wp_error( $editor ) ) {

						if ( 'application/pdf' === $file['type'] || stripos( $file['type'], 'video' ) !== false ) {
							$dirname      = dirname( $file['file'] ) . '/';
							$ext          = pathinfo( $file['file'], PATHINFO_EXTENSION );
							$preview_file = $dirname . wp_unique_filename( $dirname, wp_basename( $file['file'], '.' . $ext ) . "-{$ext}.jpg" );

							$editor->save( $preview_file, 'image/jpeg' );

							$thumb = $this->resize_thumbnail( $editor );

							$attachment_metadata = wp_get_attachment_metadata( $attachment_id );

							$attachment_size = [
								'file'      => basename( $preview_file ),
								'width'     => $thumb['width'],
								'height'    => $thumb['height'],
								'mime-type' => 'image/jpeg',
							];

							$attachment_metadata['sizes']['thumbnail'] = $attachment_size;
							$attachment_metadata['sizes']['full']      = $attachment_size;

							wp_update_attachment_metadata( $attachment_id, $attachment_metadata );

						} else {
							$thumb = $this->resize_thumbnail( $editor );
						}

						if ( ! is_wp_error( $thumb ) ) {
							$uploads_dir = wp_get_upload_dir();

							$thumb_url  = $uploads_dir['baseurl'] . $uploads_dir['subdir'] . '/' . $thumb['file'];
							$thumb_path = $thumb['path'];
						}
					} else {
						$thumb_url = wp_mime_type_icon( $file['type'] );

						if ( $thumb_url ) {
							$thumb_path = $file['file'];
						} else {
							wp_send_json_error( __( 'Failed to load the image editor', 'wpml-media' ) );
						}
					}
				} elseif ( 0 === strpos( $file['type'], 'image/' ) ) {
					$thumb_url  = $file['url'];
					$thumb_path = $file['file'];
				} else {
					$thumb_url = wp_mime_type_icon( $original_attachment_id );
				}

				set_transient(
					self::TRANSIENT_FILE_UPLOAD_PREFIX . $original_attachment_id . '_' . $target_language,
					array(
						'upload' => $file,
						'thumb'  => $thumb_path,
					),
					HOUR_IN_SECONDS
				);

				wp_send_json_success(
					array(
						'attachment_id' => $attachment_id,
						'thumb'         => $thumb_url,
						'name'          => basename( $file['file'] ),
					)
				);

			} else {
				wp_send_json_error( $file['error'] );
			}
		} else {
			wp_send_json_error( 'invalid action' );
		}
	}

	/**
	 * Resize the thumbnail if it is larger than the settings size
	 *
	 * @param WP_Image_Editor $editor
	 * @return array|WP_Error
	 */
	private function resize_thumbnail( $editor ) {

		$size = $editor->get_size();
		if ( $size['width'] > get_option( 'thumbnail_size_w' ) || $size['height'] > get_option( 'thumbnail_size_h' ) ) {
			$resizing = $editor->resize( get_option( 'thumbnail_size_w' ), get_option( 'thumbnail_size_h' ), true );
			if ( is_wp_error( $resizing ) ) {
				wp_send_json_error( $resizing->get_error_message() );
			}
		}

		return $editor->save();
	}

	private function is_valid_action() {
		$is_attachment_id = isset( $_POST['attachment-id'] );
		$is_post_action   = isset( $_POST['action'] ) && 'wpml_media_upload_file' === $_POST['action'];

		return $is_attachment_id && $is_post_action && wp_verify_nonce( $_POST['wpnonce'], 'media-translation' );
	}

}
