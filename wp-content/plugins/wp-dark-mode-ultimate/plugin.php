<?php
/**
 * Plugin Name: WP Dark Mode Ultimate
 * Plugin URI:  https://wppool.dev/wp-dark-mode
 * Description: WP Dark Mode automatically enables a stunning dark mode of your website based on user's operating system. Supports macOS, Windows, Android & iOS.
 * Version:     2.0.1
 * Author:      WPPOOL
 * Author URI:  http://wppool.com
 * Text Domain: wp-dark-mode-ultimate
 * Domain Path: /languages/
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

/** don't call the file directly */
defined( 'ABSPATH' ) || wp_die( __( 'You can\'t access this page', 'wp-dark-mode-ultimate' ) );

if ( ! class_exists( 'WP_Dark_Mode_Ultimate' ) ) {
	/** Define Constants */
	define( 'WP_DARK_MODE_ULTIMATE_VERSION', '2.0.1' );
	define( 'WP_DARK_MODE_ULTIMATE_FILE', __FILE__ );
	define( 'WP_DARK_MODE_ULTIMATE_PATH', dirname( WP_DARK_MODE_ULTIMATE_FILE ) );
	define( 'WP_DARK_MODE_ULTIMATE_INCLUDES', WP_DARK_MODE_ULTIMATE_PATH . '/includes/' );
	define( 'WP_DARK_MODE_ULTIMATE_URL', plugins_url( '', WP_DARK_MODE_ULTIMATE_FILE ) );
	define( 'WP_DARK_MODE_ULTIMATE_ASSETS', WP_DARK_MODE_ULTIMATE_URL . '/assets/' );
	define( 'WP_DARK_MODE_ULTIMATE_TEMPLATES', WP_DARK_MODE_ULTIMATE_PATH . '/templates/' );

	/** load the pro plugin */
	require WP_DARK_MODE_ULTIMATE_PATH . '/wp-dark-mode-pro/plugin.php';

	/** do the activation stuff */
	register_activation_hook( __FILE__, function () {
		require WP_DARK_MODE_ULTIMATE_INCLUDES . 'class-install.php';
	} );

	/** load the main plugin */
	add_action( 'plugins_loaded', function () {
		require WP_DARK_MODE_ULTIMATE_INCLUDES . 'base.php';
	} );

	add_action( 'admin_menu', function () {
		add_submenu_page( '', '', '', 'manage_options', 'install-wp-dark-mode', 'wp_dark_mode_ultimate_install_wp_dark_mode' );
	} );

	function wp_dark_mode_ultimate_install_wp_dark_mode() {
		include_once WP_DARK_MODE_ULTIMATE_INCLUDES . '/install-wp-dark-mode.php';
	}

}