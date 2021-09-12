<?php

defined( 'ABSPATH' ) || wp_die( __( 'You can\'t access this page', 'wp-dark-mode-ultimate' ) );

final class WP_Dark_Mode_Ultimate {

	/**
	 * Sets up and initializes the plugin.
	 * Main initiation class
	 *
	 * @since 1.0.0
	 */

	/**
	 * A reference to an instance of this class.
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    object
	 */
	private static $instance = null;

	/**
	 * Minimum PHP version required
	 *
	 * @var string
	 */
	private static $min_php = '5.6.0';

	/**
	 * Sets up needed actions/filters for the plugin to initialize.
	 *
	 * @return void
	 * @since  1.0.0
	 * @access public
	 */
	public function __construct() {

		if ( $this->check_environment() ) {

			$this->load_files();

			$this->init();

			$this->appsero_init_tracker_wp_dark_mode_pro();

		}
	}

	/**
	 * redirect to settings page after activation the plugin
	 */
	public static function activation_redirect() {
		if ( get_option( 'wp_dark_mode_ultimate_do_activation_redirect', false ) ) {
			delete_option( 'wp_dark_mode_ultimate_do_activation_redirect' );

			wp_redirect( admin_url( 'admin.php?page=wp-dark-mode-settings' ) );
		}
	}

	/**
	 * Initialize the plugin tracker
	 *
	 * @return void
	 */
	public function appsero_init_tracker_wp_dark_mode_pro() {

		if ( ! class_exists( 'Appsero\Client' ) ) {
			require_once WP_PLUGIN_DIR . '/wp-dark-mode/appsero/src/Client.php';
		}

		$client = new Appsero\Client( '44e81435-c0f1-4149-983b-eb8d9f7a9a66', 'WP Dark Mode Ultimate', WP_DARK_MODE_ULTIMATE_FILE );

		// Active insights
		$client->insights()->hide_notice()->init();
		// Active automatic updater
		$client->updater();

		global $wp_dark_mode_license;
		$wp_dark_mode_license = $client->license();

		// Active license page and checker
		$args = array(
			'type'        => 'submenu',
			'menu_title'  => 'License Activation',
			'page_title'  => 'License Activation - WP Dark Mode',
			'menu_slug'   => 'wp-dark-mode-license',
			'parent_slug' => 'wp-dark-mode',
			'position'    => 99,
		);
		$client->license()->add_settings_page( $args );

	}

	/**
	 * Ensure theme and server variable compatibility
	 *
	 * @return boolean
	 * @since  1.0.0
	 * @access private
	 */
	private function check_environment() {

		$return = true;

		/** Check the PHP version compatibility */
		if ( version_compare( PHP_VERSION, self::$min_php, '<=' ) ) {
			$return = false;

			$notice = sprintf( esc_html__( 'Unsupported PHP version Min required PHP Version: "%s"', 'wp-dark-mode-ultimate' ), self::$min_php );
		}

		if ( ! class_exists( 'WP_Dark_Mode' ) ) {
			$return = false;

			$notice
				= sprintf(__( '%1$s requires %2$s to be installed and activated to function properly. %3$s',
				'wp-dark-mode-ultimate' ), '<strong>' . __( 'WP Dark Mode Ultimate', 'wp-dark-mode-ultimate' ) . '</strong>',
				'<strong>' . __( 'WP Dark Mode', 'wp-dark-mode-ultimate' ) . '</strong>',
				'<a href="' . admin_url( '?page=install-wp-dark-mode' )  . '">'
				. __( 'Please click on this link and install WP Dark Mode', 'wp-dark-mode-ultimate' ) . '</a>' );
		}

		if ( ! defined( 'WP_DARK_MODE_VERSION' ) && WP_DARK_MODE_ULTIMATE_VERSION >= '2.0.0' ) {
			$return = false;

			$notice
				= 'WP Dark Mode Ultimate - v2.0.0 requires <a href="'.admin_url('?page=install-wp-dark-mode').'">WP Dark Mode - v2.0.0</a> to function properly. Please, Update <a class="button-primary" href="'.admin_url('?page=install-wp-dark-mode').'">WP Dark Mode to v2.0.0</a>';

		}

		/** Add notice and deactivate the plugin if the environment is not compatible */
		if ( ! $return ) {

			add_action( 'admin_notices', function () use ( $notice ) { ?>
                <div class="notice is-dismissible notice-error">
                    <p><?php echo $notice; ?></p>
                </div>
			<?php } );

			return $return;
		} else {
			return $return;
		}

	}

