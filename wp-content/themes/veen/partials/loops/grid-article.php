<?php
$epcl_theme = epcl_get_theme_options();
$epcl_module = epcl_get_module_options();

$index = absint( get_query_var('index') );

$column_class = 'grid-33';
$grid_posts_column = 3;
$post_class = $thumb_url = '';

$post_meta = get_post_meta( get_the_ID(), 'epcl_post', true );
$post_gallery = get_post_meta( get_the_ID(), 'epcl_post_gallery', true );
$post_meta_audio = get_post_meta( get_the_ID(), 'epcl_post_audio', true );
$post_meta_video = get_post_meta( get_the_ID(), 'epcl_post_video', true );

if( !get_post_format() && !has_post_thumbnail() ){
    $post_class .= ' no-thumb';
}
// Loaded by Flexible content ACF
if( !empty($epcl_module) ){
    $column_class = 'grid-33';
    if( !empty($epcl_module['grid_posts_column']) && $epcl_module['layout'] == 'grid_posts' ){
        $grid_posts_column = $epcl_module['grid_posts_column'];
    }
	switch ($grid_posts_column) {
		case '1':
			$column_class = 'grid-50';
		break;
		case '2':
			$column_class = 'grid-50';
        break;
        case '4':
			$column_class = 'grid-25';
		break;
		default:
			$column_class = 'grid-33';
		break;
	}
	if( $epcl_module['layout'] == 'grid_sidebar' ){
		$grid_posts_column = 2;
	    $column_class = 'grid-50';
    }
}
// Columns Posts Page
if( is_home() ){
    if( $epcl_theme['posts_page_layout'] == 'grid_4_cols' ){
        $grid_posts_column = 4;
        $column_class = 'grid-25';
    }
    if( $epcl_theme['posts_page_layout'] == 'grid_sidebar' ){
        $grid_posts_column = 2;
        $column_class = 'grid-50';
    }
}
// Columns archive
if( is_archive() && !is_author() ){
    if( $epcl_theme['archive_layout'] == 'grid_4_cols' ){
        $grid_posts_column = 4;
        $column_class = 'grid-25';
    }
    if( $epcl_theme['archive_layout'] == 'grid_sidebar' ){
        $grid_posts_column = 2;
        $column_class = 'grid-50';
    }
}
if( is_author() && isset($epcl_theme['author_layout']) ){
    if( $epcl_theme['author_layout'] == 'grid_4_cols' ){
        $grid_posts_column = 4;
        $column_class = 'grid-25';
    }
    if( $epcl_theme['author_layout'] == 'grid_sidebar' ){
        $grid_posts_column = 2;
        $column_class = 'grid-50';
    }
}
// Columns search results
if( is_search() ){
    if( $epcl_theme['search_layout'] == 'grid_4_cols' ){
        $grid_posts_column = 4;
        $column_class = 'grid-25';
    }
    if( $epcl_theme['search_layout'] == 'grid_sidebar' ){
        $grid_posts_column = 2;
        $column_class = 'grid-50';
    }
}
if( epcl_is_amp() ){
    $grid_posts_column = 3;
    $column_class = 'grid-33';
}

$author_id = get_the_author_meta('ID');
$user_meta = get_user_meta( $author_id, 'epcl_user', true );
if( !empty($user_meta) && !empty( $user_meta['avatar']) && $user_meta['avatar']['url'] != '' ){
    $author_avatar = $user_meta['avatar']['url'];
}else{
    $author_avatar = get_avatar_url( get_the_author_meta('email') );
}
$author_name = get_the_author();

if( !empty($epcl_theme) && $epcl_theme['grid_display_author'] == '0'){
	$post_class .= ' no-author';
}
set_query_var( 'epcl_post_style', 'grid' );
if( isset($_GET['ads']) ){
    $epcl_theme['ads_enabled_grid_loop'] = '1';
}
// Ads integration
if( !empty($epcl_theme) && function_exists( 'epcl_render_global_ads' ) && $epcl_theme['ads_enabled_grid_loop'] == '1' && $index == ( absint($epcl_theme['ads_position_grid_loop']) - 1  ) ){
    if( $epcl_theme['ads_mobile_grid_loop'] == '0' && wp_is_mobile() ){

    }else{
        echo '<article class="index-'.esc_attr($index).' '.esc_attr($column_class).' tablet-grid-50 np-mobile">';
            epcl_render_global_ads('grid_loop');
        echo '</article>';
        $index++;
    }
}
$reading_time = epcl_reading_time( get_the_content() );

