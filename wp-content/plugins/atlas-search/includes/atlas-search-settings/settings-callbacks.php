<?php
/**
 * This file enqueues scripts and styles.
 *
 * @package    Wpe_Content_Engine
 */
class WPE_Atlas_Search_Settings_Page {
	private $loader;
	private const PAGE = 'atlas-search-settings';

	public function __construct( \Wpe_Content_Engine_Loader $loader ) {
		$this->loader        = $loader;
		$this->show_settings = getenv( 'WPE_ATLAS_SEARCH_SHOW_SETTINGS_PAGE' ) ?: 'false';
	}

	public function init_page() {
		$this->loader->add_action( 'admin_init', $this, 'enqueue_settings_page' );
		$this->loader->add_action( 'admin_menu', $this, 'wpe_atlas_search_add_settings_menu' );
		$this->loader->add_filter( 'parent_file', $this, 'maybe_override_submenu_file' );
	}

	public function enqueue_settings_page() {
		add_action(
			'admin_enqueue_scripts',
			function() {

				wp_localize_script(
					'wp-api',
					'wpApiSettings',
					array(
						'root'  => esc_url_raw( rest_url() ),
						'nonce' => wp_create_nonce( 'wp_rest' ),
					)
				);
				wp_enqueue_script( 'wp-api' );
				// @todo Material UI requires Roboto Fonts. Uncomment if necessary
				// @todo wp_enqueue_style( 'roboto-font', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap', false );

				if ( getenv( 'WPE_ATLAS_SEARCH_ENV' ) === 'dev' ) {
					wp_enqueue_script(
						'atlas-search-js',
						'http://localhost:3002/wp-content/plugins/atlas-search/includes/atlas-search-settings/build/static/js/bundle.js',
						'',
						wp_rand( 10, 1000 ),
						true
					);
				} else {
					$asset_manifest = json_decode( file_get_contents( ATLAS_SEARCH_ASSET_MANIFEST ), true )['files'];

					if ( isset( $asset_manifest['main.css'] ) ) {
						wp_enqueue_style( 'atlas-search-css', get_site_url() . $asset_manifest['main.css'], array(), ATLAS_SEARCH_VERSION );
					}

					if ( isset( $asset_manifest['runtime-main.js'] ) ) {
						wp_enqueue_script( 'atlas-search-runtime', get_site_url() . $asset_manifest['runtime-main.js'], array(), ATLAS_SEARCH_VERSION, true );
						wp_enqueue_script( 'atlas-search-js', get_site_url() . $asset_manifest['main.js'], array( 'atlas-search-runtime' ), ATLAS_SEARCH_VERSION, true );
					} else {
						wp_enqueue_script( 'atlas-search-js', get_site_url() . $asset_manifest['main.js'], array(), ATLAS_SEARCH_VERSION, true );
					}

					foreach ( $asset_manifest as $key => $value ) {
						if ( preg_match( '@static/js/(.*)\.chunk\.js@', $key, $matches ) ) {
							if ( $matches && is_array( $matches ) && count( $matches ) === 2 ) {
								$name = 'atlas-search-' . preg_replace( '/[^A-Za-z0-9_]/', '-', $matches[1] );
								wp_enqueue_script( $name, get_site_url() . $value, array( 'atlas-search-js' ), ATLAS_SEARCH_VERSION, true );
							}
						}

						if ( preg_match( '@static/css/(.*)\.chunk\.css@', $key, $matches ) ) {
							if ( $matches && is_array( $matches ) && count( $matches ) === 2 ) {
								$name = 'atlas-search-' . preg_replace( '/[^A-Za-z0-9_]/', '-', $matches[1] );
								wp_enqueue_style( $name, get_site_url() . $value, array( 'atlas-search-css' ), ATLAS_SEARCH_VERSION );
							}
						}
					}
				}
			}
		);
	}

