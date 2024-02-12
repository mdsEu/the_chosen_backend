<?php

namespace Wpe_Content_Engine\Helper\Constants;

class Post_Status {

	// WP STATUSES.
	public const PUBLISH    = 'publish';
	public const FUTURE     = 'future';
	public const DRAFT      = 'draft';
	public const PENDING    = 'pending';
	public const PRIVATE    = 'private';
	public const TRASH      = 'trash';
	public const AUTO_DRAFT = 'auto-draft';
	public const INHERIT    = 'inherit';

	public const WP_STATUSES = array(
		self::PUBLISH,
		self::FUTURE,
		self::DRAFT,
		self::PENDING,
		self::PRIVATE,
		self::TRASH,
		self::AUTO_DRAFT,
		self::INHERIT,
	);

	// Content Engine STATUS.
	public const UNPUBLISH = 'unpublish';
}
