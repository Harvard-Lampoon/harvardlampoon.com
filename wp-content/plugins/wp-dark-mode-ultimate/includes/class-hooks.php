<?php

/** Block direct access */
defined( 'ABSPATH' ) || exit();

/** check if class `WP_Dark_Mode_Ultimate_Hooks` not exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Ultimate_Hooks' ) ) {
	class WP_Dark_Mode_Ultimate_Hooks {

		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * WP_Dark_Mode_Ultimate_Hooks constructor.
		 */
		public function __construct() {

			if ( 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_color', 'customize_colors', 'off' ) ) {
				add_filter( 'wp_dark_mode/bg_color', [ $this, 'darkmode_bg_color' ] );
				add_filter( 'wp_dark_mode/text_color', [ $this, 'darkmode_text_color' ] );
				add_filter( 'wp_dark_mode/link_color', [ $this, 'darkmode_link_color' ] );
			}

			add_filter( 'wp_dark_mode_ultimate_active', [ $this, 'is_ultimate_active' ] );

			add_action( 'wp_head', [ $this, 'custom_css' ] );

			/** add menu item */
            if( 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'enable_menu_switch', 'off' )) {
	            $switch_menus = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switch_menus', [] );

	            if ( ! empty( $switch_menus ) ) {
		            foreach ( $switch_menus as $switch_menu ) {
			            add_filter( 'wp_nav_menu_' . $switch_menu . '_items', [ $this, 'add_switch_to_menu' ], 10 );
		            }
	            }
            }

			add_filter( 'wp_dark_mode/advanced_settings', [ $this, 'advanced_settings' ] );

		}

		public function advanced_settings( $settings ) {
			$settings['remember_darkmode'] = array(
				'name'    => 'remember_darkmode',
				'default' => 'off',
				'label'   => __( 'Remember Dark Mode', 'wp-dark-mode-ultimate' ),
				'desc'    => __( 'If remember dark mode is on,  browser remembers the user\'s selected mode and shows it to them when they re-open the browser',
					'wp-dark-mode-ultimate' ),
				'type'    => 'switcher',
			);

			return $settings;
		}

		/**
         *Add dark mode switch to menu
         */
		public function add_switch_to_menu( $items ) {
			$style        = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switch_style', '1' );
			$menu_item_li = sprintf( '<li class="wp-dark-mode-menu-item" id="wp-dark-mode-menu-item"><a href="javascript:;"> %1$s</a></li>', do_shortcode( '[wp_dark_mode style=' . $style . ']' ) );

			$items .= $menu_item_li;

			return $items;

		}

		public function custom_css() {
			if ( ! wp_dark_mode_enabled() ) {
				return;
			}

			if ( ! wp_dark_mode()->is_ultimate_active() ) {
				return;
			}

			$scss_compiler = new scssc();

			$custom_css = wp_dark_mode_get_settings( 'wp_dark_mode_custom_css', 'custom_css' );

			$custom_css = sprintf( 'html.wp-dark-mode-active{ %1$s }', $custom_css );


			try {
				printf( '<style id="wp-dark-mode-custom-css">%s</style>', $scss_compiler->compile( $custom_css ) );
			}catch ( Exception $exception ) {

			}

		}

		public function is_ultimate_active() {
			global $wp_dark_mode_license;

			if ( ! $wp_dark_mode_license ) {
				return false;
			}

			$is_ultimate_plan = $wp_dark_mode_license->is_valid_by( 'title', 'WP Dark Mode Ultimate Lifetime' )
			                    || $wp_dark_mode_license->is_valid_by( 'title', 'WP Dark Mode Ultimate Yearly' )
			                    || $wp_dark_mode_license->is_valid_by( 'title', 'Lifetime Ultimate 1 Site' )
			                    || $wp_dark_mode_license->is_valid_by( 'title', 'Lifetime Ultimate 50 Sites' );

			//todo
			$is_valid = $wp_dark_mode_license->is_valid();

			if ( $is_valid ) {

				return true;
			}

			return false;
		}

		public function darkmode_bg_color($color){
			if ( ! empty( wp_dark_mode_get_settings( 'wp_dark_mode_color', 'darkmode_bg_color' ) ) ) {
				$color = wp_dark_mode_get_settings( 'wp_dark_mode_color', 'darkmode_bg_color' );
			}

			return $color;
		}

		public function darkmode_text_color($color){
			if ( ! empty( wp_dark_mode_get_settings( 'wp_dark_mode_color', 'darkmode_text_color' ) ) ) {
				$color = wp_dark_mode_get_settings( 'wp_dark_mode_color', 'darkmode_text_color' );
			}

			return $color;
		}

		public function darkmode_link_color($color){
			if ( ! empty( wp_dark_mode_get_settings( 'wp_dark_mode_color', 'darkmode_link_color' ) ) ) {
				$color = wp_dark_mode_get_settings( 'wp_dark_mode_color', 'darkmode_link_color' );
			}

			return $color;
		}

		public function wp_dark_mode_css_apply(){
			global $wp_dark_mode_license;

			if ( ! $wp_dark_mode_license ) {
				return false;
			}

			$is_ultimate_plan = $wp_dark_mode_license->is_valid_by( 'title', 'WP Dark Mode Ultimate Lifetime' )
			                    || $wp_dark_mode_license->is_valid_by( 'title', 'WP Dark Mode Ultimate Yearly' )
			                    || $wp_dark_mode_license->is_valid_by( 'title', 'Lifetime Ultimate 1 Site' )
			                    || $wp_dark_mode_license->is_valid_by( 'title', 'Lifetime Ultimate 50 Sites' );

			return $wp_dark_mode_license->is_valid() && $is_ultimate_plan;
		}


		/**
		 * @return WP_Dark_Mode_Ultimate_Hooks|null
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}
}

WP_Dark_Mode_Ultimate_Hooks::instance();

