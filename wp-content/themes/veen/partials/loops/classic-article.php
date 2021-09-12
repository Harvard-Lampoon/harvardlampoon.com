<?php
$epcl_theme = epcl_get_theme_options();
$epcl_module = epcl_get_module_options();

$index = absint( get_query_var('index') );
$post_class = $optimized_image = '';
$post_meta = get_post_meta( get_the_ID(), 'epcl_post', true );
$post_gallery = get_post_meta( get_the_ID(), 'epcl_post_gallery', true );
$post_meta_audio = get_post_meta( get_the_ID(), 'epcl_post_audio', true );
$post_meta_video = get_post_meta( get_the_ID(), 'epcl_post_video', true );
if( !get_post_format() && !has_post_thumbnail() ){
    $optimized_image = '';
    if( defined('EPCL_PLUGIN_PATH') && !empty($post_meta['optimized_image']['url']) && $post_meta['optimized_image']['url'] != ''  ){
        $optimized_image = $post_meta['optimized_image'];
    }
    if( !$optimized_image ){
        $post_class .= ' no-thumb';
    }    
}

set_query_var( 'epcl_post_style', 'classic' );
$post_class .= ( $index % 2 ) ? ' even' : ' odd';
$reading_time = epcl_reading_time( get_the_content() );
if( epcl_get_option('post_title_layout', 'inside_images') == 'below_images' ){
    $post_class.= ' title-below-images';
}
?>

<article <?php post_class('default classic-large index-'.$index.' '.$post_class.' grid-100 tablet-grid-100"'); ?>>

    <header>
        <?php epcl_display_post_format( get_post_format(), get_the_ID() );  ?>

        <?php if( get_post_format() == '' && !has_post_thumbnail() && empty($optimized_image['url']) ||
                (get_post_format() == 'gallery' && empty($post_gallery['gallery']) ) ||
                (get_post_format() == 'image' && !has_post_thumbnail() && empty($optimized_image['url']) ) || 
                (get_post_format() == 'audio' && empty($post_meta_audio['soundcloud_url']) && !$post_meta_audio['show_featured_image'] ) || 
                (get_post_format() == 'video' && empty($post_meta_video['video_url']) ) ||
                ( !in_array( get_post_format(), array('', 'gallery', 'image', 'audio', 'video')) )
                ): ?>
            <div class="info textcenter">
                <h1 class="main-title title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            </div>
        <?php else: ?>
            <?php if( epcl_get_option('post_title_layout', 'inside_images') == 'below_images' ): ?>
                <div class="info textcenter">
                    <h1 class="main-title title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
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

        <div class="clear"></div>
    </header>

    <!-- start: .bottom -->
    <div class="bottom grid-container grid-small np-mobile">   
        
        <?php get_template_part('partials/meta-info'); ?>

        <?php if( empty($epcl_theme) || $epcl_theme['classic_display_excerpt'] !== '0' ): ?>
            <div class="post-excerpt">                    
                <?php the_excerpt(); ?>        
                <div class="clear"></div>              
            </div>  
        <?php endif; ?>  
        
        <?php if( get_the_category() ): ?>
            <div class="tags">
                <svg class="main-color"><use xlink:href="#tag-icon"></use></svg>
                <?php the_category(', '); ?>
            </div>
        <?php endif; ?>

        <?php if( !get_the_title() ): ?>
            <br>
            <a href="<?php the_permalink(); ?>" class="button secondary hide-on-mobile"><?php esc_html_e('Continue Reading', 'veen'); ?></a>
        <?php endif; ?>  

    </div>   
    <!-- end: .right -->
    <div class="clear"></div>
    <div class="epcl-border small"></div>

</article>