<?php
$epcl_theme = epcl_get_theme_options();
$epcl_module = epcl_get_module_options();

add_filter( 'excerpt_length', 'epcl_small_excerpt_length', 999 );
add_filter( 'the_title', 'epcl_grid_title_length', 999, 2 );

$args = array('post_type' => 'post', 'paged' => get_query_var('paged') );

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

$grid_posts_column = 2;
$module_class = '';

if( !is_active_sidebar('epcl_sidebar_home') ){
    $module_class .= ' no-sidebar';
}
$module_class .= ' grid-large';
?>

<div class="grid-container module-wrapper <?php echo esc_attr($module_class); ?>" id="<?php echo wp_unique_id('epcl-grid-sidebar-'); ?>">

    <!-- start: .content-wrapper -->
    <div class="content-wrapper row grid-sidebar <?php if(!is_archive()) echo 'content'; ?>">
        <div class="clearfix">
            <!-- start: .center -->
            <div class="left-content grid-70">

                <?php if( $custom_query->have_posts() ): ?>
                    <!-- start: .articles -->
                    <div class="articles grid-posts grid-sidebar columns-2">
                        <?php while( $custom_query->have_posts() ): $custom_query->the_post(); ?>
                            <?php get_template_part('partials/loops/grid-article'); ?>            
                        <?php endwhile; ?>
                    </div>
                    <!-- end: .articles -->

                    <?php epcl_pagination($custom_query); ?>

                    <?php wp_reset_postdata(); ?>

                <?php else: ?>

                    <!-- start: .articles -->
                    <div class="articles classic">
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

            <?php get_sidebar(); ?>
        </div>

    </div>
    <!-- end: .content-wrapper -->
    
</div>
