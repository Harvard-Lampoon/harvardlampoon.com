<?php
if ( ! class_exists( 'EPCL_tweets' ) ) {
	class epcl_tweets extends WP_Widget{

		function __construct(){
			$widget_ops = array('description' => esc_html_x('Display recent tweets.', 'admin', 'veen'));
			parent::__construct( false, esc_html_x('(EP) Recent Tweets', 'admin', 'veen'), $widget_ops);
		}

		function widget($args, $instance){
			extract($args);
            $title = apply_filters('widget_title', $instance['title']);
            $exclude_replies = isset( $instance[ 'exclude_replies' ] ) && $instance[ 'exclude_replies' ] ? true : false;
			echo $before_widget;
				if($title) echo $before_title.$title.$after_title;
				if(!$instance['number']) $instance['number'] = 3;
				require_once(EPCL_PLUGIN_PATH.'/twitter_api/Creare_Twitter.php');

				$twitter = new Creare_Twitter();
				$twitter->screen_name = $instance['twitter_id'];
				$twitter->not = $instance['number'];

				$twitter->consumerkey = "yxwpQgf60mGvGqHmUm3NxMc0e";
				$twitter->consumersecret = "UF97WKH1JstjGeoTuH8Ns2U9kA0H5XjJGyHnmkWQYafqE4Wswt";
				$twitter->accesstoken = "1318265592433004544-sSxwZSRz9qnx42nqdea1QI6yigqrWz";
				$twitter->accesstokensecret = "phkgLgDf4NreSHrXGXKts4uOrpbO5rKNgC9ym6Xm4szZs";
                $tweets = $twitter->getLatestTweets( $exclude_replies );
                
                if( !empty($tweets) ){
                    $i = 0;
                    foreach($tweets as $t){
                        if( $instance['number'] == $i ){
                            break;
                        }
                        echo '<p><i class="fa fa-twitter"></i>'.$t['tweet'].'<br><small>'.$t['time'].'</small></p>';  
                        $i++;
                    }
                }else{
                    "<p>Tweets cant be loaded.</p>";
                }

			echo $after_widget;
		}

		function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['number'] = (int) $new_instance['number'];
            $instance['twitter_id'] = $new_instance['twitter_id'];
            $instance[ 'exclude_replies' ] = $new_instance[ 'exclude_replies' ];
			return $instance;
		}

		function form($instance){
			$defaults = array(
				'title' => 'Recent Tweets',
				'number' => 3,
                'twitter_id' => '',
                'exclude_replies' => ''
			);
			$instance = wp_parse_args((array)$instance, $defaults);
            $number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
            $exclude_replies = $instance[ 'exclude_replies' ] ? true : false;
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">
					<?php echo esc_html_x('Title:', 'admin', 'veen'); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php echo esc_html_x( 'Number of tweets to show:', 'admin', 'veen'); ?></label>
				<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('twitter_id'); ?>">
					<?php echo esc_html_x('Twitter ID: (without @)', 'admin', 'veen'); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $instance['twitter_id']; ?>" />
				</label>
			</p>
            <p>
                <input class="checkbox" type="checkbox" <?php checked( $exclude_replies ); ?> id="<?php echo $this->get_field_id( 'exclude_replies' ); ?>" name="<?php echo $this->get_field_name( 'exclude_replies' ); ?>" />
                <label for="<?php echo $this->get_field_id( 'exclude_replies' ); ?>"> <?php esc_html_e( 'Exclude Replies', 'epcl_framework'); ?></label>
            </p>
			<?php
		}

	}
}

function epcl_register_tweets() {
	register_widget('epcl_tweets');
}

add_action('widgets_init', 'epcl_register_tweets');
