<?php

/** block direct access */
defined( 'ABSPATH' ) || exit();

/** check if class `WP_Dark_Mode_Ultimate_Enqueue` not exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Ultimate_Enqueue' ) ) {
	class WP_Dark_Mode_Ultimate_Enqueue {

		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * WP_Dark_Mode_Ultimate_Enqueue constructor.
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
		}

		public function frontend_scripts( $hook ) {
				wp_enqueue_script('wp-dark-mode-ultimate', WP_DARK_MODE_ULTIMATE_ASSETS.'/js/frontend.min.js', false, WP_DARK_MODE_ULTIMATE_VERSION, true);
		}

		/**
		 * Admin scripts
		 *
		 * @param $hook
		 */
		public function admin_scripts( $hook ) {
			if ( 'wp-dark-mode_page_wp-dark-mode-settings' == $hook ) {
				wp_enqueue_script('wp-dark-mode-ultimate', WP_DARK_MODE_ULTIMATE_ASSETS.'/js/admin.min.js', false, WP_DARK_MODE_ULTIMATE_VERSION, true);
			}

		}

		/**
		 * @return WP_Dark_Mode_Ultimate_Enqueue|null
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

	}
}

WP_Dark_Mode_Ultimate_Enqueue::instance();





