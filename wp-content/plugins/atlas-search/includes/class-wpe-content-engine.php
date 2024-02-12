<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wpe_Content_Engine
 * @subpackage Wpe_Content_Engine/includes
 */

use Wpe_Content_Engine\Helper\Acf_Support\Acf_Factory;
use Wpe_Content_Engine\Helper\API\Settings_Controller;
use Wpe_Content_Engine\Helper\API\Search_Config_Controller;
use Wpe_Content_Engine\Helper\API\Sync_Data\Sync_Data_Controller;
use Wpe_Content_Engine\Helper\Constants\Post_Status;
use Wpe_Content_Engine\Helper\Hook_Handler\Show_Admin_Notice_Handler_Decorator;
use Wpe_Content_Engine\Helper\Search\Search;
use Wpe_Content_Engine\Helper\Search\Search_Config;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\Post as Post_Entity;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\Custom_Post_Type as Custom_Post_Type_Entity;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\User as User_Entity;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\Term as Term_Entity;
use Wpe_Content_Engine\Helper\Admin_Notice;
use Wpe_Content_Engine\Helper\Sync\GraphQL\Client;
use Wpe_Content_Engine\Helper\Sync\Entity\Wordpress\ACM;
use Wpe_Content_Engine\Settings_Interface;
use function Wpe_Content_Engine\Helper\Notifications\handle_re_sync_notification;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wpe_Content_Engine
 * @subpackage Wpe_Content_Engine/includes
 * @author     wpe <user@example.com>
 */
class Wpe_Content_Engine {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wpe_Content_Engine_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * @var Settings_Interface $settings Settings.
	 */
	protected Settings_Interface $settings;

	/**
	 * @var Client $client Sync API Client.
	 */
	protected Client $client;


	/**
	 * @var Search_Config
	 */
	private Search_Config $search_config;


	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 * @param Settings_Interface $settings Settings.
	 * @param Client             $client API Client.
	 */
	public function __construct( Settings_Interface $settings, Client $client ) {
		$this->client   = $client;
		$this->settings = $settings;

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

		$this->search_config = new Search_Config();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wpe_Content_Engine_Loader. Orchestrates the hooks of the plugin.
	 * - Wpe_Content_Engine_I18n. Defines internationalization functionality.
	 * - Wpe_Content_Engine_Admin. Defines all hooks for the admin area.
	 * - Wpe_Content_Engine_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		* Load Core WP plugin functions
		*/
		require_once ABSPATH . 'wp-admin/includes/plugin.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wpe-content-engine-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wpe-content-engine-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wpe-content-engine-public.php';

		$this->loader = new Wpe_Content_Engine_Loader();

		/**
		 * Helper classes used to batch sync data
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'settings-interface.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'core-wp-wrapper/wp-progress-bar.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'wp-settings.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/string-transformation.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/progress-bar-info-trait.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/data-life-cycle.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/notifications/re-sync-notifier.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/constants/batch-sync-type-names.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/constants/json-schema-type.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/constants/http-verb.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/constants/graphql-type.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/constants/order.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/constants/order-by.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/constants/post-mime-type.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/constants/post-status.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/constants/sync-response-status.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/constants/post-type.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/logging/logger-interface.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/logging/debug-logger.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/logging/server-log-info.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/json-schema/property.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/json-schema/json-schema.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/json-schema/primitive-type-property.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/json-schema/number-property.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/json-schema/integer-property.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/json-schema/boolean-property.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/json-schema/string-property.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/json-schema/date-time-property.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/json-schema/array-property.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/acf-support/acf.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/acf-support/acf-factory.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/acf-support/types/abstract-type.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/acf-support/types/number.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/acf-support/types/text.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/acf-support/types/email.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/client-interface.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/graphql/client.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/entity/wordpress/wp-entity.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/asset-type.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/entity/wordpress/acm.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/entity/wordpress/custom-post-type.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/entity/wordpress/term.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/entity/wordpress/user.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/entity/wordpress/post.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/entity/wordpress/acm.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/entity/wordpress/delete-all.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/hook-handler/show-admin-notice-handler-decorator.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/sync-interface.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/delete-all.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/custom-post-type.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/acm.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/tag.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/category.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/user.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/post.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/page.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/options/progress.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/options/batch-options.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/options/resume-options.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/options/sync-lock-options.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/options/sync-lock-status.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/options/sync-lock-state.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/batch-sync-factory.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/sync-lock-manager.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/sync-lock-status-store-interface.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/sync/batches/sync-lock-status-store-wordpress.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/admin-notice.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/search/search.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/search/search-config.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/api/search-config-controller.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/search/config/configurable.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/search/config/acm.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/search/config/built-ins.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/search/config/cpt.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/exceptions/atlas-url-not-set-exception.php';

		/**
		 * API Imports
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/api/settings-controller.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/api/sync-data/response.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'helper/api/sync-data/sync-data-controller.php';

		/**
		 * Settings page class
		 */
		require_once ATLAS_SEARCH_SETTINGS_PAGE_PATH . 'settings-callbacks.php';

		/**
		 * WP CLI Commands
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'commands/class-wpe-content-engine-sync-data.php';

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wpe_Content_Engine_I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new Wpe_Content_Engine_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$settings_page = new WPE_Atlas_Search_Settings_Page( $this->loader );
		$settings_page->init_page();

		$content_engine_sync_user = new Show_Admin_Notice_Handler_Decorator( new User_Entity( $this->client, $this->settings ) );
		$content_engine_sync_term = new Show_Admin_Notice_Handler_Decorator( new Term_Entity( $this->client, $this->settings ) );

		$this->loader->add_action( 'enqueue_block_editor_assets', $this, 'post_notices', 9 );
		$this->loader->add_action( 'wp_ajax_block_editor_notices', $this, 'block_editor_notices_callback', 9 );

		// Register admin message handling.
		$this->loader->add_action( 'admin_notices', new Admin_Notice(), 'show_messages', 10, 0 );

		// Post hooks.
		$this->loader->add_action( 'wp_after_insert_post', $this, 'post_upsert_handler', 10, 2 );
		$this->loader->add_action( 'transition_post_status', $this, 'post_status_transitions', 10, 3 );
		/** ORN-205 We were asked to disable delete hooks. We can talk about it post Q2*/
		$this->loader->add_action( 'delete_post', $this, 'post_delete_handler', 10, 2 );

		// User hooks.
		$this->loader->add_action( 'user_register', $content_engine_sync_user, 'upsert', 10, 1 );
		$this->loader->add_action( 'profile_update', $content_engine_sync_user, 'upsert', 10, 1 );
		$this->loader->add_action( 'deleted_user', $content_engine_sync_user, 'delete', 10, 1 );

		// Terms hooks.
		$this->loader->add_action( 'saved_term', $content_engine_sync_term, 'upsert', 10, 3 );
		$this->loader->add_action( 'pre_delete_term', $content_engine_sync_term, 'delete', 10, 2 );

		// REST API.
		$this->loader->add_action( 'rest_api_init', new Settings_Controller(), 'register_routes', 10, 0 );

		// Search API.
		$this->loader->add_action( 'rest_api_init', new Search_Config_Controller(), 'register_routes', 10, 0 );
		$this->loader->add_action( 'rest_api_init', new Sync_Data_Controller( $this->client, $this->settings ), 'register_routes', 10, 0 );
	}

