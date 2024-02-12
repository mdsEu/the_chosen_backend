<?php

namespace Wpe_Content_Engine\Helper;

/**
 * Class Admin_Notice
 *
 * @package Wpe_Content_Engine\Helper
 */
class Admin_Notice {

	/**
	 * @var string Transient name
	 */
	public const CONTENT_ENGINE_ADMIN_NOTICE = 'content_engine_admin_notice';

	private $current_user_key;

	/**
	 * @var int
	 */
	private const DEFAULT_EXPIRATION_TIME_IN_SECONDS = 5;
	/**
	 * @var string
	 */
	public string $notice_type;

	public function __construct( $notice_type = 'error' ) {
		$this->current_user_key = self::CONTENT_ENGINE_ADMIN_NOTICE . '_' . $this->get_current_user_id();
		$this->notice_type      = $notice_type;
	}

	/**
	 * @param array $messages Messages for admin page.
	 */
	public function set_messages( array $messages ): void {
		set_transient( $this->current_user_key, $messages, self::DEFAULT_EXPIRATION_TIME_IN_SECONDS );
		set_transient( "$this->current_user_key-notice-type", $this->notice_type, self::DEFAULT_EXPIRATION_TIME_IN_SECONDS );
	}

	/**
	 * Adds a message to notification array.
	 *
	 * @param string $message Message to be added.
	 * @return void
	 */
	public function add_message( string $message ): void {
		$this->set_messages( array_unique( array( ...$this->get_messages(), $message ) ) );
	}

	/**
	 * @return array
	 */
	public function get_messages(): array {
		$messages = get_transient( $this->current_user_key );
		if ( empty( $messages ) ) {
			return array();
		}

		return $messages;
	}

	public function delete_messages(): void {
		delete_transient( $this->current_user_key );
		delete_transient( "$this->current_user_key-notice-type" );
	}

	/**
	 * @param array $messages Messages for admin page.
	 * @return string
	 */
	public function get_html( array $messages ): string {
		if ( empty( $messages ) ) {
			return '';
		}
		$error_html = '';
		foreach ( $messages as $message ) {
			$error_html .= "<p>{$message}.</p>\n";
		}

		$notice_type = get_transient( "$this->current_user_key-notice-type" );

		return "<div class=\"notice notice-$notice_type is-dismissible\">{$error_html}</div>";
	}

	public function show_messages(): void {
		$messages = $this->get_messages();
		if ( empty( $messages ) ) {
			return;
		}
		// @codingStandardsIgnoreLine
		echo $this->get_html( $messages );

		$this->delete_messages();
	}

	/**
	 * Tried to use get_current_user_id() but there were some cases that this function hasnt been loaded yet
	 *
	 * @return int
	 */
	private function get_current_user_id(): int {
		if ( ! function_exists( 'wp_get_current_user' ) ) {
			require_once ABSPATH . 'wp-includes/pluggable.php';
		}
		wp_cookie_constants();

		return ( wp_get_current_user() )->ID;
	}
}
