<?php

global $epcl_theme;

// Only enabled when redux options is active, W3 total cache is installed and enable optimization is "on"

add_action ( 'wp_head', 'epcl_generate_header_styles' );
function epcl_generate_header_styles(){
    global $epcl_theme;
    if( empty($epcl_theme) ) return;
    if( !function_exists('epcl_is_amp') ) return;
    if( epcl_is_amp() ):
?>
    <style amp-custom>
        <?php
            echo epcl_generate_custom_styles();
            echo epcl_get_option('amp_css_code');
        ?>
    </style>
<?php
    endif;
    if( $epcl_theme['enable_optimization'] || defined('W3TC') ):
?>
        <style id="epcl-theme-critical-css"><?php get_template_part('assets/dist/critical-css'); ?></style>
<?php
    endif;
    if( $epcl_theme['enable_optimization'] || defined('W3TC') ){
        $custom_css = epcl_generate_custom_styles();
        echo '<style id="epcl-theme-header-css">'.$custom_css.'</style>';
    }    
}

function epcl_amp_scripts() {
    if( !function_exists('epcl_is_amp') ) return;
    if( epcl_is_amp() ){
        global $wp_scripts;
        $wp_scripts->queue = array();
    }
}
add_action('wp_print_scripts', 'epcl_amp_scripts', 100);

function epcl_style_loader_tag($tag){
    global $epcl_theme;

    if( empty($epcl_theme) || is_admin() ||  ( !$epcl_theme['enable_optimization'] && !defined('W3TC') ) ) return $tag;

    if( epcl_is_amp() ) return $tag;

    if( $epcl_theme['enable_optimization'] || defined('W3TC') ){

        switch( epcl_get_option('secondary_css_method', 'preload') ){
            // case 'prefetch':
            //     $onload = 'onload="this.onload=null;this.rel=`stylesheet`"';
            //     $rel = 'rel="prefetch" as="style"';
            // break;
            case 'preload': default:
                $onload = 'onload="this.onload=null;this.rel=`stylesheet`"';
                $rel = 'rel="preload" as="style"';
            break;
            case 'standard':
                return $tag;
            break;
        }

        $tag = preg_replace("/rel='stylesheet' id='epcl-google-fonts-css'/", "$rel id='epcl-google-fonts-css' $onload ", $tag);

        $tag = preg_replace("/rel='stylesheet' id='epcl-theme-css'/", "$rel id='epcl-theme-css' $onload ", $tag);

        $tag = preg_replace("/rel='stylesheet' id='epcl-plugins-css'/", "$rel id='epcl-plugins-css' $onload ", $tag);

        $tag = preg_replace("/rel='stylesheet' id='wp-block-library-css'/", "$rel id='wp-block-library-css' $onload ", $tag);

        $tag = preg_replace("/rel='stylesheet' id='epcl-theme-options-google-fonts-css'/", "$rel id='epcl-theme-options-google-fonts-css' $onload ", $tag);

        return $tag;
    }
}

function wps_deregister_styles() {
    global $epcl_theme;
    if( !empty($epcl_theme) && isset($epcl_theme['remove_gutenberg_styles']) && $epcl_theme['remove_gutenberg_styles'] === '1' ){
        wp_dequeue_style( 'wp-block-library' );
    }
    if( !empty($epcl_theme) && ( is_page_template('page-templates/home.php') || is_front_page() ) && isset($epcl_theme['remove_gutenberg_styles_home']) && $epcl_theme['remove_gutenberg_styles_home'] === '1' ){
        wp_dequeue_style( 'wp-block-library' );
    }
    
}
add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );

// Only enabled when redux options is active

