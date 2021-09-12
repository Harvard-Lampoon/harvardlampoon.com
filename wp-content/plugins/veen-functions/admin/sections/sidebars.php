<?php

/* Unique options for every EP theme */

$admin_url = EPCL_PLUGIN_URL.'/functions/admin';
$opt_name = EPCL_FRAMEWORK_VAR;

/* Sidebars */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Sidebars', 'epcl_framework'),
	'icon' => 'fa fa-th-list',
	'fields' => array(
		// array(
		// 	'id' => 'title_dynamic_sidebar',
		// 	'type' => 'info', 'notice' => false,
		// 	'desc' => __( '<strong style="font-size: 16px;">Dynamic Sidebars</strong><br>Note: this option only affects pages and the home template, the blog page always use the default sidebar.', 'epcl_framework')
        // ),
        array(
			'id' => 'enable_sticky_sidebar',
			'type' => 'switcher',
            'title' => esc_html__('Enable Sticky Sidebar', 'epcl_framework'),
			'desc' => esc_html__('When an user scroll down your website, the sidebar will stick until he reach the bottom.', 'epcl_framework'),
			'default' => false
        ),
        array(
			'id' => 'enable_post_sidebar',
			'type' => 'button_set',
			'title' => esc_html__('Enable Sidebar on Posts', 'epcl_framework'),
			'subtitle' => '',
			'desc' => __('This option will override any post setting, it is useful if you want to disable all sidebars inside your posts.', 'epcl_framework'),
            'options' => array(
                'inherit' => 'Inherit from every Post',
                'enabled' => 'Enabled',
                'disabled' => 'Disabled'
            ),
			'default' => 'inherit'
        ),
        array(
			'id' => 'enable_page_sidebar',
			'type' => 'button_set',
			'title' => esc_html__('Enable Sidebar on Pages', 'epcl_framework'),
			'subtitle' => '',
			'desc' => __('This option will override any post setting, it is useful if you want to disable all sidebars inside your pages.', 'epcl_framework'),
            'options' => array(
                'inherit' => 'Inherit from every Page',
                'enabled' => 'Enabled',
                'disabled' => 'Disabled'
        ),
			'default' => 'inherit'
		),
		array(
			'id' => 'custom_sidebar',
			'type' => 'repeater',
			'button_title' => esc_html__('Add More', 'epcl_framework'),
			'title' => esc_html__('Custom Sidebar for pages and posts', 'epcl_framework'),
			'subtitle' => esc_html__('Enter an unique name', 'epcl_framework'),
			'desc' => esc_html__('You must enter an unique name for every added sidebar (duplicated sidebars will be removed).', 'epcl_framework'),
            'fields' => array(
                array(
                  'id'    => 'sidebar',
                  'type'  => 'text',
                  'title' => esc_attr__('Sidebar Name:', 'epcl_framework')
                ),            
            ),
        ),
        array(
			'id' => 'title_sidebar_mobile',
            'type' => 'subheading',
            'notice' => false,
            'title' => __('Mobile Settings', 'epcl_framework'),
			'subtitle' => __( 'All devices below 768px of width (cellphones and small tablets).', 'epcl_framework')
		),
		array(
			'id' => 'enable_mobile_sidebar',
			'type' => 'switcher',
			'title' => esc_html__('Display page sidebar on mobile devices', 'epcl_framework'), 
			'desc' => esc_html__('If disabled, right sidebar (home, page, post, etc) will not be displayed. Useful if you want to display only your content on these devices.', 'epcl_framework'),
			'default' => 0
		),
		array(
			'id' => 'mobile_sidebar',
            'type' => 'select',
            'chosen' => true,
			'title' => esc_html__('Mobile Page Sidebar', 'epcl_framework'),
			'desc' => esc_html__('Leave blank to use the default page sidebar.<br>You can add a new custom sidebar at the top of this page, then click save to see it here.', 'epcl_framework'),
            'options' => 'sidebars',
            'placeholder' => esc_html__('Select Sidebar', 'epcl_framework'),
            'settings' => array(
                'width' => '200px',
            )
		),
		array(
			'id' => 'enable_mobile_footer_sidebar',
			'type' => 'switcher',
			'title' => esc_html__('Display footer sidebar on mobile devices', 'epcl_framework'), 
			'desc' => esc_html__('If disabled, all widgets on tablet and mobile devices will be disabled. Useful if you want to display only the content on these devices.', 'epcl_framework'),
			'default' => 1
		),
		array(
			'id' => 'mobile_footer_sidebar',
            'type' => 'select',
            'chosen' => true,            
			'title' => esc_html__('Mobile Footer Sidebar', 'epcl_framework'),
			'desc' => esc_html__('Leave blank to use the default footer sidebar.<br>You can add a new custom sidebar at the top of this page, then click save to see it here.', 'epcl_framework'),
            'options' => 'sidebars',
            'placeholder' => esc_html__('Select Sidebar', 'epcl_framework'),
            'settings' => array(
                'width' => '200px',
            )
		),
	)
) );