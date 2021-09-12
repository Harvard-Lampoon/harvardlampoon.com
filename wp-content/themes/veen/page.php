<?php get_header(); ?>
<?php
$wrapper_class = '';
$prefix = EPCL_THEMEPREFIX.'_';
$enable_sidebar = false;
$page_class = 'no-sidebar';
$post_meta = get_post_meta( get_the_ID(), 'epcl_page', true );
if( !empty($post_meta) && defined('EPCL_PLUGIN_PATH') ){
    $enable_sidebar = $post_meta['enable_sidebar'];
    if( $enable_sidebar ){
        $page_class = '';
    }
}
if( !is_active_sidebar('epcl_sidebar_default') ){
    $enable_sidebar = false;
    $page_class .= ' no-sidebar';
}
if( !has_post_thumbnail() ){
    $page_class .= ' no-thumb';
}
if( !empty($epcl_theme) && $epcl_theme['enable_page_sidebar'] === 'enabled'){
    $enable_sidebar = true;
    $page_class = '';
}
if( !empty($epcl_theme) && $epcl_theme['enable_page_sidebar'] === 'disabled'){
    $enable_sidebar = false;
    $page_class .= ' no-sidebar';
}
if( has_post_thumbnail() ){
    $page_class .= ' fullcover';
}
?>
<!-- start: #page -->
<main id="page" class="main grid-container">
	<?php if( have_posts() ): the_post(); ?>
		<!-- start: #single -->
        <div id="single" class="content <?php echo esc_attr($page_class); ?>">  
        
            <?php if( has_post_thumbnail() ): ?>
                <div class="post-format-wrapper featured-image cover">
                    <img src="<?php echo EPCL_THEMEPATH; ?>/assets/images/transparent.gif" data-src="<?php the_post_thumbnail_url('epcl_page_header'); ?>" alt="<?php the_title(); ?>" class="lazy fullwidth">
                    <div class="info">
                        <?php if( !isset($post_meta['enable_title']) || (defined('EPCL_PLUGIN_PATH') && $post_meta['enable_title'] ) ): ?>   
                            <h1 class="title large"><?php the_title(); ?></h1>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>                

            <!-- start: .epcl-page-wrapper -->
            <div class="epcl-page-wrapper clearfix row">

                <!-- start: .left-content -->
                <div class="left-content grid-70 np-mobile">
                    <article <?php post_class('main-article'); ?>>

                        <?php edit_post_link( esc_html__('Edit this post', 'veen'), '', '', '', 'edit-post-button epcl-button hide-on-mobile hide-on-tablet'); ?>

                        <section class="post-content">
                            <?php if( !empty($epcl_theme) && isset($epcl_theme['enable_sticky_share_buttons_page']) && $epcl_theme['enable_sticky_share_buttons_page'] == '1' && function_exists('epcl_render_share_buttons') ): ?>
                                <div class="epcl-share-container hide-on-mobile">
                                    <?php epcl_render_share_buttons('top'); ?>
                                </div>
                            <?php endif; ?>

                            <?php if( !has_post_thumbnail() && !isset($post_meta['enable_title']) ): ?>
                                <h1 class="title large bordered"><?php the_title(); ?></h1>
                            <?php elseif( !has_post_thumbnail() && defined('EPCL_PLUGIN_PATH') && $post_meta['enable_title'] ): ?>   
                                <h1 class="title large bordered"><?php the_title(); ?></h1>
                            <?php endif; ?>

                            <div class="text">
                                <?php the_content(); ?>
                            </div>
                            
                            <div class="clear"></div>

                            <?php
                                $link_pages_args = array(
                                    'before'           => '<div class="epcl-pagination link-pages section"><div class="nav"><span class="page-number title">'.esc_html__('Pages', 'veen').'</span>',
                                    'after'            => '</div></div><div class="epcl-border small"></div>',
                                    'link_before'      => '',
                                    'link_after'       => '',
                                    'next_or_number'   => 'number',
                                    'separator'        => '',
                                    'nextpagelink'     => esc_html__('Next', 'veen'),
                                    'previouspagelink' => esc_html__('Previous', 'veen'),
                                    'pagelink'         => '<span class="page-number">%</span>',
                                    'echo'             => 1
                                );
                                wp_link_pages( $link_pages_args );
                            ?>  

                            <?php if( ( comments_open() || get_comments_number() ) && !post_password_required() ): ?>
                                <div id="show-comments" class="show-comments textcenter">
                                    <a href="javascript:void(0)" class="epcl-button large icon secondary" data-text="<?php esc_html_e('Show Comments', 'veen'); ?>" data-text-active="<?php esc_attr_e('Hide Comments', 'veen'); ?>"><span><?php esc_html_e('Show Comments', 'veen'); ?></span></a>
                                </div>
                            <?php endif; ?>
                                
                            <!-- start: .epcl-comments -->
                            <div class="epcl-comments hidden">

                                <?php if( empty($epcl_theme) || $epcl_theme['hosted_comments'] == 1 ): // Self Hosted ?>
                                    <?php comments_template(); ?>
                                <?php endif; ?>
                                
                                <?php if( comments_open() ): ?>

                                    <?php if( !empty($epcl_theme) && $epcl_theme['hosted_comments'] == 2 && $epcl_theme['disqus_id'] ): // Disqus ?>
                                        <!-- start: disqus integration -->
                                        <div id="comments" class="section">
                                            <h3 class="title bordered no-margin"><?php esc_html_e('Comments', 'veen'); ?><span class="border"></span></h3>
                                            <div id="disqus_thread"></div>
                                        </div>
                                        <noscript><?php esc_html_e('Please enable JavaScript to view the', 'veen'); ?> <a href="https://disqus.com/?ref_noscript" rel="nofollow"><?php esc_html_e('comments powered by Disqus.', 'veen'); ?></a></noscript>
                                        <!-- end: disqus integration -->
                                    <?php endif; ?>

                                    <?php if( !empty($epcl_theme) && $epcl_theme['hosted_comments'] == 3 ): // Disqus ?>
                                        <!-- start: facebook comments -->
                                        <div id="comments" class="section">
                                            <h3 class="title bordered no-margin"><?php esc_html_e('Comments', 'veen'); ?><span class="border"></span></h3>
                                            <div class="clear"></div>
                                            <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="100%" data-numposts="5" data-colorscheme="dark"></div>
                                        </div>
                                        <!-- end: facebook comments -->
                                        <div id="fb-root"></div>                        
                                    <?php endif; ?>
                                    
                                <?php endif; ?>
                                
                            </div>
                            <!-- end: .epcl-comments -->
                            
                            <?php if( !empty($epcl_theme) && isset( $epcl_theme['enable_share_buttons_page'] ) && $epcl_theme['enable_share_buttons_page'] == '1' && function_exists('epcl_render_share_buttons') ): ?>
                                <?php epcl_render_copy_permalink(); ?>
                            <?php endif; ?>
                        </section>
                        
   

                    </article>
                    
                </div>
                <!-- end: .left-content -->

                <?php
                if( $enable_sidebar !== false ){
                    get_sidebar();
                }
                ?>

            </div>
            <!-- end: .epcl-page-wrapper -->

        </div>
        <!-- end: #single -->
    <?php endif; ?>
</main>
<!-- end: #page -->
<?php get_footer(); ?>
