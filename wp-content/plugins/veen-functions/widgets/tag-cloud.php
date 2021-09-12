<?php
if ( ! class_exists( 'epcl_tag_cloud' ) ) {
	class epcl_tag_cloud extends WP_Widget{

		function __construct(){
			$widget_ops = array( 'description' => esc_html_x('Display tags or categories with limit and special filters.', 'admin', 'veen') );
			parent::__construct( false, esc_html_x('(EP) Tag Cloud', 'admin', 'veen'), $widget_ops);
		}

		function widget($args, $instance){
		    global $epcl_theme;
			extract($args);
			$title = apply_filters('widget_title', $instance['title']); 


			echo $before_widget;
				if($title) echo $before_title.$title.$after_title;
				if(!$instance['limit']) $instance['limit'] = 15;
                if(!$instance['orderby']) $instance['orderby'] = 'name';
                if(!$instance['order']) $instance['order'] = 'ASC';
                if(!$instance['taxonomy']) $instance['taxonomy'] = 'category';

                $categories = get_terms(array(
                    'taxonomy' => $instance['taxonomy'],
                    'orderby' => $instance['orderby'],
                    'order' => $instance['order'],
                    'number' => $instance['limit'],
                ));

                
                $html = '<div class="tagcloud '.$class.'">';
                $i = 0;
                foreach($categories as $c){
                    $count = '';
                    if( $instance['count'] ){
                        $count = ' ('.$c->count.') ';
                    }
                    $html .= '<a href="'.get_category_link($c).'" class="tag-link-'.$c->term_id.' tag-cloud-link">'.$c->name.$count.'</a>';
                    $i++;
                }
                $html .= '</div>';

                echo $html;

			echo $after_widget;
		}

		function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['limit'] = (int) $new_instance['limit'];
            $instance['orderby'] = $new_instance['orderby'];
            $instance['order'] = $new_instance['order'];
            $instance['count'] = $new_instance['count'];
            $instance['taxonomy'] = $new_instance['taxonomy'];
			return $instance;
		}

		function form($instance){
			$defaults = array(
				'title' => 'Tag Cloud',
				'limit' => 10,
                'orderby' => 'name',
                'order' => 'ASC',
                'count' => '',
                'taxonomy' => 'category'
			);
			$instance = wp_parse_args((array)$instance, $defaults);
			$limit = isset( $instance['limit'] ) ? absint( $instance['limit'] ) : 10;
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">
					<?php echo esc_html_x('Title:', 'admin', 'veen'); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('limit'); ?>"><?php echo esc_html_x( 'Max number of elements to display:', 'admin', 'veen'); ?></label>
				<input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" size="3" />
            </p>
            <p>
				<label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php echo esc_html_x('Taxonomy (mode):', 'admin', 'veen') ?> </label>
				<select id="<?php echo $this->get_field_id('taxonomy'); ?>" name="<?php echo $this->get_field_name('taxonomy'); ?>">
					<option <?php if ($instance['taxonomy'] == 'category') echo 'selected="selected"'; ?> value="category"><?php echo esc_html_x('Post Category', 'admin', 'veen'); ?></option>
                    <option <?php if ($instance['taxonomy'] == 'post_tag') echo 'selected="selected"'; ?> value="post_tag"><?php echo esc_html_x('Post Tags', 'admin', 'veen'); ?></option>
				</select>
            </p>
            <p>
				<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php echo esc_html_x('Order By:', 'admin', 'veen') ?> </label>
				<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
					<option <?php if ($instance['orderby'] == 'name') echo 'selected="selected"'; ?> value="name"><?php echo esc_html_x('Name', 'admin', 'veen'); ?></option>
                    <option <?php if ($instance['orderby'] == 'count') echo 'selected="selected"'; ?> value="count"><?php echo esc_html_x('Count', 'admin', 'veen'); ?></option>
				</select>
            </p>
            <p>
				<label for="<?php echo $this->get_field_id('order'); ?>"><?php echo esc_html_x('Order:', 'admin', 'veen') ?> </label>
				<select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
					<option <?php if ($instance['order'] == 'ASC') echo 'selected="selected"'; ?> value="ASC"><?php echo esc_html_x('Ascendant', 'admin', 'veen'); ?></option>
                    <option <?php if ($instance['order'] == 'DESC') echo 'selected="selected"'; ?> value="DESC"><?php echo esc_html_x('Descendant', 'admin', 'veen'); ?></option>
				</select>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('count'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('count'); ?>" <?php if ($instance['count'] ) echo 'checked="checked"'; ?>>
                <label for="<?php echo $this->get_field_id('count'); ?>"><?php echo esc_html_x('Show tag counts', 'admin', 'veen'); ?></label>
            </p>
			<?php
		}

	}

	function epcl_register_tag_cloud() {
		register_widget('epcl_tag_cloud');
	}

	add_action('widgets_init', 'epcl_register_tag_cloud');

}
