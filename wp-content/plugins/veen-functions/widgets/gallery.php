<?php

if ( ! class_exists( 'epcl_gallery' ) ) {
	class epcl_gallery extends WP_Widget{

		function __construct(){
			$widget_ops = array('description' => esc_html_x('Display custom photos in grid layout.', 'admin', 'veen'));
			parent::__construct( false, esc_html_x('(EP) Gallery', 'admin', 'veen'), $widget_ops);
		}

		function widget($args, $instance){
            $epcl_theme = epcl_get_theme_options();
			extract($args);
            $title = apply_filters('widget_title', $instance['title']);
            if( epcl_is_amp() && isset( $epcl_theme['enable_lazyload'] ) ){
                $epcl_theme['enable_lazyload_posts'] = false;
            }
			echo $before_widget;
				if($title) echo $before_title.$title.$after_title;
                if( isset( $instance['images'] ) && $instance['images'] != '' ){
                    $images = explode( ',',  $instance['images'] );
                    $class = 'grid-33 tablet-grid-33 mobile-grid-33';
                    $thumb_size = 'medium';
                    $output = '<div class="epcl-gallery">';
                    $output .= '<ul class="columns-3 np-tablet np-mobile">';
                        $count = 0;
                        foreach($images as $id){
                            $image = get_post( $id ); 
                            $caption = $image->post_excerpt;
                            $description = $image->post_content;
                            if($description == '') $description = $image->post_title;
                            $url = wp_get_attachment_image_src($id, 'ep-large');
                            $thumb_url = wp_get_attachment_image_src($id, $thumb_size);
                            if( isset($epcl_theme['enable_lazyload_posts']) && $epcl_theme['enable_lazyload_posts'] === '1' ){
                                $output .= '
                                <li class="'.$class.'">
                                   <div class="wrapper">
                                       <a href="'.$url[0].'" class="full-image mfp-image hover-effect" title="'.$caption.'"><span class="img cover lazy" data-src="'.$thumb_url[0].'"></span></a>
                                   </div>
                                </li>';
                            }else{
                                $output .= '
                                <li class="'.$class.'">
                                   <div class="wrapper">
                                       <a href="'.$url[0].'" class="full-image mfp-image hover-effect" title="'.$caption.'"><span class="img cover" style="background: url('.$thumb_url[0].');"></span></a>
                                   </div>
                                </li>';
                            }
                            $count++;
                        }
                    $output .= '</ul><div class="clear"></div>';
                    $output .= '</div>';
        
                    echo $output;
                }
			echo $after_widget;
		}

		function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['images'] = $new_instance['images'];
			return $instance;
		}

		function form($instance){
			$defaults = array(
				'title' => 'Gallery',
				'images' => ''
			);
			$instance = wp_parse_args((array)$instance, $defaults);
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">
					<?php echo esc_html_x('Title:', 'admin', 'veen'); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
				</label>
			</p>
       
            <label for="<?php echo $this->get_field_id('images'); ?>"><?php echo esc_html_x( 'Galllery:', 'admin', 'veen'); ?></label>    
            <div class="csf csf-widgets csf-fields">
                <div class="csf-field csf-field-gallery">
                    <ul>
                    <?php
                        $hidden = ( empty( $instance['images'] ) ) ? ' hidden' : '';
                        if( ! empty( $instance['images'] ) ) {
                            $values = explode( ',', $instance['images']);
                            foreach ( $values as $id ) {
                                $attachment = wp_get_attachment_image_src( $id, 'thumbnail' );
                                echo '<li><img src="'. $attachment[0] .'" /></li>';
                            }
                        }
                        ?>                    
                    </ul>
                    <a href="#" class="button button-primary csf-button"><?php echo esc_html_x('Add Images', 'admin', 'veen'); ?></a>
                    <a href="#" class="button csf-edit-gallery <?php echo $hidden; ?>"><?php echo esc_html_x('Edit Gallery', 'admin', 'veen'); ?></a>
                    <a href="#" class="button csf-warning-primary csf-clear-gallery <?php echo $hidden; ?>"><?php echo esc_html_x('Clear', 'admin', 'veen'); ?></a>
                    <input id="<?php echo $this->get_field_id('images'); ?>" type="text" name="<?php echo $this->get_field_name('images'); ?>" value="<?php echo $instance['images']; ?>">
                </div>
            </div>
   
			<?php

		}

	}

	function epcl_register_gallery() {
		register_widget('epcl_gallery');
	}

	add_action('widgets_init', 'epcl_register_gallery');
}
