<?php
$next_post = get_next_post();
$prev_post = get_previous_post();
if( empty($next_post) &&  empty($prev_post) ) return;
?>
<div class="epcl-border no-margin"></div>
<section class="siblings section" id="epcl-other-stories">
    <h3 class="title bordered"><?php esc_html_e('Other stories', 'veen'); ?></h3>
    <?php
    if( !empty($next_post) ){
        $next_url = get_the_permalink($next_post->ID);
        $next_thumb = get_the_post_thumbnail_url($next_post->ID, 'large');
    }
    ?>
    <?php if( !empty($next_post) ): ?>
        <article class="next mask-effect">
            <?php if($next_thumb): ?>
                <?php if( epcl_get_option('enable_lazyload_posts') == '1' && !epcl_is_amp() ): ?>
                    <div class="thumb cover lazy" data-src="<?php echo esc_url($next_thumb); ?>"></div>
                <?php else: ?>
                    <div class="thumb cover" style="background: url('<?php echo esc_url($next_thumb); ?>');"></div>
                <?php endif; ?>
            <?php endif; ?>
            <a href="<?php echo esc_url($next_url); ?>" class="full-link"></a>
            <div class="info">
                <h4 class="title white mask no-margin"><?php echo get_the_title($next_post->ID); ?></h4>
            </div>
            <span class="epcl-button secondary hide-on-mobile"><?php esc_html_e('Next Story', 'veen'); ?></span>
        </article>
    <?php endif; ?>

    <?php    
    if( !empty($prev_post) ){
        $prev_url = get_the_permalink($prev_post->ID);
        $prev_thumb = get_the_post_thumbnail_url($prev_post->ID, 'large');
    }
    ?>
    <?php if( !empty($prev_post) ): ?>
        <article class="prev mask-effect">
            <?php if($prev_thumb): ?>
                <?php if( epcl_get_option('enable_lazyload_posts') == '1' && !epcl_is_amp() ): ?>
                    <div class="thumb cover lazy" data-src="<?php echo esc_url($prev_thumb); ?>"></div>
                <?php else: ?>
                    <div class="thumb cover" style="background: url('<?php echo esc_url($prev_thumb); ?>');"></div>
                <?php endif; ?>
            <?php endif; ?>
            <a href="<?php echo esc_url($prev_url); ?>" class="full-link"></a>
            <div class="info">
                <h4 class="title white mask no-margin"><?php echo get_the_title($prev_post->ID); ?></h4>
            </div>
            <span class="epcl-button secondary hide-on-mobile"><?php esc_html_e('Previous Story', 'veen'); ?></span>
        </article>
    <?php endif; ?>
    <div class="clear"></div>
</section>