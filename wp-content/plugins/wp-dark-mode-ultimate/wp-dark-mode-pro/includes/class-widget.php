<?php

/** block direct access */
defined( 'ABSPATH' ) || exit();

/** check if class `WP_Dark_Mode_Pro_Widget` not exists yet */
if ( ! class_exists( 'WP_Dark_Mode_Pro_Widget' ) ) {
	class WP_Dark_Mode_Pro_Widget extends WP_Widget {

		/**
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Sets up the widgets name etc
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'   => 'wp_dark_mode_widget',
				'description' => esc_html__( 'Display dark mode switcher button.', 'wp-dark-mode-ultimate' ),
			);

			parent::__construct( 'wp_dark_mode', __( 'WP Dark Mode', 'wp-dark-mode-ultimate' ), $widget_ops );

			add_action( 'widgets_init', [ $this, 'register_widget' ] );
		}

		/**
		 * Outputs the content of the widget
		 *
		 * @param   array  $args
		 * @param   array  $instance
		 */
		public function widget( $args, $instance ) {
		    $style = !empty($instance['style']) ? $instance['style'] : 1;
			$alignment = ! empty( $instance['alignment'] ) ? $instance['alignment'] : 'right';

			echo $args['before_widget'];
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
			}

			printf('<div style="text-align: %s;">', $alignment);
			echo do_shortcode( "[wp_dark_mode_switch style=$style]" );
			echo '</div>';

			echo $args['after_widget'];
		}

		/**
		 * Outputs the options form on admin
		 *
		 * @param   array  $instance  The widget options
		 */
		public function form( $instance ) {
			$title     = ! empty( $instance['title'] ) ? $instance['title'] : '';
			$style     = ! empty( $instance['style'] ) ? $instance['style'] : '';
			$alignment = ! empty( $instance['alignment'] ) ? $instance['alignment'] : '';
			?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:',
						'wp-dark-mode-ultimate' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
            </p>

            <p>Switch Style:</p>
            <div class="switch-style-choose">

				<?php

				for ( $i = 1; $i <= 7; $i ++ ) {
					printf( '
                    <div class="switch-style-choose-group %6$s">
                        <input class="widefat" id="%1$s" name="%3$s" type="radio" value="%5$s" %4$s>
                        <label for="%1$s"><img src="%2$s"></label>
                    </div>
                    ',
                        $this->get_field_id( "style-$i" ), WP_DARK_MODE_ASSETS . "/images/button-presets/$i.svg",
                        $this->get_field_name( "style" ),
                        1 == $i && empty($style) ? 'checked' : checked($i, $style, false),
                        $i,
						$i == $style ? 'checked' : ''
                    );
				}

				?>

            </div>

            <p class="wp-dark-mode-switcher-widget">
                <label for="<?php echo esc_attr( $this->get_field_id( 'alignment' ) ); ?>">
					<?php esc_attr_e( 'Position Alignment:', 'wp-dark-mode-ultimate' ); ?>
                </label>

                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'alignment' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'alignment' ) ); ?>">
                    <option value="left" <?php selected( 'left', $alignment ); ?>><?php esc_html_e( 'Left',
			                'wp-dark-mode-ultimate' ); ?></option>

                    <option value="center" <?php selected( 'center', $alignment ); ?>><?php esc_html_e( 'Center',
			                'wp-dark-mode-ultimate' ); ?></option>

                    <option value="right" <?php selected( 'right', $alignment ); ?>><?php esc_html_e( 'Right',
			                'wp-dark-mode-ultimate' ); ?></option>
                </select>
                <span><?php _e( 'Choose the button alignment.', 'wp-dark-mode-ultimate' ); ?></span>
            </p>

			<?php
		}

		/**
		 * Processing widget options on save
		 *
		 * @param   array  $new_instance  The new options
		 * @param   array  $old_instance  The previous options
		 *
		 * @return array
		 */
		public function update( $new_instance, $old_instance ) {
			$instance              = array();
			$instance['title']     = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
			$instance['alignment'] = ( ! empty( $new_instance['alignment'] ) ) ? sanitize_text_field( $new_instance['alignment'] ) : '';
			$instance['style'] = ( ! empty( $new_instance['style'] ) ) ? sanitize_text_field( $new_instance['style'] ) : '';

			return $instance;
		}

		/**
		 * register widget
		 */
		public function register_widget() {
			register_widget( __CLASS__ );
		}

		/**
		 * @return WP_Dark_Mode_Pro_Widget|null
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}
	}
}

WP_Dark_Mode_Pro_Widget::instance();