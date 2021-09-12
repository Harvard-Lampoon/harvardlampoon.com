<?php get_header(); ?>
<?php
add_filter('excerpt_length', 'epcl_small_excerpt_length', 999);
$module_class = '';
if( !is_active_sidebar('epcl_sidebar_home') ){
    $module_class .= ' no-active-sidebar';
}
if( !get_the_author_meta('description') ){
    $module_class .= 'content';
}
?>
<!-- start: #archives-->
<main id="archives" class="main">

    <!-- start: .content-wrapper -->
    <div class="content-wrapper <?php echo esc_attr($module_class); ?>">

        <?php get_template_part('partials/author-box'); ?>

        <?php if( empty($epcl_theme) || !isset($epcl_theme['author_layout']) || $epcl_theme['author_layout'] == 'classic_sidebar' ): ?>
            <?php get_template_part('partials/home-blocks/classic-posts-sidebar'); ?>
        <?php elseif( $epcl_theme['author_layout'] == 'classic'  ): ?>
            <?php get_template_part('partials/home-blocks/classic-posts'); ?>
        <?php elseif( $epcl_theme['author_layout'] == 'grid_3_cols' || $epcl_theme['author_layout'] == 'grid_4_cols' ):  ?>
            <?php get_template_part('partials/home-blocks/grid-posts'); ?>
        <?php elseif( $epcl_theme['author_layout'] == 'grid_sidebar'  ): ?>
            <?php get_template_part('partials/home-blocks/grid-sidebar'); ?>
        <?php endif; ?>

    </div>
    <!-- end: .content-wrapper -->

</main>
<!-- end: #archives -->
<?php get_footer(); ?>
