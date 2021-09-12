<?php

if( !function_exists('register_sidebar') ) return;

add_action( 'widgets_init', 'epcl_widgets_init' );

function epcl_widgets_init() {

	/* Default Sidebar Widgets (right) */

    if( defined('EPCL_PLUGIN_PATH') ){
        register_sidebar(array(
            'name' => esc_html__('Article Sidebar', 'veen'),
            'id' => 'epcl_sidebar_default',
            'description' => esc_html__('Right sidebar inside single posts.', 'veen'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '<div class="clear"></div></section>',
            'before_title' => '<h4 class="widget-title title medium bordered">',
            'after_title' => '</h4>',
        ));
    }


	/* Home Widgets */

	register_sidebar(array(
		'name' => esc_html__('Home Sidebar', 'veen'),
		'id' => 'epcl_sidebar_home',
		'description' => esc_html__('Sidebar for home, archives and results', 'veen'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '<div class="clear"></div></section>',
		'before_title' => '<h4 class="widget-title title medium bordered">',
		'after_title' => '</h4>',
    ));

	/* Footer Widgets */

	register_sidebar(array(
		'name' => esc_html__('Footer', 'veen'),
		'id' => 'epcl_sidebar_footer',
		'description' => esc_html__('Footer Sidebar', 'veen'),
		'before_widget' => '<section id="%1$s" class="widget %2$s grid-25 tablet-grid-50 mobile-grid-100">',
		'after_widget' => '<div class="clear"></div></section>',
		'before_title' => '<h4 class="widget-title title medium bordered">',
		'after_title' => '</h4>',
	));

	/* Dynamic Sidebars */

	$epcl_theme = epcl_get_theme_options();
    if( !empty($epcl_theme['custom_sidebar']) ){

        if( !isset($epcl_theme['custom_sidebar'][0]) && !is_array( $epcl_theme['custom_sidebar'][0] ) ){
            array_unique($epcl_theme['custom_sidebar']);
        }

        foreach( $epcl_theme['custom_sidebar'] as $name ){

            if( is_array($name) ){
                foreach($name as $item){
                    $id = sanitize_title($item);
                    register_sidebar(array(
                        'name' => $item,
                        'id' => $id,
                        'before_widget' => '<section id="%1$s" class="widget %2$s">',
                        'after_widget' => '<div class="clear"></div></section>',
                        'before_title' => '<h4 class="widget-title title medium bordered">',
                        'after_title' => '</h4>',
                    ));
                }
            } elseif( !empty($name) ){
                $id = sanitize_title($name);
                register_sidebar(array(
                    'name' => $name,
                    'id' => $id,
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget' => '<div class="clear"></div></section>',
                    'before_title' => '<h4 class="widget-title title medium bordered">',
                    'after_title' => '</h4>',
                ));
            }
        }
    }

}

?>