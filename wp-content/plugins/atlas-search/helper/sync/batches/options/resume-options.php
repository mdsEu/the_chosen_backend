<?php

namespace Wpe_Content_Engine\Helper\Sync\Batches\Options;

class Resume_Options {


	/**
	 * @var string;
	 */
	private $entity;

	/**
	 * @var int
	 */
	private $batch_size;

	/**
	 * @var int
	 */
	private $page;

	/**
	 * @var ?Progress $progress
	 */
	private $progress = null;

	/**
	 * Resume_Options constructor.
	 *
	 * @param string    $entity Entity.
	 * @param int       $batch_size Batch Size.
	 * @param int       $page Page.
	 * @param ?Progress $progress Progress object.
	 */
	public function __construct( string $entity = '', int $batch_size = Batch_Options::DEFAULT_BATCH_SIZE, int $page = 1, ?Progress $progress = null ) {
		$this->entity     = $entity;
		$this->batch_size = $batch_size;
		$this->page       = $page;
		$this->progress   = $progress;
	}

	/**
	 * @return string
	 */
	public function get_entity(): string {
		return $this->entity;
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
	 * @return ?Progress
	 */
	public function get_progress(): ?Progress {

		return $this->progress;
	}

}
