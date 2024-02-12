<?php

namespace Wpe_Content_Engine\Helper\Sync\Batches\Options;

use Wpe_Content_Engine\Helper\Sync\Batches\Batch_Sync_Interface;

class Batch_Options {

	/**
	 * @var string Batch Options Key
	 */
	public const OPTIONS_WPE_CONTENT_ENGINE_SYNC_RESUME = 'wpe_content_engine_sync_resume';

	/**
	 * @var int
	 */
	public const DEFAULT_BATCH_SIZE = 20;

	/**
	 * @var int
	 */
	private $batch_size;

	/**
	 * @var int
	 */
	private $page;

	/**
	 * @var Batch_Sync_Interface[] $data_to_be_synced
	 */
	private $data_to_be_synced = array();

	/**
	 * Batch_Options constructor.
	 *
	 * @param int                    $batch_size Batch Size.
	 * @param int                    $page Page.
	 * @param Batch_Sync_Interface[] $data_to_be_synced Data to be synced.
	 */
	public function __construct( int $batch_size, int $page, array $data_to_be_synced ) {
		$this->data_to_be_synced = $data_to_be_synced;
		$this->batch_size        = $batch_size;
		$this->page              = $page;
	}

	/**
	 * @param Resume_Options $resume_options Resume options.
	 */
	public function calculate_with_resume( Resume_Options $resume_options ): void {
		$index = array_search( $resume_options->get_entity(), array_keys( $this->data_to_be_synced ) );
		if ( false !== $index ) {
			$this->data_to_be_synced = array_slice( $this->data_to_be_synced, $index );
		}

		// calculate page.
		if ( $this->get_batch_size() !== $resume_options->get_batch_size() ) {
			$this->page = floor( ( $resume_options->get_batch_size() * $resume_options->get_page() ) / $this->get_batch_size() );
		} else {
			$this->page = $resume_options->get_page();
		}

	}

	/**
	 * @return array
	 */
	public function get_data_to_be_synced(): array {
		return $this->data_to_be_synced;
	}

	/**
	 * @return int
	 */
	public function get_batch_size(): int {
		return $this->batch_size;
	}

	/**
	 * @return int
	 */
	public function get_page(): int {
		return $this->page;
	}

	/**
	 * @param int $page Page.
	 */
	public function set_page( int $page ): void {
		$this->page = $page;
	}

	/**
	 * @return bool
	 */
	public function is_empty(): bool {
		return empty( $this->data_to_be_synced );
	}

	/**
	 * @return bool
	 */
	public function is_last_class_to_be_synced(): bool {
		return count( $this->data_to_be_synced ) <= 1;
	}

	/**
	 * @return array
	 */
	public function get_current_class_to_be_synced(): array {

		if ( $this->is_empty() ) {
			return array();
		}
		$short_name = array_key_first( $this->data_to_be_synced );

		return array(
			'short_name' => $short_name,
			'class'      => $this->data_to_be_synced[ $short_name ],
		);
	}

	/**
	 * @return ?string
	 */
	public function get_next_class_name(): ?string {
		if ( $this->is_last_class_to_be_synced() ) {
			return null;
		}

		return array_keys( $this->data_to_be_synced )[1];
	}
}
