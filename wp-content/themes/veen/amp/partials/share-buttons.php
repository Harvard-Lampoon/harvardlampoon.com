<?php 
$epcl_theme = epcl_get_theme_options();
$button_class = '';
$wrapper_class = 'epcl-share';
if( $epcl_share_bottom ){
    $wrapper_class = 'epcl-share-bottom';
    $button_class = 'epcl-button circle';
}
?>
<div class="<?php echo esc_attr($wrapper_class); ?>">
    <?php
    $share_summary = get_the_excerpt();
    $share_url = wp_get_shortlink();
    $share_title = html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8');
    $share_media = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'large' );
    ?>
    <?php if( isset( $epcl_theme['enable_single_facebook'] ) && $epcl_theme['enable_single_facebook'] !== '0'): ?>    
        <a class="facebook <?php echo esc_attr($button_class); ?>" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($share_url); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
    <?php endif; ?>
    <?php if( isset( $epcl_theme['enable_single_twitter'] ) && $epcl_theme['enable_single_twitter'] !== '0'): ?>    
    <a class="twitter <?php echo esc_attr($button_class); ?>" rel="nofollow" href="http://twitter.com/share?text=<?php echo urlencode($share_title); ?>&url=<?php echo esc_url($share_url); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
    <?php endif; ?>
    <?php if( isset( $epcl_theme['enable_single_linkedin'] ) && $epcl_theme['enable_single_linkedin'] == '1'): ?>    
        <a class="linkedin <?php echo esc_attr($button_class); ?>" rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($share_url); ?>&title=<?php echo urlencode($share_title); ?>&summary=<?php echo urlencode($share_summary); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
    <?php endif; ?>
    <?php if( isset( $epcl_theme['enable_single_pinterest'] ) && $epcl_theme['enable_single_pinterest'] == '1'): ?>    
        <a class="pinterest <?php echo esc_attr($button_class); ?>" rel="nofollow" href="//pinterest.com/pin/create/link/?url=<?php echo esc_url($share_url); ?>&media=<?php echo esc_url($share_media); ?>&description=<?php echo urlencode($share_title); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
    <?php endif; ?>
    <?php if( isset( $epcl_theme['enable_single_telegram'] ) && $epcl_theme['enable_single_telegram'] == '1'): ?>    
        <a class="telegram <?php echo esc_attr($button_class); ?>" rel="nofollow" href="https://telegram.me/share/url?url=<?php echo esc_url($share_url); ?>&text=<?php echo urlencode($share_title); ?>" target="_blank"><i class="fa fa-telegram"></i></a>
    <?php endif; ?>
    <?php if( isset( $epcl_theme['enable_single_vk'] ) && $epcl_theme['enable_single_vk'] == '1'): ?>    
        <a class="vk <?php echo esc_attr($button_class); ?>" rel="nofollow" href="http://vk.com/share.php?url=<?php echo esc_url($share_url); ?>&title=<?php echo urlencode($share_title); ?>&comment=<?php echo urlencode($share_summary); ?>" target="_blank"><i class="fa fa-vk"></i></a>
    <?php endif; ?>
    <?php if( isset( $epcl_theme['enable_single_email'] ) && $epcl_theme['enable_single_email'] !== '0'): ?>    
        <a class="email <?php echo esc_attr($button_class); ?>" rel="nofollow" href="mailto:?subject=<?php echo urlencode($share_title); ?>&body=<?php echo esc_url($share_url); ?>" target="_blank"><i class="fa fa-envelope"></i></a>
    <?php endif; ?>
    <?php if( isset( $epcl_theme['enable_single_whatsapp'] ) && $epcl_theme['enable_single_whatsapp'] !== '0'): ?>    
            <a class="whatsapp <?php echo esc_attr($button_class); ?>" rel="nofollow" href="https://api.whatsapp.com/send?text=<?php echo esc_url($share_url); ?>" data-action="share/whatsapp/share" target="_blank"><i class="fa fa-whatsapp"></i></a>    
        <?php endif; ?>
</div>