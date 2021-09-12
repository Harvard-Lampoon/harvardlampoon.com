<?php
if ( ! class_exists( 'epcl_related_articles' ) ) {
	class epcl_related_articles extends WP_Widget{

		function __construct(){
			$widget_ops = array('description' => esc_html_x('Display related articles from the current post.', 'admin', 'veen') );
			parent::__construct( false, esc_html_x('(EP) Related Articles', 'admin', 'veen'), $widget_ops);
		}

		function widget($args, $instance){
		    global $epcl_theme;
			extract($args);
            $title = apply_filters('widget_title', $instance['title']);
            $post_id = get_the_ID();
            $args = array(
                'posts_per_page' => $instance['number'],
                'category__in' => wp_get_post_categories($post_id),
                'post__not_in' => array($post_id),
                'post_type' => 'post',
                'order' => 'DESC',
            );
            $query = new WP_Query($args);
            if( !$query->have_posts() || !is_single() ) return;
			echo $before_widget;
				if($title) echo $before_title.$title.$after_title;
				if(!$instance['number']) $instance['number'] = 5;
                if(!$instance['category']) $instance['category'] = '';

                if( $query->have_posts() ):
                    while( $query->have_posts() ): $query->the_post();
                        include( 'partials/loop-article.php' );
                    endwhile;
                    wp_reset_postdata();
                endif;

			echo $after_widget;
		}

		function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['number'] = (int) $new_instance['number'];
			$instance['category'] = $new_instance['category'];
			return $instance;
		}

		function form($instance){
			$defaults = array(
				'title' => 'Related Articles',
				'number' => 5,
				'category' => ''
			);
			$instance = wp_parse_args((array)$instance, $defaults);
			$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">
					<?php echo esc_html_x('Title:', 'admin', 'veen'); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php echo esc_html_x( 'Number of posts to show:', 'admin', 'veen'); ?></label>
				<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
			</p>
			<?php
		}

	}

	function epcl_register_related_articles() {
		register_widget('epcl_related_articles');
	}

	add_action('widgets_init', 'epcl_register_related_articles');

}
