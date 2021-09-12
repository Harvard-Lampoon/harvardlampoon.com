<?php

/** prevent direct access */
defined( 'ABSPATH' ) || exit();

/** check if not class `WP_Dark_Mode_Ultimate_Admin` exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Ultimate_Admin' ) ) {
	class WP_Dark_Mode_Ultimate_Admin {

		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Admin constructor.
		 */
		public function __construct() {
			add_action( 'admin_init', [ $this, 'display_notices' ] );
		}

		public function display_notices() {

			global $wp_dark_mode_license;

			if ( ! $wp_dark_mode_license->is_valid() ) {

				ob_start();
				wp_dark_mode()->get_template( 'admin/license-notice', [
					'plugin_name' => 'WP Dark Mode Ultimate',
					'version'     => WP_DARK_MODE_ULTIMATE_VERSION,
				] );
				$notice_html = ob_get_clean();

				wp_dark_mode_ultimate()->add_notice( 'warning notice-large is-dismissible', $notice_html );
			}
		}

		/**
		 * @return WP_Dark_Mode_Ultimate_Admin|null
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

	}
}

WP_Dark_Mode_Ultimate_Admin::instance();