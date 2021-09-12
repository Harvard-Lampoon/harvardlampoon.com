<?php

/** prevent direct access */
defined( 'ABSPATH' ) || exit();

/** check if not class `WP_Dark_Mode_Admin` exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Admin' ) ) {
	class WP_Dark_Mode_Admin {

		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Admin constructor.
		 */
		public function __construct() {
			add_action( 'admin_init', [ $this, 'display_notices' ], 999 );
		}

		public function display_notices() {

			if(class_exists('WP_Dark_Mode_Ultimate')){
				return;
			}

			global $wp_dark_mode_license;

			if ( ! $wp_dark_mode_license->is_valid() ) {
				ob_start();
				wp_dark_mode()->get_template( 'admin/license-notice', [
					'plugin_name' => 'WP Dark Mode PRO',
					'version'     => WP_DARK_MODE_VERSION,
				] );
				$notice_html = ob_get_clean();

				wp_dark_mode_pro()->add_notice( 'warning notice-large is-dismissible', $notice_html );
			}
		}

		/**
		 * @return WP_Dark_Mode_Admin|null
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

	}
}
WP_Dark_Mode_Admin::instance();