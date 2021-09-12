<?php
if ( ! class_exists( 'epcl_ads_125' ) ) {

	class epcl_ads_125 extends WP_Widget{

		function __construct(){
			$widget_ops = array('description' => esc_html_x('Display 125x125 grid ads.', 'admin', 'veen'));
			parent::__construct( false, esc_html_x('(EP) 125x125 Ads', 'admin', 'veen'), $widget_ops);
		}

		function widget($args, $instance){
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);
			echo $before_widget;
				if($title) echo $before_title.$title.$after_title;
				echo '<div class="epcl-banner-wrapper">';
                    if($instance['ads_1'])
                        echo '<div class="epcl-banner-1 epcl-banner">'.$instance['ads_1'].'</div>';
                    if($instance['ads_2'])
                        echo '<div class="epcl-banner-2 epcl-banner">'.$instance['ads_2'].'</div>';
                    if($instance['ads_3'])
                        echo '<div class="epcl-banner-3 epcl-banner">'.$instance['ads_3'].'</div>';
                    if($instance['ads_4'])
                        echo '<div class="epcl-banner-4 epcl-banner">'.$instance['ads_4'].'</div>';
				echo '</div>';

			echo $after_widget;
		}

		function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['ads_1'] = $new_instance['ads_1'];
			$instance['ads_2'] = $new_instance['ads_2'];
			$instance['ads_3'] = $new_instance['ads_3'];
			$instance['ads_4'] = $new_instance['ads_4'];
			return $instance;
		}

		function form($instance){
			$defaults = array(
				'title' => 'Advertise',
				'ads_1' => '',
				'ads_2' => '',
				'ads_3' => '',
				'ads_4' => ''
			);
			$instance = wp_parse_args((array)$instance, $defaults);
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">
					<?php echo esc_html_x('Title:', 'admin', 'veen'); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
				</label>
			</p>
			<p><small><?php echo esc_html_x('Copy and paste your ads code:', 'admin', 'veen'); ?></small></p>
			<p>
				<label for="<?php echo $this->get_field_id('ads_1'); ?>"><?php echo esc_html_x('Ads Block n&ordm; 1:', 'admin', 'veen') ?> </label>
				 <textarea class="widefat" rows="7" id="<?php echo $this->get_field_id('ads_1'); ?>" name="<?php echo $this->get_field_name('ads_1'); ?>"><?php echo $instance['ads_1']; ?></textarea>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('ads_2'); ?>"><?php echo esc_html_x('Ads Block n&ordm; 2:', 'admin', 'veen') ?> </label>
				 <textarea class="widefat" rows="7" id="<?php echo $this->get_field_id('ads_1'); ?>" name="<?php echo $this->get_field_name('ads_2'); ?>"><?php echo $instance['ads_2']; ?></textarea>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('ads_3'); ?>"><?php echo esc_html_x('Ads Block n&ordm; 3:', 'admin', 'veen') ?> </label>
				 <textarea class="widefat" rows="7" id="<?php echo $this->get_field_id('ads_3'); ?>" name="<?php echo $this->get_field_name('ads_3'); ?>"><?php echo $instance['ads_3']; ?></textarea>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('ads_4'); ?>"><?php echo esc_html_x('Ads Block n&ordm; 4:', 'admin', 'veen') ?> </label>
				 <textarea class="widefat" rows="7" id="<?php echo $this->get_field_id('ads_4'); ?>" name="<?php echo $this->get_field_name('ads_4'); ?>"><?php echo $instance['ads_4']; ?></textarea>
			</p>
			<?php
		}

	}

}

function epcl_register_ads_125() {
	register_widget('epcl_ads_125');
}

add_action('widgets_init', 'epcl_register_ads_125');
