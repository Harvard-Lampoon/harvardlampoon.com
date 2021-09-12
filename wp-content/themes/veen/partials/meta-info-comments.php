<?php if( epcl_get_option( 'enable_global_comments', true ) ): ?>
    <a href="<?php the_permalink();?>#show-comments" class="comments meta-info mobile" title="<?php esc_html( printf( _n( '%1$s Comment', '%1$s Comments', get_comments_number(), 'veen'), number_format_i18n( get_comments_number() ) ) ); ?>">
        <svg><use xlink:href="#comments-icon"></use></svg>
        <?php if( epcl_get_option('hosted_comments') !== '2' && epcl_get_option('hosted_comments') !== '3' ): ?>
            <span class="comment-count"><?php echo get_comments_number(); ?></span>
        <?php elseif( epcl_get_option('hosted_comments') == '3' ): // Facebook commments ?>
            <span class="fb-comments-count" data-href="<?php the_permalink(); ?>">0</span>
        <?php else: // Disqus Comments ?>
            <span class="disqus-comment-count" data-disqus-url="<?php the_permalink(); ?>" data-disqus-identifier="<?php the_ID(); ?>">0</span>
        <?php endif; ?>    
    </a>  
<?php endif; ?>

<?php
    if( function_exists('epcl_render_meta_info_comments') ){
        epcl_render_meta_info_comments();
    }    
?>

<?php if( is_sticky() ): ?>
    <span class="meta-info circle" title="<?php esc_attr_e('Featured', 'veen'); ?>"><svg><use xlink:href="#star-icon"></use></svg></span>
<?php endif; ?>