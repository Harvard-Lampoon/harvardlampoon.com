<?php
function epcl_display_post_format($format = '', $post_id){

	if( !defined('EPCL_PLUGIN_PATH') ) // If not custom metaboxes, always uses format image
		$format = 'image';

	$prefix = EPCL_THEMEPREFIX.'_';
	switch($format){

        default: // Standard and Image post format
		case 'image':
			return epcl_get_image_format($post_id);
        break;
        
		case 'video':
            return epcl_get_video_format($post_id);
        break;
        
		case 'gallery':
            return epcl_get_gallery_format($post_id);
        break;
        
		case 'audio':
            return epcl_get_audio_format($post_id);
        break;
        
	}
}

function epcl_get_image_format($post_id){
    $index = get_query_var('index');
    $epcl_theme = epcl_get_theme_options();
   
    $post_style = get_query_var('epcl_post_style');
    $epcl_module = epcl_get_module_options();
    $post_meta = get_post_meta( $post_id, 'epcl_post', true );

    $class =  $image_alt = '';
    // Loop
    if( !is_single() ){
        $optimized_image = '';
        $size = 'epcl_single_standard';
        if( !empty( $epcl_module) && $epcl_module['layout'] == 'grid_posts' ){
            $size = 'epcl_single_related';
        }
        $thumb_url = get_the_post_thumbnail_url($post_id, $size);
        // Get optimized image if is assigned one
        if( defined('EPCL_PLUGIN_PATH') && !empty($post_meta) && isset($post_meta['optimized_image']) ){
            $optimized_image = $post_meta['optimized_image'];
            if( !empty($optimized_image) && isset($optimized_image['alt']) ){
                $image_alt = $optimized_image['alt'];
            }            
        }           
        if( !empty($optimized_image) && $optimized_image['url'] ){
            $thumb_url = $optimized_image['url'];
        }
        if( !$thumb_url ){
            $class = 'hidden';
        }
    // Single Post
    }else{
        $single_size = 'epcl_single_standard';
        if( !empty($post_meta) && isset($post_meta['style']) && $post_meta['style'] == 'standard' ){
            $single_size = 'epcl_classic_post';
        }
        if( !empty($epcl_theme) && $epcl_theme['single_post_layout'] === 'standard' ){
            $single_size = 'epcl_classic_post';
        }
        $image_id = get_post_thumbnail_id( get_the_ID() );
        $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
        if( wp_is_mobile() ){
            $single_size = 'epcl_classic_post';
        }
    }
    if( !$image_alt ){
        $image_alt = get_the_title();
    }
    if( is_single() && !has_post_thumbnail() ) return;
    if( $index == 0){
        $epcl_theme['enable_lazyload'] = false;
    }
?>
	<div class="post-format-image post-format-wrapper <?php echo esc_attr($class); ?>">
        <?php if( is_single() ): // Single Post ?>
            <?php if( has_post_thumbnail() ): ?>
                <div class="featured-image">
                    <div class="epcl-loader">
                        <?php the_post_thumbnail( $single_size, array('class' => 'fullwidth', 'data-lazy' => 'false') ); ?>
                    </div>
                    <?php if( epcl_get_option('post_title_layout', 'inside_images') == 'inside_images' ): ?>
                        <div class="info">
                            <h1 class="main-title title"><?php the_title(); ?></h1>    
                        </div>
                    <?php endif; ?>
                    <?php if( epcl_get_option( 'enable_global_comments', true ) || epcl_get_option( 'enable_global_views', true ) || epcl_get_option( 'enable_global_reading_time', true ) ): ?>
                        <!-- start: .meta -->
                        <div class="meta absolute">
                            <?php get_template_part('partials/meta-info-comments'); ?>
                        </div>
                        <!-- end: .meta -->
                    <?php endif; ?>
                </div>
            <?php endif; ?>
		<?php else: // Loops ?>
			<div class="featured-image mask-effect">
                <?php if( $thumb_url ): ?>
                    <a href="<?php the_permalink(); ?>" class="thumb epcl-loader">
                        <?php if( epcl_is_amp() ): ?>
                            <amp-img class="cover" layout="fill" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($image_alt); ?>"></amp-img>
                        <?php else: ?>
                            <?php if( !empty($epcl_theme) && $epcl_theme['enable_lazyload'] == '1' ): ?>
                                <span class="fullimage cover lazy" role="img" aria-label="<?php echo esc_attr($image_alt); ?>" data-src="<?php echo esc_url($thumb_url); ?>"></span>
                            <?php else: ?>
                                <span class="fullimage cover" role="img" aria-label="<?php echo esc_attr($image_alt); ?>" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>  
                    
                <?php if( epcl_get_option('post_title_layout', 'inside_images') == 'inside_images' ): ?>
                    <h1 class="post-title title" data-aos="fade" data-aos-offset="100">
                        <a href="<?php the_permalink(); ?>" class="mask"><?php the_title(); ?></a>
                    </h1>   
                <?php endif; ?>
                
                <a href="<?php the_permalink(); ?>" class="continue-reading button secondary hide-on-mobile"><?php esc_html_e('Continue Reading', 'veen'); ?></a>
  
			</div>
        <?php endif; ?>
    </div>
    
<?php
}