	/**
	 * Handles post upsert calls ( for both built and custom types) with ACF
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post WP Post.
	 */
	public function post_upsert_handler( int $post_id, WP_Post $post ) {
		$obj                 = null;
		$is_acm_model        = ACM::is_acm_model( $post->post_type );
		$is_custom_post_type = Custom_Post_Type_Entity::is_custom_post_type( $post->post_type );

		if ( $is_acm_model ) {
			$obj = new ACM( $this->client, $this->settings );
		} elseif ( $is_custom_post_type ) {
			$obj = new Custom_Post_Type_Entity( $this->client, $this->settings );
		} else {
			$obj = new Post_Entity( $this->client, $this->settings );
		}

		$acf_info = Acf_Factory::build_acf_helper_for_type( $post_id, $post->post_type );
		( new Show_Admin_Notice_Handler_Decorator( $obj ) )->upsert( $post_id, $post, $acf_info );
		$this->search_config->get_config();
	}

	/**
	 * ORN-205 We were asked to disable delete hooks for posts. We can talk about it post Q2
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post WP Post.
	 */
	public function post_delete_handler( int $post_id, WP_Post $post ) {
		$is_custom_post_type = Custom_Post_Type_Entity::is_custom_post_type( $post->post_type );

		// ORN-205 We were asked to disable delete hooks for posts. We can talk about it post Q2.
		if ( $is_custom_post_type ) {
			$obj = new Custom_Post_Type_Entity( $this->client, $this->settings );
			( new Show_Admin_Notice_Handler_Decorator( $obj ) )->delete( $post_id, $post );
		}

		$this->search_config->get_config();
	}
	/**
	 * @param string  $new_status New Status.
	 * @param string  $old_status Old Status.
	 * @param WP_Post $post WP Post.
	 * @throws ErrorException Throws Exception.
	 */
	public function post_status_transitions( string $new_status, string $old_status, WP_Post $post ) {
		if ( ( 'post' === $post->post_type || 'page' === $post->post_type ) && Post_Status::PUBLISH === $new_status && Post_Status::FUTURE === $old_status ) {
			( new Post_Entity( $this->client, $this->settings ) )->upsert( $post->ID, $post );
		}
	}

	public function block_editor_notices_callback() {
		check_ajax_referer( 'ajax-nonce', 'security' );
		$admin_notices = new Admin_Notice();
		$messages      = $admin_notices->get_messages();

		header( 'Content-Type: application/json' );
		echo json_encode(
			array(
				'hasError' => ! empty( $messages ),
				'message'  => $messages,
			)
		);
		die();
	}

	public function post_notices() {
		// @codingStandardsIgnoreLine
		wp_enqueue_script( 'display-post-notice', plugins_url( '../public/js/display-post-notice.js', __FILE__ ), array( 'jquery', 'wp-editor' ) );
		wp_localize_script( 'display-post-notice', 'ajax_var', array( 'nonce' => wp_create_nonce( 'ajax-nonce' ) ) );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new Wpe_Content_Engine_Public( $this->get_plugin_name(), $this->get_version() );

		$search = new Search(
			$this->client,
			$this->settings,
			new Search_Config()
		);
		$this->loader->add_filter( 'posts_pre_query', $search, 'get_ce_posts', 10, 2 );
		$this->loader->add_filter( 'found_posts', $search, 'found_posts', 10, 2 );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
		handle_re_sync_notification( new Admin_Notice() );
	}
	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public static function get_plugin_name() {
		return 'wpe-content-engine';
	}

		/**
		 * Retrieve the version number of the plugin.
		 *
		 * @since     1.0.0
		 * @return    string    The version number of the plugin.
		 */
	public static function get_version() {
		return defined( 'ATLAS_SEARCH_VERSION' ) ? ATLAS_SEARCH_VERSION : '1.0.0';
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wpe_Content_Engine_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

}