if( defined('EPCL_PLUGIN_PATH') && !empty($post_meta) && isset($post_meta['optimized_image']) ){
    $optimized_image = $post_meta['optimized_image'];          
} 
if( epcl_get_option('post_title_layout', 'inside_images') == 'below_images' ){
    $post_class.= ' title-below-images';
}
?>

<?php if($index % $grid_posts_column == 0): ?>
	<div class="clear hide-on-tablet"></div>
<?php endif; ?>

<?php if($index % 2 == 0): ?>
	<div class="clear hide-on-desktop hide-on-mobile"></div>
<?php endif; ?>

<article <?php post_class('default index-'.$index.' '.$column_class.$post_class.' tablet-grid-50 mobile-grid-100 np-mobile"'); ?>>

    <header>
        <?php epcl_display_post_format( get_post_format(), get_the_ID() );  ?>

        <?php
            if( get_post_format() == '' && !has_post_thumbnail() && empty($optimized_image['url']) || 
            (get_post_format() == 'audio' && empty($post_meta_audio['soundcloud_url']) && !$post_meta_audio['show_featured_image'] )
            ): 
        ?>
            <div class="info textcenter">
                <h1 class="main-title title medium"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            </div>
        <?php else: ?>
            <?php if( epcl_get_option('post_title_layout', 'inside_images') == 'below_images' ): ?>
                <div class="info textcenter">
                    <h1 class="main-title title medium"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                </div>
            <?php endif; ?>
            <?php if( epcl_get_option( 'enable_global_comments', true ) || epcl_get_option( 'enable_global_views', true ) || epcl_get_option( 'enable_global_reading_time', true ) ): ?>
                <!-- start: .meta -->
                <div class="meta absolute">
                    <?php get_template_part('partials/meta-info-comments'); ?>
                </div>
                <!-- end: .meta -->
            <?php endif; ?>
        <?php endif; ?>

    </header>

    <div class="meta">
        <?php if( epcl_get_option('grid_display_author') !== '0' ): ?>
            <a href="<?php echo get_author_posts_url($author_id); ?>" title="<?php echo esc_attr__('Author:', 'veen').' '.esc_attr($author_name); ?>" class="author meta-info hide-on-mobile">                                        
                <?php if($author_avatar): ?>
                    <span class="author-image small cover" style="background-image: url('<?php echo esc_url($author_avatar); ?>');"></span>
                <?php endif; ?>
                <span class="author-name"><?php echo esc_attr($author_name); ?></span>
            </a>
        <?php endif; ?>
        <?php if( epcl_get_option('enable_global_date') !== '0' ): ?>
            <time datetime="<?php the_time('Y-m-d'); ?>" class="meta-info"><?php the_time( get_option('date_format') ); ?></time>
        <?php endif; ?>
        <?php if( is_sticky() ): ?>
            <span class="sticky-icon" title="<?php esc_attr_e('Featured', 'veen'); ?>"><svg class="icon main-color"><use xlink:href="#star-icon"></use></svg></span>
        <?php endif; ?>
        <div class="clear"></div>
    </div>
    
    <?php if( epcl_get_option('grid_display_excerpt') !== '0'): ?>
        <div class="post-excerpt">                
            <?php the_excerpt(); ?>               
            <div class="clear"></div>
        </div>  
    <?php endif; ?>

    <div class="clear"></div>
    
    <?php if( get_the_category() ): ?>
        <div class="tags">
            <svg class="main-color"><use xlink:href="#tag-icon"></use></svg>
            <?php the_category(', '); ?>
        </div>
    <?php endif; ?>

    <div class="border"></div>        

</article>

<?php $index++; set_query_var('index', $index); ?>

<?php if($index % $grid_posts_column == 0): ?>
	<div class="clear hide-on-tablet"></div>
<?php endif; ?>

<?php if($index % 2 == 0): ?>
	<div class="clear hide-on-desktop hide-on-mobile"></div>
<?php endif; ?>

