<?php

$page_key = 'epcl_page';

CSF::createMetabox( $page_key, array(
    'title'          => 'General Information',
    'post_type'      => 'page',
    'page_templates' => 'default', // Spesific page templates
) );

CSF::createSection( $page_key, array(
    // 'title'  => 'Modules creator',
    // 'icon'   => 'fa fa-rocket',
    'fields' => array(
        array (
            'id' => 'enable_title',
            'title' => esc_html__('Enable Title', 'epcl_framework'),
            'desc' => esc_html__('Enable/Disable title for this page.', 'epcl_framework'),
            'type' => 'switcher',
            'default' => true,
        ),
        array (
            'id' => 'enable_sidebar',
            'title' => esc_html__('Enable Sidebar', 'epcl_framework'),
            'desc' => esc_html__('Enable/Disable sidebar for this post.', 'epcl_framework'),
            'type' => 'switcher',
            'default' => false,
        ),
        array (
            'id' => 'sidebar',
            'title' => esc_html__('Sidebar (optional)', 'epcl_framework'),
            'subtitle' => esc_html__('Default: Article Sidebar', 'epcl_framework'),
            'desc' => esc_html__('Use a different sidebar for this module.', 'epcl_framework'),       
            'type' => 'select',             
            'chosen' => false,
            'options' => 'sidebars',
            'default' => 'epcl_sidebar_default',  
            'dependency' => array('enable_sidebar', '==', true),      
        ),
    )
) );

$page_key = 'epcl_page_fullwidth';

CSF::createMetabox( $page_key, array(
    'title'          => 'General Information',
    'post_type'      => 'page',
    'page_templates' => 'page-templates/page-fullwidth.php', // Spesific page templates
) );

CSF::createSection( $page_key, array(
    // 'title'  => 'Modules creator',
    // 'icon'   => 'fa fa-rocket',
    'fields' => array(
        array (
            'id' => 'enable_title',
            'title' => esc_html__('Enable Title', 'epcl_framework'),
            'desc' => esc_html__('Enable/Disable title for this page.', 'epcl_framework'),
            'type' => 'switcher',
            'default' => true,
        ),
    )
) );