	public function wpe_atlas_search_add_settings_menu() {
		$icon = include __DIR__ . '/views/search-menu-icon.php';
		add_menu_page(
			esc_html__( 'Atlas Search', 'atlas-search' ),
			esc_html__( 'Atlas Search', 'atlas-search' ),
			'manage_options',
			self::PAGE,
			array( $this, 'render_atlas_search_settings_page' ),
			$icon
		);

		add_submenu_page(
			self::PAGE,
			'Settings',
			'Settings',
			'manage_options',
			'atlas-search-settings',
			'__return_null'
		);

		add_submenu_page(
			self::PAGE,
			'Search Config',
			'Search Config',
			'manage_options',
			'atlas-search-settings&amp;view=search-config',
			'__return_null'
		);

		add_submenu_page(
			self::PAGE,
			'Sync',
			'Sync',
			'manage_options',
			'atlas-search-settings&amp;view=sync-data',
			'__return_null'
		);

	}

	public function render_atlas_search_settings_page() {
		?>
			<div class="atlas-search-settings-page">
				<header>
					<a class="flex-row" href="<?php echo esc_url( admin_url( 'admin.php?page=atlas-search-settings' ) ); ?>">
						<svg class="wpengine" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M0 2.29413L2.29411 0H9.64706V9.64707H0V2.29413ZM10.1765 0H19.8235V7.35294L17.4706 9.64707H12.4706L10.1765 7.35294V0ZM22.6471 10.1765L20.3529 12.4706V17.5294L22.6471 19.8235H30V10.1765H22.6471ZM10.1765 30H19.8235V22.6471L17.4706 20.3529H12.4706L10.1765 22.6471V30ZM30 30V22.6471L27.7059 20.3529H20.3529V30H30ZM20.3529 0V7.35294L22.6471 9.64707H30V0H20.3529ZM13.6471 15C13.6471 15.7059 14.2353 16.353 15 16.353C15.7647 16.353 16.3529 15.7647 16.3529 15C16.3529 14.2941 15.7647 13.6471 15 13.6471C14.2941 13.6471 13.6471 14.2353 13.6471 15ZM9.64706 10.1765H0V19.8235H7.29411L9.64706 17.5294V10.1765ZM7.29411 20.3529L9.64706 22.6471V27.7059L7.29411 30H0V20.3529H7.29411Z" fill="white"></path>
						</svg>
						<h1>Atlas Search <span class="d-none d-sm-inline">by WP Engine</span></h1>
					</a>
				</header>
				<div id='atlas_search_settings_root'></div>
			</div>
		<?php
	}

	/**
	 * Overrides the “submenu file” that determines which admin submenu item gains
	 * the `current` CSS class. Without this, WordPress incorrectly gives the
	 * “Model” subpage the `current` class when the “Taxonomies” subpage is active.
	 *
	 * @link https://github.com/WordPress/WordPress/blob/9937fea517ac165ad01f67c54216469e48c48ca7/wp-admin/menu-header.php#L223-L227
	 * @link https://wordpress.stackexchange.com/a/131873
	 * @link https://developer.wordpress.org/reference/hooks/parent_file/
	 * @param string $parent_file The original parent file.
	 * @return string The $parent_file unaltered. Only the $submenu_file global is altered.
	 */
	public function maybe_override_submenu_file( $parent_file ) {
		global $submenu_file;

		$page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS );
		$view = filter_input( INPUT_GET, 'view', FILTER_SANITIZE_FULL_SPECIAL_CHARS );

		if ( self::PAGE === $page && 'search-config' === $view ) {
			$submenu_file = 'atlas-search-settings&amp;view=search-config'; // phpcs:ignore -- global override needed to set current submenu page without JavaScript.
		}

		if ( self::PAGE === $page && 'sync-data' === $view ) {
			$submenu_file = 'atlas-search-settings&amp;view=sync-data'; // phpcs:ignore -- global override needed to set current submenu page without JavaScript.
		}

		return $parent_file;
	}
}
