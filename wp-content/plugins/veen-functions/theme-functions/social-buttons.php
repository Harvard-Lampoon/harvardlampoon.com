<?php
function epcl_render_meta_info_comments(){
    $views = 0;
    $post_meta = get_post_meta( get_the_ID(), 'epcl_post', true );
    if( isset( $post_meta['views_counter'] ) && $post_meta['views_counter'] > 0 ){
        $views = $post_meta['views_counter'];
    } 
    $content = get_the_content();
    if( !$content ) return;       
    $reading_time = epcl_reading_time( get_the_content() );
?>
    <?php if( epcl_get_option( 'enable_global_views', false ) ): ?>
        <span class="views-counter meta-info mobile comments" title="<?php echo absint( $views ); ?> <?php esc_attr_e('Views', 'veen'); ?>"><svg><use xlink:href="#views-icon"></use></svg> <?php echo absint( $views ); ?></span>
    <?php endif; ?>

    <?php if( epcl_get_option( 'enable_global_reading_time', false ) ): ?>
        <div class="min-read meta-info" title="<?php printf( esc_attr__( '%d Min Read', 'veen' ), $reading_time ); ?>"><svg><use xlink:href="#clock-fill-icon"></use></svg> <?php echo esc_attr( $reading_time ); ?></div>
    <?php endif; ?>
<?php
}

function epcl_render_meta_info(){
    $content = get_the_content();
    if( !$content ) return;
    $reading_time = epcl_reading_time( get_the_content() );
?>
    <?php if( epcl_get_option( 'enable_global_reading_time', false ) ): ?>
        <div class="min-read"><span class="count"><?php echo esc_attr( $reading_time ); ?></span> <?php esc_html_e('Min Read', 'veen'); ?></div>
    <?php endif; ?>
<?php
}

function epcl_render_share_buttons( $position = '' ){
    global $post;
    
    $epcl_theme = epcl_get_theme_options();
    $button_class = '';
    $wrapper_class = 'epcl-share';
    if( $position == 'bottom' ){
        $wrapper_class = 'epcl-share-bottom';
        $button_class = 'button circle';
    }
    ?>
    <div class="<?php echo esc_attr($wrapper_class); ?>">
        <?php
        $share_summary = get_the_excerpt();        
        $share_url = get_permalink();
        // $share_url = wp_get_shortlink();
        $share_title = html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8');
        $share_media = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' );
        ?>
        <?php if( isset( $epcl_theme['enable_single_facebook'] ) && $epcl_theme['enable_single_facebook'] !== '0'): ?>
            <a class="facebook <?php echo esc_attr($button_class); ?>" rel="nofollow noopener" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($share_url); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
        <?php endif; ?>
        <?php if( isset( $epcl_theme['enable_single_twitter'] ) && $epcl_theme['enable_single_twitter'] !== '0'): ?>    
        <a class="twitter <?php echo esc_attr($button_class); ?>" rel="nofollow noopener"  href="http://twitter.com/share?text=<?php echo urlencode($share_title); ?>&url=<?php echo esc_url($share_url); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
        <?php endif; ?>
        <?php if( isset( $epcl_theme['enable_single_linkedin'] ) && $epcl_theme['enable_single_linkedin'] == '1'): ?>    
            <a class="linkedin <?php echo esc_attr($button_class); ?>" rel="nofollow noopener" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($share_url); ?>&title=<?php echo urlencode($share_title); ?>&summary=<?php echo urlencode($share_summary); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
        <?php endif; ?>
        <?php if( isset( $epcl_theme['enable_single_pinterest'] ) && $epcl_theme['enable_single_pinterest'] == '1'): ?>    
            <a class="pinterest <?php echo esc_attr($button_class); ?>" rel="nofollow noopener"  href="//pinterest.com/pin/create/link/?url=<?php echo esc_url($share_url); ?>&media=<?php echo esc_url($share_media); ?>&description=<?php echo urlencode($share_title); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
        <?php endif; ?>
        <?php if( isset( $epcl_theme['enable_single_telegram'] ) && $epcl_theme['enable_single_telegram'] == '1'): ?>    
            <a class="telegram <?php echo esc_attr($button_class); ?>" rel="nofollow noopener" href="https://telegram.me/share/url?url=<?php echo esc_url($share_url); ?>&text=<?php echo urlencode($share_title); ?>" target="_blank"><i class="fa fa-telegram"></i></a>
        <?php endif; ?>
        <?php if( isset( $epcl_theme['enable_single_vk'] ) && $epcl_theme['enable_single_vk'] == '1'): ?>    
            <a class="vk <?php echo esc_attr($button_class); ?>" rel="nofollow noopener"  href="http://vk.com/share.php?url=<?php echo esc_url($share_url); ?>&title=<?php echo urlencode($share_title); ?>&comment=<?php echo urlencode($share_summary); ?>" target="_blank"><i class="fa fa-vk"></i></a>
        <?php endif; ?>
        <?php if( isset( $epcl_theme['enable_single_email'] ) && $epcl_theme['enable_single_email'] !== '0'): ?>    
            <a class="email <?php echo esc_attr($button_class); ?>" rel="nofollow noopener"  href="mailto:?subject=<?php echo urlencode($share_title); ?>&body=<?php echo esc_url($share_url); ?>" target="_blank"><i class="fa fa-envelope"></i></a>
        <?php endif; ?>
        <?php if( isset( $epcl_theme['enable_single_whatsapp'] ) && $epcl_theme['enable_single_whatsapp'] !== '0'): ?>    
            <a class="whatsapp <?php echo esc_attr($button_class); ?>" rel="nofollow noopener" href="https://api.whatsapp.com/send?text=<?php echo esc_url($share_url); ?>" data-action="share/whatsapp/share" target="_blank"><i class="fa fa-whatsapp"></i></a>
        <?php endif; ?>
    </div>
    <?php
}