	/**
	 * Hook into actions and filters.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function init() {

		/** add admin notices */
		add_action( 'admin_notices', [ $this, 'print_notices' ], 15 );

		/** localize our plugin */
		add_action( 'init', [ $this, 'lang' ] );

		add_action( 'admin_init', [$this, 'activation_redirect' ] );

		/** plugin action_links */
		add_filter( 'plugin_action_links_' . plugin_basename( WP_DARK_MODE_ULTIMATE_FILE ), array( $this, 'plugin_action_links' ) );

	}


	public function load_files() {

		include_once WP_DARK_MODE_ULTIMATE_INCLUDES.'/class-enqueue.php';
		include_once WP_DARK_MODE_ULTIMATE_INCLUDES.'/functions.php';
		include_once WP_DARK_MODE_ULTIMATE_INCLUDES.'/class-hooks.php';

		if ( is_admin() ) {
			include_once WP_DARK_MODE_ULTIMATE_INCLUDES.'/class-admin.php';
		}
	}

	/**
	 * Initialize plugin for localization
	 *
	 * @return void
	 * @since 1.0.0
	 *
	 */
	public function lang() {
		load_plugin_textdomain( 'wp-dark-mode-pro', false, dirname( plugin_basename( WP_DARK_MODE_ULTIMATE_FILE ) ) . '/languages/' );
	}

	/**
	 * Plugin action links
	 *
	 * @param   array  $links
	 *
	 * @return array
	 */
	public function plugin_action_links( $links ) {
		$links[] = sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'admin.php?page=wp-dark-mode-settings' ),
			__( 'Settings', 'wp-dark-mode-ultimate' ) );

		global $wp_dark_mode_license;

		if ( ! $wp_dark_mode_license->is_valid() ) {
			$links[] = sprintf( '<a href="%1$s">%2$s</a>', admin_url( 'admin.php?page=wp-dark-mode-license' ), __( 'Activate License', 'wp-dark-mode-ultimate' ) );
		}

		return $links;
	}


	/**
	 * Get the template path.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function template_path() {
		return apply_filters( 'wp_dark_mode_template_path', 'wp-dark-mode/' );
	}

	/**
	 * Returns path to template file.
	 *
	 * @param   null           $name
	 * @param   boolean|array  $args
	 *
	 * @return bool|string
	 * @since 1.0.0
	 */
	public function get_template( $name = null, $args = false ) {
		if ( ! empty( $args ) && is_array( $args ) ) {
			extract( $args );
		}

		$template = locate_template( $this->template_path() . $name . '.php' );

		if ( ! $template ) {
			$template = WP_DARK_MODE_ULTIMATE_TEMPLATES . "/$name.php";
		}

		if ( file_exists( $template ) ) {
			include $template;
		} else {
			return false;
		}
	}

	/**
	 * add admin notices
	 *
	 * @param           $class
	 * @param           $message
	 * @param   string  $only_admin
	 *
	 * @return void
	 */
	public function add_notice( $class, $message, $only_admin = '' ) {

		$notices = get_option( sanitize_key( 'wp_dark_mode_ultimate_notices' ), [] );
		if ( is_string( $message ) && is_string( $class )
		     && ! wp_list_filter( $notices, array( 'message' => $message ) ) ) {

			$notices[] = array(
				'message'    => $message,
				'class'      => $class,
				'only_admin' => $only_admin,
			);

			update_option( sanitize_key( 'wp_dark_mode_ultimate_notices' ), $notices );
		}

	}

	/**
	 * Print the admin notices
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function print_notices() {
		$notices = get_option( sanitize_key( 'wp_dark_mode_ultimate_notices' ), [] );
		foreach ( $notices as $notice ) {

			if ( ! empty( $notice['only_admin'] ) && ! is_admin() ) {
				continue;
			}

			?>
            <div class="notice notice-<?php echo $notice['class']; ?>">
                <p><?php echo $notice['message']; ?></p>
            </div>
			<?php
			update_option( sanitize_key( 'wp_dark_mode_ultimate_notices' ), [] );
		}
	}

	/**
	 * Main WP_Dark_Mode Instance.
	 *
	 * Ensures only one instance of WP_Dark_Mode is loaded or can be loaded.
	 *
	 * @return WP_Dark_Mode_Ultimate - Main instance.
	 * @since 1.0.0
	 * @static
	 */
	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

/** if function `wp_dark_mode_ultimate` doesn't exists yet. */
if ( ! function_exists( 'wp_dark_mode_ultimate' ) ) {
	function wp_dark_mode_ultimate() {
		return WP_Dark_Mode_Ultimate::instance();
	}
}

wp_dark_mode_ultimate();


