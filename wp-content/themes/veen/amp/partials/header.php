<?php
$epcl_theme = epcl_get_theme_options();
if( function_exists('icl_get_home_url') ) $home = icl_get_home_url();
else $home = home_url('/');
// Just demo
if( isset($_GET['header']) ){
	$header_type = sanitize_text_field( $_GET['header'] );
	switch($header_type){
		default:
			$epcl_theme['header_type'] = 'minimalist';
		break;
		case 'classic':
			$epcl_theme['header_type'] = 'classic';
		break;
		case 'notice':
			$epcl_theme['enable_notice'] = true;
        break;
        case 'advertising':
            $epcl_theme['header_type'] = 'advertising';
		break;
	}
}

// Only if theme options data has been created
$header_class = '';
if( !empty( $epcl_theme ) ){
    $header_class = $epcl_theme['header_type'];
    if( isset( $epcl_theme['enable_sticky_header'] ) && $epcl_theme['enable_sticky_header'] != false ){
        $header_class .=' enable-sticky';
    }
    if( isset($epcl_theme['sticky_logo_image']['url'] ) && $epcl_theme['sticky_logo_image']['url'] ){
        $header_class .=' has-sticky-logo'; 
    }
    if( isset($epcl_theme['enable_search_header']) && $epcl_theme['enable_search_header'] == '1' && $epcl_theme['header_type'] !== 'classic' ){
        add_filter('wp_nav_menu_items','epcl_search_nav_item', 10, 2);
    }
    if( epcl_get_option('enable_subscribe') == true ){
        add_filter('wp_nav_menu_items','epcl_subscribe_nav_item', 10, 2);
    }
}else{
    $header_class .= 'classic';
}

?>
<?php if( !empty($epcl_theme) && $epcl_theme['enable_notice']  == true && epcl_get_option('notice_text') ): ?>
    <?php if( epcl_get_option('enable_notice_close')  == false || (!isset($_COOKIE['epcl_show_notice']) || $_COOKIE['epcl_show_notice'] != 'false') ): ?>
        <div class="notice text underline-effect">
            <div class="grid-container">
                <div class="info">
                    <i class="fa fa-bell"></i>
                    <?php echo wp_kses_post( wpautop( do_shortcode( $epcl_theme['notice_text'] ) ) ); ?>
                    <?php if( epcl_get_option('enable_notice_close')  == true ): ?>
                        <a href="<?php echo esc_url( home_url( $wp->request ) ); ?>?epcl-action=remove-notice" class="close"><i class="fa fa-times"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<!-- start: #header -->
<header id="header" class="<?php echo esc_attr($header_class); ?>">
    <div class="">
        
        <?php if( has_nav_menu('epcl_header') ): ?>
            <div class="menu-mobile" on="tap:sidenav.open" role="button" tabindex="0">
                <svg class="icon ularge open"><use xlink:href="#menu-icon"></use></svg>
                <svg class="icon ularge close"><use xlink:href="#close-icon"></use></svg>
            </div>
        <?php endif; ?>

        <!-- start: .menu-wrapper -->
        <div class="menu-wrapper">
            <div class="grid-container">
                
                <?php if( epcl_get_option('logo_type') == 1 && $epcl_theme['logo_image']['url'] ): ?>
                    <div class="logo">
                        <a href="<?php echo home_url('/'); ?>"><img src="<?php echo esc_url( $epcl_theme['logo_image']['url'] ); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo esc_attr( $epcl_theme['logo_width'] ); ?>" /></a>
                    </div>
                    <?php if( $epcl_theme['sticky_logo_image']['url'] ): ?>
                        <div class="logo sticky-logo">
                            <a href="<?php echo home_url('/'); ?>"><img src="<?php echo esc_url( $epcl_theme['sticky_logo_image']['url'] ); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo esc_attr( $epcl_theme['sticky_logo_width'] ); ?>" /></a>
                        </div>                
                    <?php endif; ?>
                <?php else: ?>
                    <div class="logo text-logo">
                        <a href="<?php echo home_url('/'); ?>" class="title ularge no-margin">
                            <?php if( isset( $epcl_theme['logo_icon'] ) && $epcl_theme['logo_icon'] ): ?>
                                <i class="fa <?php echo esc_attr( $epcl_theme['logo_icon'] ); ?>"></i>
                            <?php endif; ?>
                            <?php bloginfo('name'); ?><span class="dot"></span>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if( !empty($epcl_theme) && $epcl_theme['header_type'] == 'advertising' && function_exists('epcl_render_header_ads') ): ?>
                    <?php epcl_render_header_ads(); ?>
                <?php endif; ?>

                <?php if( epcl_get_option('enable_share_header') && function_exists('epcl_render_header_social_buttons') ): ?>
                    <?php epcl_render_header_social_buttons(); ?>
                <?php endif; ?>

                <?php if( !empty( $epcl_theme) && isset($epcl_theme['enable_search_header']) && $epcl_theme['enable_search_header'] == '1' ): ?>
                    <a href="<?php echo home_url('/'); ?>?s=" class="epcl-search-button button circle"><svg class="icon"><use xlink:href="#search-icon"></use></svg></a>
                <?php endif; ?>
                
                <!-- start: .main-nav -->
                <amp-sidebar id="sidenav" layout="nodisplay" side="left">
                    <?php
                    $args = array(
                        'theme_location' => 'epcl_header',
                        'container' => false
                    );
                    if(has_nav_menu('epcl_header')){
                        wp_nav_menu($args);
                    } 
                    ?>
                </amp-sidebar>
                <nav class="main-nav">
                    <?php
                    $args = array(
                        'theme_location' => 'epcl_header',
                        'container' => false
                    );
                    if(has_nav_menu('epcl_header')){
                        wp_nav_menu($args);
                    } 
                    ?>
                </nav>
                <!-- end: .main-nav -->

                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <!-- end: .menu-wrapper -->

        <div class="clear"></div>       
    
    </div>
</header>
<!-- end: #header -->

<?php
if( function_exists( 'epcl_render_global_ads' ) ){
	epcl_render_global_ads('below_header');
}
?>

<?php if( !empty( $epcl_theme) && isset($epcl_theme['enable_search_header']) && $epcl_theme['enable_search_header'] == '1' ): ?>
    <?php $total_posts = wp_count_posts(); ?>
    <div class="hide-on-mobile hide-on-tablet hide-on-desktop">
        <div id="search-lightbox" class="mfp-hide grid-container grid-small grid-parent">
            <h4 class="title textcenter hide-on-mobile hide-on-tablet"><?php printf( esc_html__('Press %s to close', 'veen'), '<span>ESC</span>' ); ?></h4>
            <div class="search-wrapper section">                
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>