function epcl_render_copy_permalink(){
?>
    <!-- start: .share-buttons -->
    <div class="share-buttons section np-bottom">
        <p class="title small"><?php esc_html_e('Share Article:', 'veen'); ?></p>
        <?php epcl_render_share_buttons('bottom'); ?>
        <div class="clear"></div>
        <?php if( !epcl_is_amp() ): ?>
            <div class="permalink">
                <input type="text" name="shortlink" value="<?php echo urldecode( get_the_permalink() ); ?>" id="copy-link" readonly aria-label="<?php esc_attr_e('Copy Link', 'veen'); ?>">
                <span class="copy"><svg class="icon large main-color"><use xlink:href="#copy-icon"></use></svg></span>
            </div>
        <?php endif; ?>
    </div>
    <!-- end: .share-buttons -->
<?php
}

function epcl_render_header_social_buttons(){
    $epcl_theme = epcl_get_theme_options();
    if(empty( $epcl_theme) ) return; 

    $container_class = 'share-buttons';
    $button_class = '';

    if( isset($_GET['header']) ){
        $epcl_theme['header_type'] = $_GET['header'];
    }
    
    if( $epcl_theme['header_type'] == 'classic' ){
        $container_class = 'epcl-social-buttons fill-color';
        $button_class = 'button circle';
    }
    ?>

    <div class="<?php echo esc_attr($container_class); ?> hide-on-tablet hide-on-mobile hide-on-desktop-sm">
        <?php if( epcl_get_option('facebook_url') ): ?>
            <a href="<?php echo esc_url( epcl_get_option('facebook_url') ); ?>" class="<?php echo esc_attr($button_class); ?> facebook" target="_blank" aria-label="Facebook" rel="nofollow noopener"><i class="fa fa-facebook"></i></a>
        <?php endif; ?>
        <?php if( epcl_get_option('twitter_url') ): ?>
            <a href="<?php echo epcl_get_option('twitter_url'); ?>" class="<?php echo esc_attr($button_class); ?> twitter" target="_blank" aria-label="Twitter" rel="nofollow noopener"><i class="fa fa-twitter"></i></a>
        <?php endif; ?>
        <?php if( epcl_get_option('linkedin_url') ): ?>
            <a href="<?php echo epcl_get_option('linkedin_url'); ?>" class="<?php echo esc_attr($button_class); ?> linkedin" target="_blank" aria-label="Linkedin" rel="nofollow noopener"><i class="fa fa-linkedin"></i></a>
        <?php endif; ?>
        <?php if( epcl_get_option('instagram_url') ): ?>
            <a href="<?php echo epcl_get_option('instagram_url'); ?>" class="<?php echo esc_attr($button_class); ?> instagram" target="_blank" aria-label="Instagram" rel="nofollow noopener"><i class="fa fa-instagram"></i></a>
        <?php endif; ?>
        <?php if( epcl_get_option('pinterest_url') ): ?>
            <a href="<?php echo epcl_get_option('pinterest_url'); ?>" class="<?php echo esc_attr($button_class); ?> pinterest" target="_blank" aria-label="Pinterest" rel="nofollow noopener"><i class="fa fa-pinterest"></i></a>
        <?php endif; ?>
        <?php if( epcl_get_option('dribbble_url') ): ?>
            <a href="<?php echo epcl_get_option('dribbble_url'); ?>" class="<?php echo esc_attr($button_class); ?> dribbble" target="_blank" aria-label="Dribbble" rel="nofollow noopener"><i class="fa fa-dribbble"></i></a>
        <?php endif; ?>
        <?php if( epcl_get_option('tumblr_url') ): ?>
            <a href="<?php echo epcl_get_option('tumblr_url'); ?>" class="<?php echo esc_attr($button_class); ?> tumblr" target="_blank" aria-label="Tumblr" rel="nofollow noopener"><i class="fa fa-tumblr"></i></a>
        <?php endif; ?>
        <?php if( epcl_get_option('youtube_url') ): ?>
            <a href="<?php echo epcl_get_option('youtube_url'); ?>" class="<?php echo esc_attr($button_class); ?> youtube" target="_blank" aria-label="Youtube" rel="nofollow noopener"><i class="fa fa-youtube"></i></a>
        <?php endif; ?>
        <?php if( epcl_get_option('flickr_url') ): ?>
            <a href="<?php echo epcl_get_option('flickr_url'); ?>" class="<?php echo esc_attr($button_class); ?> flickr" target="_blank" aria-label="Flickr" rel="nofollow noopener"><i class="fa fa-flickr"></i></a>
        <?php endif; ?>
        <?php if( epcl_get_option('vk_url') ): ?>
            <a href="<?php echo epcl_get_option('vk_url'); ?>" class="<?php echo esc_attr($button_class); ?> vk" target="_blank" aria-label="Vkontakte" rel="nofollow noopener"><i class="fa fa-vk"></i></a>
        <?php endif; ?>
        <?php if( epcl_get_option('telegram_url') ): ?>
            <a href="<?php echo epcl_get_option('telegram_url'); ?>" class="<?php echo esc_attr($button_class); ?> telegram" target="_blank" aria-label="Telegram" rel="nofollow noopener"><i class="fa fa-telegram"></i></a>
        <?php endif; ?>
        <?php if( epcl_get_option('rss_url') ): ?>
            <a href="<?php echo epcl_get_option('rss_url'); ?>" class="<?php echo esc_attr($button_class); ?> rss" target="_blank" aria-label="RSS" rel="nofollow noopener"><i class="fa fa-rss"></i></a>
        <?php endif; ?>
        <?php if( epcl_get_option('tiktok_url') ): ?>
            <a href="<?php echo epcl_get_option('tiktok_url'); ?>" class="<?php echo esc_attr($button_class); ?> tiktok" target="_blank" aria-label="TikTok" rel="nofollow noopener"><svg><use xlink:href="#tiktok-icon"></use></svg></a>
        <?php endif; ?>
        <?php if( epcl_get_option('email_url') ): ?>
            <?php
            $email_url = epcl_get_option('email_url');
            if( is_email($email_url) ){
                $email_url = antispambot('mailto:'.$email_url);
            }
            ?>
            <a href="<?php echo esc_attr($email_url); ?>" class="<?php echo esc_attr($button_class); ?> email" target="_blank" aria-label="Email" rel="nofollow noopener"><i class="fa fa-envelope-o"></i></a>
        <?php endif; ?>
    </div>
<?php
}