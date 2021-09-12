<?php get_template_part('amp/header'); ?>

<!-- start: #search-results -->
<main id="archives" class="main">

    <div class="search-box grid-container grid-usmall section np-bottom">
        <h1 class="title textcenter large"><?php esc_html_e("Search results for:", 'veen'); ?> <strong>"<?php echo get_search_query(); ?>"</strong></h1>
        <div class="textcenter">
            <?php get_search_form(); ?>
        </div>
    </div>

    <?php if( empty($epcl_theme) || !$epcl_theme['search_layout'] || $epcl_theme['search_layout'] == 'classic' ):  ?>
        <?php get_template_part('partials/home-blocks/classic-posts'); ?>
    <?php elseif( $epcl_theme['search_layout'] == 'classic_sidebar'  ): ?>
        <?php get_template_part('partials/home-blocks/classic-posts-sidebar'); ?>
    <?php elseif(  $epcl_theme['search_layout'] == 'grid_3_cols' || $epcl_theme['search_layout'] == 'grid_4_cols'  ): ?>
        <?php get_template_part('partials/home-blocks/grid-posts'); ?>
    <?php elseif( $epcl_theme['search_layout'] == 'grid_sidebar'  ): ?>
        <?php get_template_part('partials/home-blocks/grid-sidebar'); ?>
    <?php endif; ?>

    <div class="clear"></div>

</main>
<!-- end: #search-results -->

<?php get_template_part('amp/footer'); ?>