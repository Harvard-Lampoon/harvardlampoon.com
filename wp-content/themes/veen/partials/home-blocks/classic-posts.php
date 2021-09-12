<?php
$epcl_theme = epcl_get_theme_options();
$epcl_module = epcl_get_module_options();

$args = array('post_type' => 'post', 'paged' => get_query_var('paged') );

// ACF custom builder
if( is_page_template('page-templates/home.php') ){

    $var = is_front_page() ? 'page' : 'paged';
    $paged = ( get_query_var($var) ) ? get_query_var($var) : 1;
    $args['paged'] = $paged;

    // Check common arguments from EPCL Module
    $extra_args = epcl_posts_lists_args( $epcl_module );

    if( !empty($extra_args) ){
        $args = array_merge( $args, $extra_args );
    } 
	
}

$custom_query = new WP_Query($args);
if( !is_page_template('page-templates/home.php') ){
    $custom_query = $wp_query;
}

add_filter( 'excerpt_length', 'epcl_large_excerpt_length', 999 );
add_filter( 'the_title', 'epcl_classic_title_length', 999, 2 );
$module_class = '';
if( !empty($epcl_module) ){

}
if( !is_active_sidebar('epcl_sidebar_home') ){
    $module_class .= ' no-active-sidebar';
}
$index = 0;
set_query_var('epcl_block_style', 'classic');
set_query_var('index', $index);
?>
<!-- start: .grid-container -->
<div class="grid-container">
    <div class="row module-wrapper <?php echo esc_attr($module_class); ?>" id="<?php echo wp_unique_id('epcl-classic-posts-'); ?>">

        <!-- start: .content-wrapper -->
        <div class="content-wrapper classic <?php if(!is_archive()) echo 'content'; ?>">
            <!-- start: .center -->
            <div class="center left-content">

                <?php if( $custom_query->have_posts() ): ?>
                    <!-- start: .articles -->
                    <div class="articles classic">
                        <?php while( $custom_query->have_posts() ): $custom_query->the_post(); ?>
                            <?php get_template_part('partials/loops/classic-article'); ?>
                        <?php $index++; set_query_var('index', $index); endwhile; ?>
                    </div>
                    <!-- end: .articles -->
                    <?php epcl_pagination($custom_query); ?>

                    <?php wp_reset_postdata(); ?>                    

                <?php else: ?>

                    <!-- start: .articles -->
                    <div class="articles classic bg-white">
                        <div class="section">
                            <div class="text textcenter">
                                <h3 class="title large no-margin"><?php esc_html_e("Something's wrong here...", 'veen'); ?></h3>
                                <p><?php esc_html_e("We can't find any result for your search term.", 'veen'); ?></p>
                            </div>
                            <div class="buttons textcenter">
                                <a href="<?php echo home_url('/'); ?>" class="button bordered"><?php esc_html_e("Go back to home", 'veen'); ?></a>
                            </div>
                        </div>
                    </div>
                    <!-- end: .articles -->

                <?php endif; ?>

            </div>
            <!-- end: .center -->

        </div>
        <!-- end: .content-wrapper -->

        <div class="clear"></div>
    </div>            

</div>
<!-- end: .grid-container -->