function epcl_get_video_format($post_id){
    $type = 'youtube';
    $height = 225;
    $url = '';

    $epcl_theme = epcl_get_theme_options();
    $post_meta = get_post_meta( $post_id, 'epcl_post_video', true );

	$width = '100%';
    $video_id = $video_url = '';
    $show_featured_image = '';
    if( !empty($post_meta) ){
        $show_featured_image = $post_meta['show_featured_image'];
        $type = $post_meta['video_type'];
        $url = $post_meta['video_url'];
    }    

    if( !is_single() && $show_featured_image ){
        return epcl_get_image_format($post_id);
    }

    $class = '';

	if ($type == 'youtube') {
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
        if( !$url ) return;
		$video_url ='https://www.youtube.com/embed/'.$matches[0].'?rel=0&showinfo=0';
	} elseif ($type == 'vimeo') {
        $result = preg_match('/(\d+)/', $url, $matches);
        if( !$url ) return;
		if($result){
			$video_id = $matches[0];
		}else{
			$video_id = $url;
		}
		$video_url = 'https://player.vimeo.com/video/'.$video_id;
    } elseif ($type == 'custom') {
        $custom_embed = $post_meta['custom_embed'];
        if( !$custom_embed ) return;
        preg_match('/src="([^"]+)"/', $custom_embed, $match);
        $video_url = $match[1];
    }

?>
	<div class="post-format-wrapper epcl-loader <?php echo esc_attr($class); ?>">
        <div class="post-format-video">        
            <?php if( epcl_is_amp() ): ?>
                <amp-iframe layout="responsive" width="480" height="250" sandbox="allow-scripts allow-same-origin allow-popups" title="<?php the_title(); ?>" src="<?php echo esc_url($video_url); ?>" allowfullscreen>
                    <amp-img layout="fill" src="<?php echo EPCL_THEMEPATH; ?>/assets/images/transparent.gif" placeholder></amp-img>
                </amp-iframe>
            <?php else: ?>    
                <?php if( epcl_get_option('enable_lazyload_embed', true) ): ?>
                    <iframe title="<?php the_title(); ?>" data-lazy="true" data-src="<?php echo esc_url($video_url); ?>" allowfullscreen height="<?php echo esc_attr($height); ?>" style="width: <?php echo esc_attr($width); ?>"></iframe>
                <?php else: ?>
                    <iframe title="<?php the_title(); ?>" src="<?php echo esc_url($video_url); ?>" allowfullscreen height="<?php echo esc_attr($height); ?>" style="width: <?php echo esc_attr($width); ?>"></iframe>
                <?php endif; ?>
            <?php endif; ?>
        </div>

    </div>

    <?php if( !is_single() && epcl_get_option('post_title_layout', 'inside_images') == 'inside_images' ): ?>
        <div class="info textcenter">
            <h1 class="main-title title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        </div>
    <?php endif; ?>

<?php
}

