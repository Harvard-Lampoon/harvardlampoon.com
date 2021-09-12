<?php $epcl_theme = epcl_get_theme_options(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!-- 
  _______ _            _                                             
 |__   __| |          | |                                            
    | |  | |__   ___  | |     __ _ _ __ ___  _ __   ___   ___  _ __  
    | |  | '_ \ / _ \ | |    / _` | '_ ` _ \| '_ \ / _ \ / _ \| '_ \ 
    | |  | | | |  __/ | |___| (_| | | | | | | |_) | (_) | (_) | | | |
    |_|  |_| |_|\___| |______\__,_|_| |_| |_| .__/ \___/ \___/|_| |_|
                                            | |                      
                                            |_|                                                                              
	
   This is the Harvard Lampoon, founded in 1876.
   Dedicated to the our old site (1876-2020). Sorry for deleting you.
   v2 was developed in September 2020 by I. Prasad '22-'23.
   
   01110111 01101000 01100001 01110100   01110111 01100101   
   01110011 01100001 01101001 01100100   01100001 01100010 
   01101111 01110110 01100101 00101100   01100010 01110101 
   01110100   01101001 01101110   01100010 01101001 01101110 
   01100001 01110010 01111001 
-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <?php if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ): ?>
        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
    <?php endif; ?>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>  
    <?php wp_body_open(); ?>

    <!-- start: .mobile.main-nav -->
    <nav class="mobile main-nav hide-on-desktop-lg" role="navigation">
        <?php
        $args = array( 'theme_location' => 'epcl_header', 'container' => false );
        if( has_nav_menu('epcl_header') ){
            wp_nav_menu( $args );
        } 
        ?>     
    </nav>
    <!-- end: .mobile.main-nav -->
    <div class="menu-overlay hide-on-desktop"></div>

    <!-- start: #wrapper -->
    <div id="wrapper">
		<?php get_template_part('partials/header'); ?>
