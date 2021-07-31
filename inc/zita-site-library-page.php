<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Zita_Site_Library_Page' ) ) {

	/**
	 * Zita Admin Settings
	 */
	class Zita_Site_Library_Page {
		static public $plugin_slug = 'zita-site-library';

		/**
		 * Constructor
		 */
		function __construct() {

			if ( ! is_admin() ) {
				return;
			}

		add_action( 'init', __CLASS__ . '::init_admin_settings', 99 );
		}


		/**
		 * Admin settings init
		 */
		static public function init_admin_settings() {

			if ( isset( $_REQUEST['page'] ) && strpos( $_REQUEST['page'], self::$plugin_slug ) !== false ) {

				// Let extensions hook into saving.
				self::save_settings();
			}

		add_action( 'admin_menu', __CLASS__ . '::add_admin_menu', 100 );
		add_action( 'zita_templates_menu_action', __CLASS__ . '::general_page' );


		}

static public function add_admin_menu() {

			$parent_page    = 'themes.php';
			$page_title     = __('Zita Site Library','zita-site-library');
			$capability     = 'manage_options';
			$page_menu_slug = self::$plugin_slug;
			$page_menu_func = __CLASS__ . '::menu_callback';

			add_theme_page( $page_title, $page_title, $capability, $page_menu_slug, $page_menu_func );
		}

		/**
		 * Save All admin settings here
		 */
		static public function save_settings() {

			// Only admins can save settings.
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}
		}

		/**
		 * Menu callback
		 *
		 * @since 1.0.6
		 */
		static public function menu_callback() {
			?>
			<div class="zita-sites-menu-page-wrapper">
				<?php do_action( 'zita_templates_menu_action'); ?>
			</div>
			<?php
		}

		static public function general_page() {
			require_once ZITA_SITE_LIBRARY_DIR . 'inc/admin-tmpl.php';

		}
}
	new Zita_Site_Library_Page;
}