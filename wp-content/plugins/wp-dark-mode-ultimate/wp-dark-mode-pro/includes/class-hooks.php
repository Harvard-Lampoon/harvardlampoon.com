<?php

/** Block direct access */
defined( 'ABSPATH' ) || exit();

/** check if class `WP_Dark_Mode_Hooks_Pro` not exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Hooks_Pro' ) ) {
	class WP_Dark_Mode_Hooks_Pro {

		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * WP_Dark_Mode_Hooks_Pro constructor.
		 */
		public function __construct() {

			add_filter( 'the_content', array( $this, 'render_post_page_switcher' ), 999 );

			add_filter( 'wp_dark_mode_pro_active', [ $this, 'is_pro_active' ] );

			add_filter( 'wp_dark_mode/color_presets', [ $this, 'color_presets' ] );

			add_action( 'admin_footer', [ $this, 'admin_footer_scripts' ] );
		}


		public function admin_footer_scripts() {

			global $current_screen;

			if ( empty( $current_screen ) || 'wp-dark-mode_page_wp-dark-mode-settings' != $current_screen->id ) {
				return;
			}

			?>
            <script>
                ;(function ($) {
                    $(document).ready(function () {

                        //custom css
                        if (wpDarkMode.is_settings_page) {
                            wp.codeEditor.initialize($('.custom_css textarea'), wpDarkMode.cm_settings);
                        }

                        //switch menus
                        if ($('.switch_menus select').length) {
                            $('.switch_menus select').select2({
                                placeholder: 'Select Menus',
                                multiple: true,
                            });
                        }

                        //exclude pages
                        if ($('.exclude_pages select').length) {
                            $('.exclude_pages select').select2({
                                placeholder: 'Select Pages',
                                multiple: true,
                            });
                        }

                        //exclude pages
                        if ($('.specific_categories select').length) {
                            $('.specific_categories select').select2({
                                placeholder: 'Select Categories',
                                multiple: true,
                            });
                        }


                    });
                })(jQuery);
            </script>
		<?php }

		public function is_pro_active() {
			global $wp_dark_mode_license;

			if ( ! $wp_dark_mode_license ) {
				return false;
			}

			$is_pro_plan = $wp_dark_mode_license->is_valid_by( 'title', 'WP Dark Mode Pro Lifetime' )
			               || $wp_dark_mode_license->is_valid_by( 'title', 'WP Dark Mode Pro Yearly' );

			return $wp_dark_mode_license->is_valid() && $is_pro_plan;
		}


		public function color_presets( $color_presets ) {
			$color_presets = array_merge( $color_presets, [

				[
					'bg'   => '#270000',
					'text' => '#fff',
					'link' => '#FF7878',
				],
				[
					'bg'   => '#160037',
					'text' => '#EBEBEB',
					'link' => '#B381FF',
				],
				[
					'bg'   => '#121212',
					'text' => '#E6E6E6',
					'link' => '#FF9191',
				],
				[
					'bg'   => '#000A3B',
					'text' => '#FFFFFF',
					'link' => '#3AFF82',
				],
				[
					'bg'   => '#171717',
					'text' => '#BFB7C0',
					'link' => '#F776F0',
				],
				[
					'bg'   => '#003711',
					'text' => '#FFFFFF',
					'link' => '#84FF6D',
				],
				[
					'bg'   => '#23243A',
					'text' => '#D6CB99',
					'link' => '#FF9323',
				],
				[
					'bg'   => '#151819',
					'text' => '#D5D6D7',
					'link' => '#DAA40B',
				],
				[
					'bg'   => '#18191A',
					'text' => '#DCDEE3',
					'link' => '#2D88FF',
				],
				[
					'bg'    => '#141d26',
					'text'  => '#fff',
					'link'  => '#1C9CEA',
				],
			] );

			return $color_presets;
		}

		/**
		 * @param $content
		 *
		 * @return string
		 */
		public function render_post_page_switcher( $content ) {

			if ( ! wp_dark_mode_enabled() ) {
				return $content;
			}

			$above_post = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'show_above_post' );
			$above_page = 'on' == wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'show_above_page' );
			$style      = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switch_style', '1' );

			if ( $above_post && is_single() && in_the_loop() && is_main_query() ) {
				$content = do_shortcode( "[wp_dark_mode style='$style' class='post_page' ]" ) . $content;
			}

			if ( $above_page && is_page() && in_the_loop() && is_main_query() ) {
				$content = do_shortcode( "[wp_dark_mode style='$style' class='post_page' ]" ) . $content;
			}



			return $content;
		}

		/**
		 * @return WP_Dark_Mode_Hooks_Pro|null
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}
}

WP_Dark_Mode_Hooks_Pro::instance();

