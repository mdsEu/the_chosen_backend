<?php
/**
 * b2i Options
 *
 * @since 0.1.0
 * @package b2i
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once dirname(__FILE__) . '/../vendor/cmb2/init.php';

/**
 * b2i Options class.
 *
 * @since 0.1.0
 */
class B2i_Options {
	/**
	 * Parent plugin class
	 *
	 * @var    class
	 * @since  0.1.0
	 */
	protected $plugin = null;

	/**
	 * Option key, and option page slug
	 *
	 * @var    string
	 * @since  0.1.0
	 */
	protected $key = 'b2i_options';

	/**
	 * Options page metabox id
	 *
	 * @var    string
	 * @since  0.1.0
	 */
	protected $metabox_id = 'b2i_options_metabox';

	/**
	 * Options Page title
	 *
	 * @var    string
	 * @since  0.1.0
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Constructor
	 *
	 * @since  0.1.0
	 * @param  object $plugin Main plugin object.
	 * @return void
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
		$this->title = __( 'B2i Options', 'b2i' );
	}

	/**
	 * Initiate our hooks
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'current_screen', array( $this, 'maybe_handle_registration' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
	}

	/**
	 * Register our setting to WP
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function admin_init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function add_options_page() {
		$this->options_page = add_options_page(
			$this->title,
			$this->title,
			'manage_options',
			$this->key,
			array( $this, 'admin_page_display' )
		);

		// Include CMB CSS in the head to avoid FOUC.
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo esc_attr( $this->key ); ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

			<?php $this->maybe_show_registration_message(); ?>

			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
		<br>
		* Post key and Post IP List used for posting Press releases into Wordpress as a blog post.<br>
		<?php
		
		include $this->plugin->path . 'partials/instructions.php';
	}

	/**
	 * If there are no options set yet, show information about registering for b2i
	 *
	 * @since  0.2.0
	 * @return void
	 */
	public function maybe_show_registration_message() {
		$options = get_option( 'b2i_options', array() );
		if ( empty( $options ) ) {
			$url_base = 'http://www.b2itech.com/Contact_Us';
			$nonce = wp_create_nonce( 'b2i_registration' );
			$redirect = urlencode( admin_url( 'options-general.php?page=b2i_options' ) );
			$url = $url_base . '?redirect=' . $redirect . '&nonce=' . $nonce;
			include $this->plugin->path . 'partials/registration.php';
		}
	}

	/**
	 * Check if we should be updating the plugin options (if user has been redirected from b2i)
	 *
	 * @since  0.2.0
	 * @return void
	 */
	public function maybe_handle_registration() {
		if ( ! is_user_logged_in() || ! is_admin() ) {
			return;
		}

		$screen = get_current_screen();
		$screen_is_valid = $screen->id === $this->options_page;
		$nonce_is_valid = isset( $_GET['nonce'] ) && wp_verify_nonce( $_GET['nonce'], 'b2i_registration' );
		$query_vars_are_set = isset( $_GET['b2i_id'] ) && isset( $_GET['b2i_key'] );

		if ( $screen_is_valid && $nonce_is_valid && $query_vars_are_set ) {
			$this->handle_registration();
		}
	}

	/**
	 * Store the business ID and application key passed back from b2i
	 *
	 * @since  0.2.0
	 * @return void
	 */
	protected function handle_registration() {
		$business_id = sanitize_text_field( $_GET['b2i_id'] );
		$api_key = sanitize_text_field( $_GET['b2i_key'] );
		$ticker = sanitize_text_field( $_GET['ticker'] );
		$postkey = sanitize_text_field( $_GET['postkey'] );
		$postips = sanitize_text_field( $_GET['iplist'] );
		$do_not_use_ip_list = sanitize_checkbox( $_GET['do_not_use_ip_list'] );
		$use_call_home = sanitize_checkbox( $_GET['use_call_home'] );
		
		cmb2_update_option( 'b2i_options', 'business_id', $business_id );
		cmb2_update_option( 'b2i_options', 'key', $api_key );
		cmb2_update_option( 'b2i_options', 'postkey', $postkey );
		cmb2_update_option( 'b2i_options', 'ticker', $ticker );
		cmb2_update_option( 'b2i_options', 'iplist', $postips );
		cmb2_update_option( 'b2i_options', 'do_not_use_ip_list', $do_not_use_ip_list );
		cmb2_update_option( 'b2i_options', 'use_call_home', $use_call_home );
	}

	/**
	 * Add custom fields to the options page.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function add_options_page_metabox() {

		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove.
				'key'   => 'options-page',
				'value' => array( $this->key ),
			),
		) );

		$cmb->add_field( array(
			'name'    => __( 'Business ID', 'b2i' ),
			'id'      => 'business_id',
			'type'    => 'text',
		) );
		
		$cmb->add_field( array(
			'name'    => __( 'Api Key', 'b2i' ),
			'id'      => 'key',
			'type'    => 'text',
		) );
		
		$cmb->add_field( array(
			'name'    => __( 'Ticker', 'b2i' ),
			'id'      => 'ticker',
			'type'    => 'text',
		) );
		
		$cmb->add_field( array(
			'name'    => __( 'Post Key', 'b2i' ),
			'id'      => 'postkey',
			'type'    => 'text',
		) );
		
		$cmb->add_field( array(
			'name'    => __( 'Post IP List', 'b2i' ),
			'id'      => 'iplist',
			'type'    => 'text',
		) );
		
		$cmb->add_field( array(
			'name'    => __( 'Do Not use IP List', 'b2i' ),
			'id'      => 'do_not_use_ip_list',
			'desc'    => 'Disables check against post IP list - when behind proxy type hosting and cannot validate against B2i posting IP.',
			'type'    => 'checkbox',
			'default'          => false, //If it's checked by default
			'active_value'     => true,
			'inactive_value'   => false
		) );
		
		$cmb->add_field( array(
			'name'    => __( 'Use "Call Home" verify', 'b2i' ),
			'id'      => 'use_call_home',
			'desc'    => 'Enables ItemKey validate against B2i URL.',
			'type'    => 'checkbox',
			'default'          => false, //If it's checked by default
			'active_value'     => true,
			'inactive_value'   => false
		) );
		
		$iplist = cmb2_get_option( 'b2i_options', 'iplist' );
		if($iplist==''){
			cmb2_update_option( 'b2i_options', 'iplist', '66.111.109.135 66.111.109.141 66.111.109.108 66.111.109.109');
		}
		
	}
	
	function sanitize_checkbox($value, $field_args, $field) {
	  // Return 0 instead of false if null value given.
	  return is_null($value) ? 0 : $value;
	}
}
