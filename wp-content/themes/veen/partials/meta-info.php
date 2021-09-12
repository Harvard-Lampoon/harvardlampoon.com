<?php
$author_id = get_the_author_meta('ID');
$user_meta = get_user_meta( $author_id, 'epcl_user', true );
if( !empty($user_meta) && !empty( $user_meta['avatar']) && $user_meta['avatar']['url'] != '' ){
    $author_avatar = $user_meta['avatar']['url'];
}else{
    $author_avatar = get_avatar_url( get_the_author_meta('email') );
}
$author_name = get_the_author();
$reading_time = epcl_reading_time( get_the_content() );
$enable_author = true;
if( !is_single() && epcl_get_option('classic_display_author', true) == '0'){
    $enable_author = false;
}
if( is_single() && epcl_get_option('enable_author_top', true) == '0'){
    $enable_author = false;
}
?>
<!-- start: .meta -->
<div class="meta">
    <?php if( $enable_author ): ?>
        <a href="<?php echo get_author_posts_url($author_id); ?>" title="<?php echo esc_attr__('Author:', 'veen').' '.esc_attr($author_name); ?>" class="author meta-info hide-on-mobile">                                        
            <?php if($author_avatar): ?>
                <?php if( epcl_is_amp() ): ?>
                    <span class="author-image cover" style="background-image: url('<?php echo esc_url($author_avatar); ?>');"></span>
                <?php else: ?>
                    <span class="author-image cover lazy" data-src="<?php echo esc_url($author_avatar); ?>"></span>
                <?php endif; ?>                
            <?php endif; ?>
            <span class="author-name"><?php echo esc_attr($author_name); ?></span>
        </a>
    <?php endif;?>
    <?php if( epcl_get_option('enable_global_date') !== '0' ): ?>
        <time class="meta-info" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time( get_option('date_format') ); ?></time>  
    <?php endif; ?>
    <?php
        if( function_exists('epcl_render_meta_info') ){
            epcl_render_meta_info();
        }    
    ?>
    <?php if( is_sticky() ): ?>
        <span class="sticky-icon" title="<?php esc_attr_e('Featured', 'veen'); ?>"><svg class="icon main-color"><use xlink:href="#star-icon"></use></svg></span>
    <?php endif; ?>
    <div class="clear"></div>
</div>
<!-- end: .meta -->