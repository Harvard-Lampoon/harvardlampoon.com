<?php
$epcl_module = epcl_get_module_options();
if( empty($epcl_module) ) return; // no data from carousel module
$prefix = EPCL_THEMEPREFIX.'_';
$args = array(
	'taxonomy' => 'category',
    'orderby' => 'count',
    'order' => 'DESC',
    'meta_key' => 'epcl_post_categories'
);

if( !empty($epcl_module) ){
    // Categories filters
    if( isset($epcl_module['featured_categories']) && $epcl_module['featured_categories'] != '' ){
        $args['term_taxonomy_id'] = $epcl_module['featured_categories'];
    }
    if( isset($epcl_module['excluded_categories']) && $epcl_module['excluded_categories'] != '' ){
        $args['exclude'] = $epcl_module['excluded_categories'];
    }
    if( isset($epcl_module['categories_carousel_limit']) && $epcl_module['categories_carousel_limit'] != '' ){
        $args['number'] = $epcl_module['categories_carousel_limit'];
    }
}
$image_size = 'medium';
if ($epcl_module['categories_carousel_show_limit'] < 5){
    $image_size = 'epcl_single_content';
}
$carousel = get_terms($args);
?>

<?php if( !empty($carousel) ): ?>
	<!-- start: .carousel -->
    <section class="epcl-popular-categories grid-container grid-parent grid-large" id="<?php echo wp_unique_id('epcl-category-carousel-'); ?>">
        <?php if( $epcl_module['cat_carousel_title'] ): ?>
            <h3 class="title bordered"><?php echo esc_attr( $epcl_module['cat_carousel_title']); ?></h3>
        <?php endif; ?>
        <div class="slick-slider outer-arrows slides-<?php echo intval( $epcl_module['categories_carousel_show_limit'] ); ?>" data-show="<?php echo intval( $epcl_module['categories_carousel_show_limit'] ); ?>" data-rtl="<?php echo is_rtl(); ?>" data-aos="fade">
            <?php foreach($carousel as $term): ?>
                <?php
                    $term_meta = $thumb_url = '';
                    if( defined('EPCL_PLUGIN_PATH') && !empty($term) ){
                        $term_meta = get_term_meta( $term->term_id, 'epcl_post_categories', true );
                        if( !empty($term_meta) ){
                            $thumb_url = wp_get_attachment_image_src($term_meta['archives_image']['id'], $image_size);
                        }                        
                    }
                    if( !$thumb_url ) continue;
                ?>
                <div class="slick-item tag mask-effect">
                    <div class="item cover background" <?php if( !empty( $thumb_url ) ) echo 'style="background-image: url('.esc_url($thumb_url[0]).');"'; ?>>
                        <h4 class="title medium mask"><?php echo esc_html($term->count); ?> &nbsp;<span class="dot"></span> <?php echo esc_attr($term->name); ?></h4>                    
                        <a href="<?php echo get_term_link($term); ?>" class="full-link"></a>
                    </div>  
                </div>

            <?php endforeach; ?>
        </div>
	</section>
	<!-- end: .carousel -->
<?php endif; ?>
