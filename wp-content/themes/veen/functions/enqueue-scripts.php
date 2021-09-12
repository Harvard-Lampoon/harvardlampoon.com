<?php

/* Scripts and Styles */

if( !function_exists('epcl_enqueue_scripts') ){

    add_action('wp_enqueue_scripts', 'epcl_enqueue_scripts');

	function epcl_enqueue_scripts() {
		$epcl_theme = epcl_get_theme_options();

		$assets_folder = EPCL_THEMEPATH.'/assets';
        $prefix = EPCL_THEMEPREFIX.'-';

        $theme = wp_get_theme( EPCL_THEMESLUG );
        $ver = $theme->version;
        
        /* Styles */

        wp_register_style($prefix.'google-fonts', epcl_google_fonts_url(), NULL, NULL);

        // AMP styles
        if( epcl_is_amp() ){   
            if( epcl_get_option('amp_enable_google_fonts') !== '0' ){
                wp_enqueue_style($prefix.'google-fonts');     
            }
            wp_enqueue_style($prefix.'theme', $assets_folder.'/dist/style.min.css', NULL, $ver);            
            wp_enqueue_style($prefix.'plugins', $assets_folder.'/dist/plugins.min.css', NULL, $ver);  
            wp_enqueue_style($prefix.'amp', $assets_folder.'/dist/amp.min.css', NULL, $ver); 
            wp_enqueue_style($prefix.'fontawesome', $assets_folder.'/dist/fontawesome.min.css', NULL, $ver);
            return;
        }

        // If theme options is installed and enabled optimization is on, the theme will load combined and minified CSS and JS
        if( epcl_get_option('enable_optimization') == '1' ){
            wp_enqueue_style($prefix.'plugins', $assets_folder.'/dist/plugins.min.css', NULL, $ver);            
            wp_enqueue_script($prefix.'scripts', $assets_folder.'/dist/scripts.min.js', array('jquery'), $ver, true);
            wp_localize_script($prefix.'scripts', 'ajax_var', array(
                'assets_folder' => $assets_folder
            ));
        }else{
            // Not combined libraries
            wp_enqueue_script('lazy-load', $assets_folder.'/js/jquery.lazyload.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('aos', $assets_folder.'/js/aos.js', array('jquery'), $ver, true);
            wp_enqueue_script('slick', $assets_folder.'/js/slick.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('jflickrfeed', $assets_folder.'/js/jflickrfeed.min.js', array('jquery'), $ver, true);            
            wp_enqueue_script('magnific-popup', $assets_folder.'/js/jquery.magnific-popup.min.js', array('jquery'), $ver, true);            
            wp_enqueue_script('sticky-sidebar', $assets_folder.'/js/jquery.sticky-sidebar.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('theia-sidebar', $assets_folder.'/js/theia-sidebar.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('tooltipster', $assets_folder.'/js/jquery.tooltipster.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('pace', $assets_folder.'/js/pace.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('preload-css', $assets_folder.'/js/preload-css.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('prism', $assets_folder.'/js/prism.min.js', array('jquery'), $ver, true);
            wp_enqueue_script($prefix.'functions', $assets_folder.'/js/functions.js', array('jquery'), $ver, true);
            wp_enqueue_script($prefix.'shortcodes', $assets_folder.'/js/shortcodes.js', array('jquery'), $ver, true);
            wp_enqueue_style($prefix.'theme', $assets_folder.'/dist/style.min.css', NULL, $ver); // There is a style.un-minified.css file if needed
            wp_enqueue_style($prefix.'plugins-nop', $assets_folder.'/dist/plugins.min.css', NULL, $ver); // There is a plugins.un-minified.css file if needed
        }

        if( epcl_get_option('fonts_icons_method', 'footer') == 'standard' ){
            wp_enqueue_style($prefix.'fontawesome', $assets_folder.'/dist/fontawesome.min.css', NULL, $ver);
        }

        if( empty($epcl_theme) || epcl_get_option('enable_google_fonts') !== '0' ){
            wp_enqueue_style($prefix.'google-fonts');
        }

        if( !defined('W3TC') ){
            $custom_css = epcl_generate_custom_styles();
            if( epcl_get_option('enable_optimization') == '1'){
                wp_add_inline_style( $prefix.'plugins', $custom_css );
            }else{
                wp_add_inline_style( $prefix.'plugins-nop', $custom_css );
            }
        }     

        /* Scripts */	

		if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
			wp_enqueue_script( 'comment-reply', 'wp-includes/js/comment-reply', array(), false, true );
        }

    }

    function epcl_google_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        /* Translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */

        if ( 'off' !== _x( 'on', 'Josefin Sans font: on or off', 'veen' ) ) {
            $fonts[] = 'Josefin Sans:400,600,700';
        }

        /* Translators: If there are characters in your language that are not supported by Muli, translate this to 'off'. Do not translate into your own language. */

        if ( 'off' !== _x( 'on', 'Nunito font: on or off', 'veen' ) ) {
            $fonts[] = 'Nunito:400,400i,600,700,700i';
        }
        
        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
                'display' => 'swap',
            ), '//fonts.googleapis.com/css' );
        }
        return $fonts_url;
    }
    
}

?>
