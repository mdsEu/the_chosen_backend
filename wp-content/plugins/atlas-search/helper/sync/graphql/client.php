<?php
/**
 * The graphql-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wpe_Content_Engine
 * @subpackage Wpe_Content_Engine/admin
 */

namespace Wpe_Content_Engine\Helper\Sync\GraphQL;

use Wpe_Content_Engine\Helper\Client_Interface;
use Wpe_Content_Engine\Helper\Logging\Debug_Logger;
use Wpe_Content_Engine\Helper\Exceptions\AtlasUrlNotSetException;

class Client implements Client_Interface {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * @param string      $endpoint Endpoint URI.
	 * @param string      $query Query string.
	 * @param array       $variables Query string variables.
	 * @param string|null $token Access Token.
	 * @param array|null  $log_info Log info that we want the server to log.
	 *
	 * @return array
	 * @throws \ErrorException Throws error Exception.
	 * @throws AtlasUrlNotSetException Throws error Exception.
	 */
	public function query( string $endpoint, string $query, array $variables = array(), ?string $token = null, $log_info = array() ): array {

		if ( empty( $endpoint ) ) {
			throw new AtlasUrlNotSetException( 'Atlas Search URL must be set.' );
		}

		$headers = array(
			'Content-Type'           => 'application/json',
			'X-CONTENT-ENGINE-AGENT' => "{$this->plugin_name}/{$this->version}",
		);
		if ( null !== $token ) {
			$headers['Authorization'] = "Bearer $token";
		}

		if ( ! empty( $log_info ) ) {
			$headers['X-CONTENT-ENGINE-LOG-INFO'] = json_encode( $log_info );
		}

		$response = wp_remote_post(
			$endpoint,
			array(
				'headers'       => $headers,
				'timeout'       => 20,
				'ignore_errors' => true,
				'body'          => json_encode(
					array(
						'query'     => $query,
						'variables' => $variables,
					)
				),
			),
		);

		$response_http_code    = (int) wp_remote_retrieve_response_code( $response );
		$response_http_message = wp_remote_retrieve_response_message( $response );
		$data                  = wp_remote_retrieve_body( $response );

		if ( is_wp_error( $response ) || 200 !== $response_http_code ) {
			$debug_msg = 'Atlas Search sync error occurred: ';
			if ( empty( $response_http_code ) && empty( $response_http_message ) && ! empty( $response->errors ) ) {
				$debug_msg .= json_encode( $response->errors );
			} else {
				$debug_msg .= "{$response_http_code} - {$response_http_message}. Message: {$data}";
			}
			( new Debug_Logger() )->log( $debug_msg );
			$exception_msg = ( 404 === $response_http_code ) ? 'Please check Atlas Search settings.' : 'Sync was unsuccessful.';

			throw new \ErrorException( $exception_msg, $response_http_code );
		}

		$response_data = json_decode( $data, true );
		if ( empty( $response_data ) && ! is_array( $response_data ) ) {
			throw new \ErrorException( 'Response was not at proper format ' . $data );
		}

		$message = $this->parse_errors( $response_data );
		if ( ! empty( $response_data['data'] ) && is_array( $response_data['data'] ) ) {
			foreach ( $response_data['data'] as $response_item ) {
				$message .= $this->parse_errors( $response_item );
			}
		}

		if ( empty( $message ) ) {
			return $response_data;
		}

		if ( 'UNAUTHENTICATED' === ( $response_data['errors'][0]['extensions']['code'] ?? '' ) ) {
			throw new \ErrorException( $message, 401 );
		}

		throw new \ErrorException( $message );
	}

	/**
	 * @param array $response_data Response.
	 * @return string
	 */
	private function parse_errors( array $response_data ): string {
		$message = ( ( $response_data['status'] ?? '' ) === 'Error' ) ? ( $response_data['message'] ?? '' ) : '';

		$message = $this->change_message( $message );
		if ( ! empty( $response_data['errors'] ) ) {
			foreach ( $response_data['errors'] as $error ) {
				$message .= $this->change_message( $error['message'] ) . "\n" ?? '';
			}
		}

		return $message;
	}

	/**
	 * @param string|null $message Message to be changed.
	 *
	 * @return string|null
	 */
	public function change_message( ?string $message ): ?string {
		if ( empty( $message ) ) {
			return $message;
		}

		if ( strpos( $message, 'An operation failed because it depends on one or more records that were required but not found' ) !== false ) {
			$message = ' data out of sync! Please perform an Atlas Search Sync!';
		}

		return $message;
	}
}
