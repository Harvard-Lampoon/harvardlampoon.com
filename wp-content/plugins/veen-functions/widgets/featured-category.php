<?php
if ( ! class_exists( 'epcl_featured_category' ) ) {
	class epcl_featured_category extends WP_Widget{

		function __construct(){
			$widget_ops = array( 'description' => esc_html_x('Display posts from a certain category.', 'admin', 'veen') );
			parent::__construct( false, esc_html_x('(EP) Posts by Category', 'admin', 'veen'), $widget_ops);
		}

		function widget($args, $instance){
		    global $epcl_theme;
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);
			$args = array(
				'posts_per_page' => $instance['number'],
				'cat' => $instance['category'],
				'post_type' => 'post',
				'order' => 'DESC',
            );
            
            if( is_single() ){
                $args['post__not_in'] = array( get_the_ID() );
            }
            
			$query = new WP_Query($args);
			if( !$query->have_posts() ) return;
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
				'title' => 'Featured posts',
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
			<p>
				<label for="<?php echo $this->get_field_id('category'); ?>"><?php echo esc_html_x('Category:', 'admin', 'veen') ?> </label>
				<?php wp_dropdown_categories( array('name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] ) ); ?>
			</p>
			<?php
		}

	}

	function epcl_register_featured_category() {
		register_widget('epcl_featured_category');
	}

	add_action('widgets_init', 'epcl_register_featured_category');

}