add_action ( 'wp_head', 'epcl_generate_header_codes', 1 );
function epcl_generate_header_codes(){
    global $epcl_theme;
    if( empty($epcl_theme) ) return;

    // echo '<link rel="preload" as="style" type="text/css" href="'.EPCL_THEMEPATH.'/assets/dist/style.min.css">';
    // echo '<link rel="preload" as="font" type="font/woff2" crossorigin href="'.EPCL_THEMEPATH.'/assets/fonts/fontawesome-webfont.woff2?v=4.7.0">';

    if( isset( $epcl_theme['custom_scripts'] ) && $epcl_theme['custom_scripts'] ){
        echo $epcl_theme['custom_scripts'];
    }
}

add_action ( 'wp_footer', 'epcl_generate_footer_codes', 100 );
function epcl_generate_footer_codes(){
    global $epcl_theme;
    if( empty($epcl_theme) || epcl_is_amp() ) return;

    if( isset( $epcl_theme['custom_scripts_footer'] ) && $epcl_theme['custom_scripts_footer'] ){
        echo $epcl_theme['custom_scripts_footer'];
    }
}

// Escape subscribe parameters
function epcl_render_subscribe_parameters( $data ){
    $allowed_atts = array(
        'class'      => array(),
        'type'       => array(),
        'id'         => array(),
        'style'      => array(),
        'src'        => array(),
        'alt'        => array(),
        'href'       => array(),
        'rel'        => array(),
        'rev'        => array(),
        'target'     => array(),
        'novalidate' => array(),
        'type'       => array(),
        'value'      => array(),
        'name'       => array(),
        'tabindex'   => array(),
        'for'        => array(),
        'width'      => array(),
        'height'     => array(),
        'data'       => array(),
        'title'      => array(),
    );
    $allowedposttags['label']    = $allowed_atts;
    $allowedposttags['input']    = $allowed_atts;
    $allowedposttags['select']    = $allowed_atts;
    $allowedposttags['textarea'] = $allowed_atts;
    $allowedposttags['script']   = $allowed_atts;
    $allowedposttags['style']    = $allowed_atts;
    $allowedposttags['strong']   = $allowed_atts;
    $allowedposttags['small']    = $allowed_atts;
    $allowedposttags['span']     = $allowed_atts;
    $allowedposttags['pre']      = $allowed_atts;
    $allowedposttags['div']      = $allowed_atts;
    $allowedposttags['img']      = $allowed_atts;
    $allowedposttags['h1']       = $allowed_atts;
    $allowedposttags['h2']       = $allowed_atts;
    $allowedposttags['h3']       = $allowed_atts;
    $allowedposttags['h4']       = $allowed_atts;
    $allowedposttags['h5']       = $allowed_atts;
    $allowedposttags['h6']       = $allowed_atts;
    $allowedposttags['ol']       = $allowed_atts;
    $allowedposttags['ul']       = $allowed_atts;
    $allowedposttags['li']       = $allowed_atts;
    $allowedposttags['em']       = $allowed_atts;
    $allowedposttags['br']       = $allowed_atts;
    $allowedposttags['p']        = $allowed_atts;
    $allowedposttags['a']        = $allowed_atts;
    $allowedposttags['b']        = $allowed_atts;
    $allowedposttags['i']        = $allowed_atts;

    echo wp_kses( $data, $allowedposttags );
}

function epcl_remove_async_scripts($buffer){
    $custom_ajax_scripts = epcl_get_option('custom_ajax_scripts', false);
    if( !empty($custom_ajax_scripts) ){
        foreach( $custom_ajax_scripts as $item ){
            if( $item['script_src'] !== '' ){
                $buffer = str_replace( $item['script_src'] , '', $buffer);
            }
        }
        
    }
    return $buffer;
}
function epcl_buffer_start(){ ob_start("epcl_remove_async_scripts"); }
function epcl_buffer_end(){ ob_end_flush(); }

function epcl_check_remove_async(){

    if( epcl_get_option('remove_custom_ajax_scripts', false) && !empty(epcl_get_option('custom_ajax_scripts', false) ) ){
        add_action('get_header', 'epcl_buffer_start');
        add_action('wp_footer', 'epcl_buffer_end');
    }

}

add_action ('init','epcl_check_remove_async');