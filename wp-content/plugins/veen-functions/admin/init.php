<?php

    if ( ! class_exists( 'CSF' ) ) {
        return;
    }

    $opt_name = EPCL_FRAMEWORK_VAR;

    $theme = wp_get_theme( EPCL_THEMESLUG );

    $footer_text = $theme->name.' v'.$theme->version.' by <a href="https://1.envato.market/ep-portfolio-themes" target="_blank">EstudioPatagon</a>';


    //CSF::createCustomizeOptions( $opt_name, array(
    //    'database'        => 'option',
    //    'transport'       => 'refresh',
    //    'capability'      => 'manage_options',
    //    'save_defaults'   => true,
    //    'enqueue_webfont' => true,
    //    'async_webfont'   => false,
    //    'output_css'      => true,
    //) );

    CSF::createOptions( $opt_name, array(

    // menu settings
    'menu_title'              => 'Theme Options',
    'menu_slug'               => 'epcl-theme-options',

    // menu extras
    'show_in_customizer'      => true,

    // footer
    'footer_text'             => $footer_text,
    'footer_credit'           => __('Thank you for creating with a product from <a href="https://1.envato.market/ep-portfolio-themes" target="_blank">EstudioPatagon</a> themes.', 'epcl_framework'),

    // contextual help
    'contextual_help' => array(
            array(
                'id'      => 'epcl-help-tab-1',
                'title'   => __('Support', 'epcl_framework'),
                'content' => __('<p>If you have any kind of problem with our theme options panel don\'t hesitate on contact us via our <a href="https://estudiopatagon.ticksy.com/" target="_blank">Ticket System.</a></p>', 'epcl_framework')
            ),
        ),
    'contextual_help_sidebar' => '',

    // typography options
    'enqueue_webfont'         => false,
    'async_webfont'           => false,

    // theme and wrapper classname
    'theme'                   => 'light',

    ) );

    require_once('sections/subscribe.php');
    require_once('sections/header.php');
    require_once('sections/footer.php');
    require_once('sections/advertising.php');
    require_once('sections/styling.php');
    require_once('sections/typography.php');
    require_once('sections/main-effect.php');

    require_once('sections/sidebars.php');
    require_once('sections/blog.php');
    require_once('sections/social-profiles.php');
    require_once('sections/advanced-settings.php');
    require_once('sections/optimization.php');
    require_once('sections/amp.php');
    require_once('sections/backup.php');
