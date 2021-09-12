<?php

/** Block direct access */
defined( 'ABSPATH' ) || exit();

/** check if class `WP_Dark_Mode_Shortcode` not exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Shortcode' ) ) {
	class WP_Dark_Mode_Shortcode {

		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * WP_Dark_Mode_Shortcode constructor.
		 */
		public function __construct() {
			add_shortcode( 'wp_dark_mode', [ $this, 'render_dark_mode_btn' ] );
		}

		/**
		 * render the dark mode switcher button
		 */
		public function render_dark_mode_btn( $atts ) {

			if ( ! wp_dark_mode_enabled() ) {
				return false;
			}

			$atts = shortcode_atts(
                [
					'floating' => 'no',
					'class'    => '',
					'style'    => 1,
				], $atts
            );

			$custom_icon = false;

			if ( $this->wp_dark_mode_common() ) {
				$custom_icon = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'custom_switch_icon', 'off' );
			}

			ob_start();

			if ( $custom_icon ) {
				wp_dark_mode()->get_template( 'btn-custom', $atts );
			} else {
				if ( file_exists( WP_DARK_MODE_TEMPLATES . "/btn-{$atts['style']}.php" ) ) {
					wp_dark_mode()->get_template( "btn-{$atts['style']}", $atts );
				} else {
					wp_dark_mode()->get_template( 'btn-1', $atts );
				}
			}

			$html = ob_get_clean();
			return $html;
		}

		private function wp_dark_mode_common() {
			global $wp_dark_mode_license;

			if ( ! $wp_dark_mode_license ) {
				return false;
			}

			return $wp_dark_mode_license->is_valid();
		}

		/**
		 * @return WP_Dark_Mode_Shortcode|null
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}


	}
}

WP_Dark_Mode_Shortcode::instance();

