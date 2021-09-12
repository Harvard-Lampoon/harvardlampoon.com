<?php
$epcl_theme = epcl_get_theme_options();
$epcl_module = epcl_get_module_options();

$prefix = EPCL_THEMEPREFIX.'_';
$sidebar_name = 'epcl_sidebar_default';

$sidebar_class = '';

if( epcl_get_option('enable_mobile_sidebar') == false || epcl_get_option('mobile_sidebar') ){
	$sidebar_class = 'no-sidebar';
}
if( defined('EPCL_PLUGIN_PATH') ){
    $post_meta = get_post_meta( get_the_ID(), 'epcl_post', true );
    if( is_page() ){
        $post_meta = get_post_meta( get_the_ID(), 'epcl_page', true );
    }
    if( is_page_template('page-templates/home.php') ){
        $post_meta = get_post_meta( get_the_ID(), 'epcl_home', true );
    }
    if( isset($post_meta['sidebar']) && $post_meta['sidebar'] != '' && $post_meta['enable_sidebar'] ){
        $sidebar_name = $post_meta['sidebar'];
    }
}
if( is_home() || is_archive() || is_search() || is_page_template('page-templates/home.php') ){
	$sidebar_name = 'epcl_sidebar_home';
}
if( !empty($epcl_theme) && $epcl_theme['enable_sticky_sidebar'] == '1'){
    $sidebar_class .= ' sticky-enabled';
}
if( !empty($epcl_module) && isset($epcl_module['sidebar']) &&  $epcl_module['sidebar'] != ''){
    $sidebar_name = $epcl_module['sidebar'];
}
$mobile_sidebar = false;
if( epcl_get_option('enable_mobile_sidebar') == true && epcl_get_option('mobile_sidebar') ){
    $mobile_sidebar = true;
}
?>
<?php if( is_active_sidebar( $sidebar_name ) ): ?>
    <!-- start: #sidebar -->
    <aside id="sidebar" class="grid-30 <?php echo esc_attr($sidebar_class); ?>">
        <div class="sidebar-wrapper default-sidebar"><?php dynamic_sidebar($sidebar_name); ?></div>
        <?php if( $mobile_sidebar ): ?>
            <div class="sidebar-wrapper mobile-sidebar hide-on-desktop"><?php dynamic_sidebar( $epcl_theme['mobile_sidebar'] ); ?></div>
        <?php endif; ?>
    </aside>
    <!-- end: #sidebar -->
<?php endif; ?>