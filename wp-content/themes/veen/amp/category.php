<?php get_template_part('amp/header'); ?>

<?php
$layout = epcl_get_option( 'amp_archives_layout', 'grid-posts' );
$obj = get_queried_object();
?>

<!-- start: #archives-->
<main id="archives" class="main">
    
    <div class="grid-container grid-medium tag-description section">

        <div class="left grid-35 tablet-grid-45 np-mobile">
            <span class="icon"><svg class="main-color"><use xlink:href="#tag-icon"></use></svg></span>
            <h1 class="title medium no-margin"><?php single_cat_title(); ?></h1>
            <div class="total"><span class="dot"></span> <?php esc_html( printf( _n( '%1$s Article', '%1$s Articles', $obj->count, 'veen'), number_format_i18n( $obj->count ) ) ); ?></div>
        </div>
        <?php if( term_description() ): ?>
            <div class="right grid-65 tablet-grid-55 np-tablet np-mobile">
                <?php echo term_description(); ?>
            </div>
        <?php endif; ?>
        
        <div class="clear"></div>

    </div>

    <?php get_template_part( 'partials/home-blocks/'.$layout ); ?>

</main>
<!-- end: #archives -->

<?php get_template_part('amp/footer'); ?>
