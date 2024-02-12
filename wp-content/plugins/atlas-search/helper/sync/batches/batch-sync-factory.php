<?php

namespace Wpe_Content_Engine\Helper\Sync\Batches;

use Wpe_Content_Engine\Helper\Client_Interface;
use Wpe_Content_Engine\Helper\Constants\Batch_Sync_Type_Names;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\Delete_All as Delete_All_Entity;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\ACM as ACM_Entity;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\Custom_Post_Type as Custom_Post_Type_Entity;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\Term as Term_Entity;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\User as User_Entity;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\Post as Post_Entity;
use Wpe_Content_Engine\Helper\Sync\Batches\Delete_All as Delete_All_Batch;
use Wpe_Content_Engine\Helper\Sync\Batches\ACM as ACM_Batch;
use Wpe_Content_Engine\Helper\Sync\Batches\Custom_Post_Type as Custom_Post_Type_Batch;
use Wpe_Content_Engine\Helper\Sync\Batches\Post as Post_Batch;
use Wpe_Content_Engine\Helper\Sync\Batches\Page as Page_Batch;
use Wpe_Content_Engine\Helper\Sync\Batches\User as User_Batch;
use Wpe_Content_Engine\Helper\Sync\Batches\Category as Category_Batch;
use Wpe_Content_Engine\Helper\Sync\Batches\Tag as Tag_Batch;
use Wpe_Content_Engine\Settings_Interface;

class Batch_Sync_Factory {
	/**
	 * @var Batch_Sync_Interface[] DATA_TO_SYNC
	 */
	public const DATA_TO_SYNC = array(
		Batch_Sync_Type_Names::DELETE_ALL        => Delete_All_Batch::class,
		Batch_Sync_Type_Names::ACM               => ACM_Batch::class,
		Batch_Sync_Type_Names::CUSTOM_POST_TYPES => Custom_Post_Type_Batch::class,
		Batch_Sync_Type_Names::TAGS              => Tag_Batch::class,
		Batch_Sync_Type_Names::CATEGORIES        => Category_Batch::class,
		Batch_Sync_Type_Names::USERS             => User_Batch::class,
		Batch_Sync_Type_Names::POSTS             => Post_Batch::class,
		Batch_Sync_Type_Names::PAGES             => Page_Batch::class,
	);

	private const BATCH_SYNC_ENTITY_DEPENDENCIES = array(
		Delete_All_Batch::class       => Delete_All_Entity::class,
		ACM_Batch::class              => ACM_Entity::class,
		Custom_Post_Type_Batch::class => Custom_Post_Type_Entity::class,
		Tag_Batch::class              => Term_Entity::class,
		Category_Batch::class         => Term_Entity::class,
		User_Batch::class             => User_Entity::class,
		Post_Batch::class             => Post_Entity::class,
		Page_Batch::class             => Post_Entity::class,
	);

	/**
	 * @param string             $batch_sync_class_name .
	 * @param Client_Interface   $client .
	 * @param Settings_Interface $settings .
	 *
	 * @return Batch_Sync_Interface.
	 */
	public static function build( string $batch_sync_class_name, Client_Interface $client, Settings_Interface $settings ): Batch_Sync_Interface {
		$entity_class = self::BATCH_SYNC_ENTITY_DEPENDENCIES[ $batch_sync_class_name ];

		return new $batch_sync_class_name( new $entity_class( $client, $settings ) );
	}
}
