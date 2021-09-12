<?php get_template_part('amp/header'); ?>

<?php while(have_posts()): the_post();  ?>
    <?php
	$post_id = get_the_ID();
	$post_thumbnail = get_the_post_thumbnail_url();
	$post_format = get_post_format();

	$post_style = 'fullcover';
	$single_class = '';
    $enable_sidebar = false;
    $single_class = ' no-sidebar';
    $post_meta = get_post_meta( get_the_ID(), 'epcl_post', true );
    $views = 0;
    if( defined('EPCL_PLUGIN_PATH') ){
        if( !isset( $post_meta['views_counter']) ){
            $post_meta = array(
                'views_counter' => 0
            );
        }else{
            $views = $post_meta['views_counter'];
        }        
        if(!$views) $views = 0;
        $post_meta['views_counter'] = ++$views;
        update_post_meta($post_id, 'epcl_post', $post_meta);
    }
	if( !empty($post_meta) && isset($post_meta['style']) && defined('EPCL_PLUGIN_PATH') ){

		$post_style = $post_meta['style'];
		if( $post_style === '' ) $post_style = 'standard';

		$enable_sidebar = $post_meta['enable_sidebar'];
		if( $enable_sidebar ){
            $enable_sidebar = true;
            $single_class = '';
        }

	}
	if( $post_style == 'fullcover' ){
		$post_thumbnail = get_the_post_thumbnail_url($post, 'epcl_page_header');
    }
    if( !is_active_sidebar('epcl_sidebar_default') ){
        $enable_sidebar = false;
        $single_class .= ' no-sidebar';
    }
    if( !$post_style || !has_post_thumbnail() ){
        $post_style = 'fullcover';
    }
    
    if( !empty($epcl_theme) && $epcl_theme['single_post_layout'] === 'standard' ){
        $post_style = 'standard';
    }
    if( !empty($epcl_theme) && $epcl_theme['single_post_layout'] === 'fullcover' ){
        $post_style = 'fullcover';
    }
    if( !empty($epcl_theme) && $epcl_theme['enable_post_sidebar'] === 'enabled'){
        $enable_sidebar = true;
        $single_class = '';
    }
    if( !empty($epcl_theme) && $epcl_theme['enable_post_sidebar'] === 'disabled'){
        $enable_sidebar = false;
        $single_class .= ' no-sidebar';
    }
    // Disable featured image globally
    if( !empty($epcl_theme) && isset($epcl_theme['enable_featured_image']) && $epcl_theme['enable_featured_image'] == '0'){
        $post_style = 'fullcover';
    }
    // Fix featured image titles
    if( !$post_style || !has_post_thumbnail() ){
        $post_style = 'fullcover';
    }
    if( epcl_get_option('post_title_layout', 'inside_images') == 'below_images' ){
        $single_class.= ' title-below-images';
    }
	?>
	<!-- start: #single -->
    <main id="single" class="main grid-container <?php echo esc_attr($post_style.$single_class); ?>">
    
        <!-- Fullcover Style -->
        <?php if( $post_style == 'fullcover' ): ?>
            <?php get_template_part('partials/single/style-fullcover'); ?>
        <?php endif; ?>

		<!-- start: .center -->
	    <div class="content row">

            <!-- start: .epcl-page-wrapper -->
            <div class="epcl-page-wrapper">

                <!-- start: .content -->
                <div class="left-content grid-70 np-mobile">

                    <article <?php post_class('main-article'); ?>>

                        <?php edit_post_link( esc_html__('Edit this post', 'veen'), '', '', '', 'edit-post-button epcl-button hide-on-mobile hide-on-tablet'); ?>

                        <?php if( $post_style == 'standard' ): ?>
                            <?php get_template_part('partials/single/style-standard'); ?>
                        <?php endif; ?>

                        <?php if( ( !has_post_thumbnail() && $post_format == '' ) || $post_format == 'video' || $post_format == 'audio' || $post_format == 'gallery' || epcl_get_option('post_title_layout', 'inside_images') == 'below_images' ): ?>
                            <h1 class="main-title title textcenter"><?php the_title(); ?></h1>
                        <?php endif; ?>

                        <?php if( empty($epcl_theme) || $epcl_theme['single_enable_meta_data'] === '1' ): ?>
                            <?php get_template_part('partials/meta-info'); ?>
                        <?php endif; ?>

                        <section class="post-content">

                            <?php if( !empty($epcl_theme) && $epcl_theme['enable_sticky_share_buttons'] !== '0' && function_exists('epcl_render_share_buttons') ): ?>
                                <div class="epcl-share-container hide-on-mobile">
                                    <?php epcl_render_share_buttons('top'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="text">
                                <?php the_content(); ?>
                                <?php
                                    if ( is_singular( 'attachment' ) ) {
                                        echo '<h2 class="title usmall">'.esc_html__('Published in:', 'veen').'</h2>';
                                        // Parent post navigation.
                                        the_post_navigation();
                                        echo '<br>';
                                    }
                                ?>
                            </div>
                            <div class="clear"></div>
                            
                            <?php if( get_the_category() && epcl_get_option('enable_single_category', true) ): ?>
                                <div class="tags textcenter">
                                    <svg class="main-color"><use xlink:href="#tag-icon"></use></svg>
                                    <?php the_category(', '); ?>
                                </div>
                            <?php endif; ?>

                            <?php if( get_the_tags() && epcl_get_option('enable_single_tags', true) ): ?>
                                <div class="bottom-tags">
                                    <h5 class="title usmall"><?php esc_html_e('Tagged in:', 'veen'); ?></h5>
                                    <?php the_tags('', ', '); ?>
                                </div>
                            <?php endif; ?>

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

                            <?php if( comments_open() ): ?>
                                <div id="show-comments" class="show-comments textcenter">
                                    <a href="<?php the_permalink(); ?>#show-comments" rel="noamphtml" class="epcl-button large icon secondary" data-text="<?php esc_html_e('Show Comments', 'veen'); ?>" data-text-active="<?php esc_attr_e('Hide Comments', 'veen'); ?>"><span><?php esc_html_e('Show Comments', 'veen'); ?></span></a>
                                </div>
                            <?php endif; ?>                            
                            
                            <?php if( function_exists('epcl_render_copy_permalink') && epcl_get_option('enable_share_buttons', true)  ): ?>
                                <?php epcl_render_copy_permalink(); ?>
                            <?php endif; ?>      
                            
                            <?php if( epcl_get_option('enable_single_author', true) ): ?>
                                <?php get_template_part('partials/author-box'); ?>                               
                            <?php endif; ?>

                        </section>

                    </article>
                    
                    <?php if( epcl_get_option('related_posts', true) ): ?>
                        <?php get_template_part('partials/single/related-articles'); ?>
                        <div class="clear"></div> 
                    <?php endif; ?>                             

                    <?php if( epcl_get_option('siblings_posts', true) ): ?>
                        <?php get_template_part('partials/single/siblings-articles'); ?>
                    <?php endif; ?>

                    <div class="clear"></div>

                </div>
                <!-- end: .content -->

                <?php
                if( $enable_sidebar ){
                    get_sidebar();
                }
                ?>

            </div>
            <!-- end: .center -->
        
        </div>
        <!-- end: .epcl-page-wrapper -->

	</main>
	<!-- end: #single -->

<?php endwhile; ?>

<?php get_template_part('amp/footer'); ?>