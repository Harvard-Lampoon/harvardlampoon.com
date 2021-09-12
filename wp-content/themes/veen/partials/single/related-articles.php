<?php
$post_id = get_the_ID();
$args = array(
    'posts_per_page' => '3',
    'category__in' => wp_get_post_categories($post_id),
    'post__not_in' => array($post_id),
    'post_type' => 'post',
    'order' => 'DESC',
);
$query_related = new WP_Query( $args );
?>
<?php if( $query_related->have_posts() ): ?>    
    <section class="related section" id="epcl-related-stories">
        <h3 class="title bordered"><?php esc_html_e('You might also like', 'veen'); ?></h3>
        <div class="row">
            <?php while( $query_related->have_posts() ): $query_related->the_post(); ?>
                <article class="prev grid-33 tablet-grid-33 mobile-grid-50">
                    <a href="<?php the_permalink(); ?>" class="hover-effect"><?php the_post_thumbnail( 'epcl_single_related' ); ?></a>
                    <div class="info">
                        <h4 class="title usmall no-margin"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <time class="small" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time( get_option('date_format') ); ?></time>
                    </div>
                </article>
            <?php endwhile; ?>
            <div class="clear"></div>
        </div>
    </section>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>