<?php
$epcl_module = epcl_get_module_options();
if( empty($epcl_module) ) return; // no data from carousel module
$prefix = EPCL_THEMEPREFIX.'_';
$args = array(
	'post_type' => 'post',
	'showposts' => $epcl_module['posts_carousel_limit'],
	'suppress_filters' => false,
	'meta_key' => '_thumbnail_id'
);

if( !empty($epcl_module) ){
    // Categories filters
    if( isset($epcl_module['featured_categories']) && $epcl_module['featured_categories'] != '' ){
        $args['cat'] = $epcl_module['featured_categories'];
    }
    if( isset($epcl_module['excluded_categories']) && $epcl_module['excluded_categories'] != '' ){
        $args['category__not_in'] = $epcl_module['excluded_categories'];
    }
    // Order by: Date, Views, Name
    if( isset($epcl_module['orderby']) && $epcl_module['orderby'] != '' ){
        $args['orderby'] = $epcl_module['orderby'];
        if( $epcl_module['orderby'] == 'views' ){
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'views_counter';
        }
    }
    // Posts order: ASC, DESC
    if( isset($epcl_module['posts_order']) && $epcl_module['posts_order'] != '' ){
        $args['order'] = $epcl_module['posts_order'];
    }
    // Filter by date (year, month, etc)
    if( isset($epcl_module['date']) && $epcl_module['date'] != 'alltime' ){
        $year = date('Y');
        $month = absint( date('m') );
        $week = absint( date('W') );
    
        $args['year'] = $year;
    
        if( $epcl_module['date'] == 'pastmonth' ){
            $args['monthnum'] = $month - 1;
        }
        if( $epcl_module['date'] == 'pastweek' ){
            $args['w'] = $week - 1;
        }
        if( $epcl_module['date'] == 'pastyear' ){
            unset( $args['year'] );
            $today = getdate();
            $args['date_query'] = array(
                array(
                    'after' => $today[ 'month' ] . ' 1st, ' . ($today[ 'year' ] - 2)
                )
            );
        }
    }
}

$carousel = get_posts($args);
$thumbnail_size = 'epcl_single_related';
if($epcl_module['posts_carousel_show_limit'] == 1){
	$thumbnail_size = 'large';
}
?>

<?php if( !empty($carousel) ): ?>
	<!-- start: .carousel -->
	<section class="epcl-carousel slick-slider section outer-arrows slides-<?php echo intval( $epcl_module['posts_carousel_show_limit'] ); ?>" data-show="<?php echo intval( $epcl_module['posts_carousel_show_limit'] ); ?>" data-rtl="<?php echo is_rtl(); ?>" id="<?php echo wp_unique_id('epcl-post-carousel-'); ?>">
		<?php foreach($carousel as $post): setup_postdata($post); ?>
        	<?php
                $image_id = get_post_thumbnail_id($post->ID);
                $thumb = wp_get_attachment_image_src( $image_id, 'epcl_single_content', $thumbnail_size );
                $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
				$image_url = $thumb[0];
                if( defined('EPCL_PLUGIN_PATH') && !empty($post_meta) ){
                    if( isset( $post_meta['optimized_image'] ) && $post_meta['optimized_image']['url'] != '' ){
                        $optimized_image = $post_meta['optimized_image_slider'];
                    }                    
                    if( isset($optimized_image['alt']) && $optimized_image['alt'] != ''){
                        $image_alt = $optimized_image['alt'];
                    }                    
                    if( !empty($optimized_image) ){
                        $image_url = $optimized_image['url'];
                    }
                }               
                if( !$image_alt ){
                    $image_alt = get_the_title();
                }
                $author_id = get_the_author_meta('ID');
                $user_meta = get_user_meta( $author_id, 'epcl_user', true );
                if( !empty($user_meta) && !empty( $user_meta['avatar']) && $user_meta['avatar']['url'] != '' ){
                    $author_avatar = $user_meta['avatar']['url'];
                }else{
                    $author_avatar = get_avatar_url( get_the_author_meta('email'), array( 'size' => 120 ));
                }
                $author_name = get_the_author();
			?>
            <div class="item">
                <article>
                    
                    <!-- <img class="img" src="<?php echo EPCL_THEMEPATH; ?>/assets/images/transparent.gif" alt="<?php echo esc_attr($image_alt); ?>" data-lazy="<?php echo esc_url($image_url); ?>"> -->
                    <div class="epcl-loader">
                        <?php if( epcl_get_option('enable_lazyload') == '1' ): ?>
                            <div class="img cover lazy" src="<?php echo EPCL_THEMEPATH; ?>/assets/images/transparent.gif" data-src="<?php echo esc_url($image_url); ?>"></div>
                        <?php else: ?>
                            <div class="img cover" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
                        <?php endif; ?>
                    </div>
                    
					<div class="info mask-effect">
						<h2 class="title medium mask"><?php the_title(); ?></h2>
                        <div class="clear"></div>
                        <?php if( $epcl_module['posts_carousel_enable_author'] ): ?>
                            <div class="meta">
                                <a href="<?php echo get_author_posts_url($author_id); ?>" title="<?php echo esc_attr__('Author:', 'veen').' '.esc_attr($author_name); ?>" class="author meta-info">
                                    <?php if($author_avatar): ?>
                                        <span class="author-image cover" style="background-image: url('<?php echo esc_url($author_avatar); ?>');"></span>
                                    <?php endif; ?>
                                    <span class="author-name"><?php echo esc_attr($author_name); ?></span>
                                </a>
                                <time class="meta-info" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time( get_option('date_format') ); ?></time>
                                <div class="clear"></div>
                            </div>
                        <?php endif; ?>
					</div>

					<div class="clear"></div>

					<a href="<?php the_permalink(); ?>" class="full-link" aria-label="<?php the_title(); ?>"><span style="display:none;"><?php the_title(); ?></span></a>
                    <?php if( $epcl_module['posts_carousel_enable_author'] ): ?>
					    <div class="overlay"></div>
                    <?php endif; ?>
                </article>
            </div>
        <?php endforeach; wp_reset_postdata(); ?>
	</section>
	<!-- end: .carousel -->
<?php endif; ?>