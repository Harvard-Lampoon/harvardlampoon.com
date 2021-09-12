<?php get_header(); ?>

<!-- start: #home -->
<main id="home" class="main">

    <?php if( empty($epcl_theme) || !$epcl_theme['posts_page_layout'] || $epcl_theme['posts_page_layout'] == 'classic_sidebar' ): ?>
        <?php get_template_part('partials/home-blocks/classic-posts-sidebar'); ?>
    <?php elseif( $epcl_theme['posts_page_layout'] == 'classic'  ): ?>
        <?php get_template_part('partials/home-blocks/classic-posts'); ?>
    <?php elseif( $epcl_theme['posts_page_layout'] == 'grid_3_cols' || $epcl_theme['posts_page_layout'] == 'grid_4_cols' ):  ?>
        <?php get_template_part('partials/home-blocks/grid-posts'); ?>
    <?php elseif( $epcl_theme['posts_page_layout'] == 'grid_sidebar'  ): ?>
        <?php get_template_part('partials/home-blocks/grid-sidebar'); ?>
    <?php endif; ?>
    
</main>
<!-- end: #home -->

<?php get_footer(); ?>