function epcl_get_gallery_format($post_id){
    $post_meta = get_post_meta( $post_id, 'epcl_post', true );
    $post_gallery = get_post_meta( $post_id, 'epcl_post_gallery', true );

    if( empty($post_gallery['gallery']) ) return;

    $gallery_images = explode(',', $post_gallery['gallery'] );
    $epcl_theme = epcl_get_theme_options();
    $class = $post_style = '';

    if( !empty($post_meta) ){
        $post_style = $post_meta['style'];
    }    
    
    $size = 'epcl_single_standard';
    if( is_single() && $post_style == 'fullcover' ){
        $size = 'epcl_large';
    }
    $height = 225;
    if( !wp_is_mobile() ){
        $height = 400;
    }
?>
	<div class="post-format-wrapper mask-effect <?php echo esc_attr($class); ?>">

        <div class="post-format-gallery">
            <?php if( epcl_is_amp() ): ?>
                <amp-carousel height="<?php echo absint($height); ?>" layout="fill" type="slides">
                    <?php foreach($gallery_images as $id): ?>
                        <?php
                        $image_url = wp_get_attachment_image_src($id, $size);
                        $image_alt = get_post_meta($id, '_wp_attachment_image_alt', TRUE);
                        ?>
                        <amp-img class="cover" src="<?php echo esc_url( $image_url[0] ); ?>" layout="fill" alt="<?php echo esc_attr( $image_alt ); ?>">
                            <?php if( !is_single() ): ?>
                                <a href="<?php the_permalink(); ?>" class="full-link"></a>
                            <?php endif; ?>
                        </amp-img>
                    <?php endforeach; ?>
                    
                </amp-carousel>
            <?php else: ?>
                <div class="slick-slider" data-rtl="<?php echo is_rtl(); ?>">
                    <?php foreach($gallery_images as $id): ?>
                        <?php
                        $image_url = wp_get_attachment_image_src($id, $size);
                        ?>
                        <div class="item thumb epcl-loader">
                            <?php if( !empty($epcl_theme) && $epcl_theme['enable_lazyload'] == '1' ): ?>
                                <span class="fullimage cover lazy" data-src="<?php echo esc_url( $image_url[0] ); ?>"></span>
                            <?php else: ?>
                                <span class="fullimage cover" style="background-image: url(<?php echo esc_url( $image_url[0] ); ?>);"></span>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="full-link"></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if( epcl_get_option( 'enable_global_comments', true ) || epcl_get_option( 'enable_global_views', true ) || epcl_get_option( 'enable_global_reading_time', true ) ): ?>
                <!-- start: .meta -->
                <div class="meta absolute">
                    <?php get_template_part('partials/meta-info-comments'); ?>
                </div>
                <!-- end: .meta -->
            <?php endif; ?>
        </div>

        <?php if( !is_single() && epcl_get_option('post_title_layout', 'inside_images') == 'inside_images' ): ?>
            <h1 class="post-title title medium" data-aos="fade" data-aos-offset="100">
                <a href="<?php the_permalink(); ?>" class="mask"><?php the_title(); ?></a>
            </h1>
        <?php endif; ?>

	</div>

<?php
}

/* To do: self hosted audio */

function epcl_get_audio_format($post_id){
    $post_meta_audio = get_post_meta( $post_id, 'epcl_post_audio', true );
    if( empty($post_meta_audio) ) return;

    $show_featured_image = $post_meta_audio['show_featured_image'];
    $url = $post_meta_audio['soundcloud_url'];
    
    if( !is_single() && $show_featured_image ){
        return epcl_get_image_format($post_id);
    }

    if( !is_single() && !$show_featured_image && !$url ){
        return;
    }
    
    if( is_single() && !$url ){
        return epcl_get_image_format($post_id);
    }

    $class = '';

	$width = '100%';
	$embed_code = wp_oembed_get( $url );
	preg_match('/src="([^"]+)"/', $embed_code, $match);
	$url = $match[1];
    $url = str_replace('&', '&amp;', $url);
    $height = 225;
?>
    <div class="post-format-audio post-format-wrapper epcl-loader <?php echo esc_attr($class); ?>">
        <?php if( epcl_get_option('enable_lazyload_embed', true) && !epcl_is_amp() ): ?>
            <iframe title="<?php the_title(); ?>" data-lazy="true" data-src="<?php echo esc_url($url); ?>" allowfullscreen height="<?php echo absint($height); ?>" style="width: <?php echo esc_attr($width); ?>"></iframe>
        <?php else: ?>
            <iframe src="<?php echo esc_url($url); ?>" layout="fill" allowFullScreen height="<?php echo absint($height); ?>" style="width: <?php echo esc_attr($width); ?>"></iframe>
        <?php endif; ?>
    </div>
    <?php if( !is_single() && epcl_get_option('post_title_layout', 'inside_images') == 'inside_images' ): ?>
        <div class="info textcenter">
            <h1 class="main-title title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        </div>
    <?php endif; ?>
<?php
}