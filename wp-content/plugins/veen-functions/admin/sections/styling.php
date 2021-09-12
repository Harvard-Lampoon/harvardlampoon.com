<?php

/* Unique options for every EP theme */

$admin_url = EPCL_PLUGIN_URL.'/functions/admin';

$opt_name = EPCL_FRAMEWORK_VAR;

$primary_color = '#FF486A';
$secondary_color = '#7169FE';
$text_color = '#596172';
$border_color = '#EEEEEE';
$input_bg_color = '#F9F9F9';
$black = '#242323';
$white = '#FFFFFF';

/* Blog */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Styling', 'epcl_framework'),
    'icon' => 'fa fa-pencil',
    'id' => 'styling'
) );

/* Background */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Body Background', 'epcl_framework'),
    // 'icon' => 'el-icon-pencil',
    'parent' => 'styling',
	'fields' => array(
        array(
			'id' => 'background_type',
			'type' => 'button_set',
			'title' => esc_html__('Background Type', 'epcl_framework'),
			'subtitle' => '',
			'desc' => '',
            'options' => array(
                '1' => 'Image Pattern',
                '2' => 'Solid Color',
                '3' => 'Fullscreen Image',
                '4' => 'Gradient',
                // '5' => 'Default Gradient',
            ),
			'default' => '2'
		),
		array(
			'id' => 'bg_body_color',
			'type' => 'color',
			'dependency' => array('background_type', '==', '2'),
			'title' => esc_html__('Body Background Color', 'epcl_framework'),
			'desc' => esc_html__('Pick a background color for the theme.', 'epcl_framework'),
			'default' => $white,
			// 'validate' => 'color',
			'transparent' => false
		),
		array(
			'id' => 'bg_body_pattern',
			'type' => 'media',
			'dependency' => array('background_type', '==', '1'),
			'url' => true,
			'preview'=> true,
			'title' => esc_html__('Pattern Uploader', 'epcl_framework'),
			'desc' => esc_html__('You can get a lot of free patterns on http://subtlepatterns.com', 'epcl_framework'),
		),
		array(
			'id' => 'bg_body_full',
			'type' => 'media',
			'dependency' => array('background_type', '==', '3'),
			'url' => true,
			'preview'=> true,
			'title' => esc_html__('Fullscreen Image', 'epcl_framework'),
			'desc' => esc_html__('Recommended size: 1920x1080 pixels', 'epcl_framework'),
        ),
        array(
			'id' => 'bg_body_gradient',
			'type' => 'color_group',
			'dependency' => array('background_type', '==', '4'),
			'title' => esc_html__('Gradient Color', 'epcl_framework'),
			'desc' => esc_html__('Pick 2 different colors for the gradient.', 'epcl_framework'),
			// 'default' => '#485DA6',
			//// 'validate' => 'color',
            'transparent' => false,
            'options'   => array(
                'from' => esc_html__('From', 'epcl_framework'),
                'to' => esc_html__('To', 'epcl_framework'),
            ),
            'default'  => array(
                'from' => '#485DA6',
                'to'   => '#32b37b', 
            ),
        ),	
	)
) );

/* Basic Styling */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Basic Styling', 'epcl_framework'),
    // 'icon' => 'el-icon-pencil',
    'parent' => 'styling',
	'fields' => array(
        array(
			'id' => 'primary_color',
			'type' => 'color',
			'title' => esc_html__('Primary color ', 'epcl_framework'),
			'default' => $primary_color,
			'subtitle' =>  esc_html__("Default: ".$primary_color, 'epcl_framework'),
            'transparent' => false,
            'class' => 'epcl-hide-transparent',
            'validate' => 'csf_validate_hex_color_transparent',
		),
		array(
			'id' => 'secondary_color',
			'type' => 'color',
			'title' => esc_html__('Secondary color ', 'epcl_framework'),
			'default' => $secondary_color,
			'subtitle' =>  esc_html__("Default: ".$secondary_color, 'epcl_framework'),
			// 'validate' => 'color',
            'transparent' => false,
            'class' => 'epcl-hide-transparent',
            'validate' => 'csf_validate_hex_color_transparent',
		),
		array(
			'id' => 'third_color',
			'type' => 'color',
			'title' => esc_html__('Third color (complementary) ', 'epcl_framework'),
			'default' => $black,
			'subtitle' =>  esc_html__("Default: ".$black, 'epcl_framework'),
			// 'validate' => 'color',
            'transparent' => false,
            'class' => 'epcl-hide-transparent',
            'validate' => 'csf_validate_hex_color_transparent',
		),
		array(
			'id' => 'text_color',
			'type' => 'color',
			'title' => esc_html__('Text Color ', 'epcl_framework'),
			'default' => $text_color,
			'subtitle' =>  esc_html__("Default: ".$text_color, 'epcl_framework'),
			//'validate' => 'color',
            'transparent' => false,
            'class' => 'epcl-hide-transparent',
            'validate' => 'csf_validate_hex_color_transparent',
        ),
	)
) );

/* Header */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Header', 'epcl_framework'),
    // 'icon' => 'el-icon-edit',
    'parent' => 'styling',
	'fields' => array(
        array(
			'id' => 'header_bg_color',
			'type' => 'color',
			'title' => esc_html__('Header Background color', 'epcl_framework'),
			'default' => 'transparent',
			'subtitle' =>  esc_html__('Default: transparent', 'epcl_framework'),
			// 'validate' => 'color',
			// 'transparent' => true
        ),
        array(
			'id' => 'header_menu_link_color',
			'type' => 'link_color',
			'title' => esc_html__('Menu links color', 'epcl_framework'),
			'desc' => '',
			// 'validate' => 'color',
			'active' => true,
			'default' => array(
				'color' => $black,
                'hover' => $primary_color,
                'active' => $primary_color,
			),
        ),
        array(
			'id' => 'header_submenu_link_color',
			'type' => 'link_color',
			'title' => esc_html__('Submenu links color', 'epcl_framework'),
			'desc' => '',
			// 'validate' => 'color',
			'active' => true,
			'default' => array(
				'color' => $black,
                'hover' => $primary_color,
                'active' => $primary_color,
			),
        ),
        array(
			'id' => 'header_submenu_bg_color',
			'type' => 'color',
			'title' => esc_html__('Header Submenu Background color', 'epcl_framework'),
			'default' => $white,
			'subtitle' =>  esc_html__("Default: ".$white, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'header_sticky_bg_color',
			'type' => 'color',
			'title' => esc_html__('Header Sticky Background color', 'epcl_framework'),
			'default' => $white,
			'subtitle' =>  esc_html__("Default: ".$white, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
		),
		array(
			'id' => 'header_mobile_icon_color',
			'type' => 'color',
			'title' => esc_html__('Header Mobile Icon color', 'epcl_framework'),
			'default' => $black,
			'subtitle' =>  esc_html__("Default: ".$black, 'epcl_framework'),
			'desc' =>  esc_html__('This is the menu bar icon, only appears on mobile to show/hide the main menu.', 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
		),
	)
) );

/* Content */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Content', 'epcl_framework'),
    // 'icon' => 'el-icon-edit',
    'parent' => 'styling',
	'fields' => array(
        array(
			'id' => 'selection_bg_color',
			'type' => 'color',
			'title' => esc_html__('Selection background color', 'epcl_framework'),
			'default' => $text_color,
            'subtitle' =>  esc_html__('Default: '.$text_color, 'epcl_framework'),
            'desc' => esc_html__('You will see this event whenever a user make a text a selection.', 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'selection_text_color',
			'type' => 'color',
			'title' => esc_html__('Selection text color', 'epcl_framework'),
			'default' => $white,
            'subtitle' =>  esc_html__("Default: ".$white, 'epcl_framework'),
            'desc' => esc_html__('You will see this event whenever a user make a text a selection.', 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'content_border_color',
			'type' => 'color',
			'title' => esc_html__('Content border color', 'epcl_framework'),
			'default' => $border_color,
            'subtitle' =>  esc_html__("Default: ".$border_color, 'epcl_framework'),
            'desc' => esc_html__('Border between articles and used on the main sidebar.', 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),        
        array(
			'id' => 'main_title_color',
			'type' => 'color',
			'title' => esc_html__('Main titles color', 'epcl_framework'),
			'default' => $black,
			'subtitle' =>  esc_html__("Default: ".$black, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'main_title_decoration_color',
			'type' => 'color',
			'title' => esc_html__('Main Titles dot color', 'epcl_framework'),
			'default' => $primary_color,
			'subtitle' =>  esc_html__("Default: ".$primary_color, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
		),
	)
) );

/* Buttons */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Buttons/Links', 'epcl_framework'),
    // 'icon' => 'el-icon-edit',
    'parent' => 'styling',
	'fields' => array(
        array(
			'id' => 'content_link_color',
			'type' => 'link_color',
			'title' => esc_html__('General link color', 'epcl_framework'),
			'subtitle' => esc_html__("Default: $black, Hover: $primary_color", 'epcl_framework'),
			// 'validate' => 'color',
			'active' => false,
			'default' => array(
				'color' => $black,
                'hover' => $primary_color,
			),
        ),
        array(
			'id' => 'button_bg_color',
			'type' => 'color',
			'title' => esc_html__('Main button background color', 'epcl_framework'),
			'default' => $primary_color,
            'subtitle' =>  esc_html__("Default: ".$primary_color, 'epcl_framework'),
            // 'desc' => '',
			// 'validate' => 'color',
            'transparent' => false,
            // 'class' => 'epcl-hide-transparent',
            'validate' => 'csf_validate_hex_color',
        ),
        array(
			'id' => 'button_text_color',
			'type' => 'color',
			'title' => esc_html__('Main button text color', 'epcl_framework'),
			'default' => $white,
			'subtitle' =>  esc_html__("Default: ".$white, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'button_secondary_bg_color',
			'type' => 'color',
			'title' => esc_html__('Secondary button background color', 'epcl_framework'),
			'default' => $secondary_color,
            'subtitle' =>  esc_html__("Default: ".$secondary_color, 'epcl_framework'),
            // 'desc' => '',
			// 'validate' => 'color',
            'transparent' => false,
            // 'class' => 'epcl-hide-transparent',
            'validate' => 'csf_validate_hex_color',
        ),
        array(
			'id' => 'button_secondary_text_color',
			'type' => 'color',
			'title' => esc_html__('Main button text color', 'epcl_framework'),
			'default' => $white,
			'subtitle' =>  esc_html__("Default: ".$white, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'tag_text_color',
			'type' => 'link_color',
			'title' => esc_html__('Default Tag button text color', 'epcl_framework'),
			'subtitle' => esc_html__("Default: #ffffff, Hover: #ffffff", 'epcl_framework'),
			// 'validate' => 'color',
			'active' => false,
			'default' => array(
				'color' => $white,
                'hover' => $white,
			),
        ),
        array(
			'id' => 'tag_bg_color',
			'type' => 'link_color',
			'title' => esc_html__('Default Tag button background color', 'epcl_framework'),
			'subtitle' => esc_html__("Default: #E84E89, hover: #E84E89", 'epcl_framework'),
			// 'validate' => 'color',
			'active' => false,
			'default' => array(
				'color' => $primary_color,
                'hover' => $primary_color,
			),
        ),
	)
) );

/* Sidebar */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Sidebar', 'epcl_framework'),
    // 'icon' => 'el-icon-edit',
    'parent' => 'styling',
	'fields' => array(
        array(
			'id' => 'sidebar_bg_color',
			'type' => 'color',
			'title' => esc_html__('Sidebar widgets background color', 'epcl_framework'),
			'default' => $white,
            'subtitle' =>  esc_html__('Default: '.$white, 'epcl_framework'),
            // 'desc' => '',
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'sidebar_text_color',
			'type' => 'color',
			'title' => esc_html__('Sidebar text color', 'epcl_framework'),
			'default' => $text_color,
			'subtitle' =>  esc_html__("Default: ".$text_color, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
		),
        array(
			'id' => 'sidebar_link_color',
			'type' => 'link_color',
			'title' => esc_html__('Sidebar links color', 'epcl_framework'),
			'subtitle' => esc_html__("Default: ".$text_color, 'epcl_framework'),
			// 'validate' => 'color',
			'active' => false,
			'default' => array(
				'color' => $text_color,
                'hover' => $primary_color,
			),
        ),
        array(
			'id' => 'sidebar_title_color',
			'type' => 'color',
			'title' => esc_html__('Sidebar titles color', 'epcl_framework'),
			'default' => $black,
			'subtitle' =>  esc_html__('Default: '.$black, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'sidebar_title_decoration_color',
			'type' => 'color',
			'title' => esc_html__('Sidebar title border color', 'epcl_framework'),
			'default' => $primary_color,
			'subtitle' =>  esc_html__("Default: ".$primary_color, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
		),
	)
) );

/* Forms */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Forms', 'epcl_framework'),
    // 'icon' => 'el-icon-edit',
    'parent' => 'styling',
	'fields' => array(
        array(
            'id'   => 'info_forms',
            'type' => 'subheading',
            'title' => esc_html__('Important:', 'epcl_framework'),
            'subtitle' => esc_html__('All these options affects contact and comments form.', 'epcl_framework')
        ),
        array(
			'id' => 'input_bg_color',
			'type' => 'color',
			'title' => esc_html__('Input box background color', 'epcl_framework'),
			'default' => $input_bg_color,
            'subtitle' =>  esc_html__('Default: '.$input_bg_color, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'input_text_color',
			'type' => 'color',
			'title' => esc_html__('Input box text color', 'epcl_framework'),
			'default' => $text_color,
            'subtitle' =>  esc_html__('Default: '.$text_color, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'label_text_color',
			'type' => 'color',
			'title' => esc_html__('Label text color', 'epcl_framework'),
			'default' => $black,
            'subtitle' =>  esc_html__('Default: '.$black, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'submit_bg_color',
			'type' => 'color',
			'title' => esc_html__('Submit button background color', 'epcl_framework'),
			'default' => $primary_color,
            'subtitle' =>  esc_html__("Default: ".$primary_color, 'epcl_framework'),
			// 'validate' => 'color',
            'transparent' => false,
            // 'class' => 'epcl-hide-transparent',
            'validate' => 'csf_validate_hex_color',
        ),
        array(
			'id' => 'submit_text_color',
			'type' => 'color',
			'title' => esc_html__('Submit button text color', 'epcl_framework'),
			'default' => $white,
            'subtitle' =>  esc_html__('Default: '.$white, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),
	)
) );

/* Footer */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Footer', 'epcl_framework'),
    // 'icon' => 'el-icon-edit',
    'parent' => 'styling',
	'fields' => array(
        array(
			'id' => 'footer_bg_color',
			'type' => 'color',
			'title' => esc_html__('Footer background color', 'epcl_framework'),
			'default' => 'transparent',
            'subtitle' =>  esc_html__('Default: transparent', 'epcl_framework'),
            // 'desc' => '',
			// 'validate' => 'color',
			'transparent' => true
        ),
        array(
			'id' => 'footer_text_color',
			'type' => 'color',
			'title' => esc_html__('Footer text color', 'epcl_framework'),
			'default' => $text_color,
			'subtitle' =>  esc_html__('Default: '.$text_color, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
		),
        array(
			'id' => 'footer_link_color',
			'type' => 'link_color',
			'title' => esc_html__('Footer links color', 'epcl_framework'),
			'subtitle' => esc_html__('Default: '.$text_color, 'epcl_framework'),
			// 'validate' => 'color',
			'active' => false,
			'default' => array(
				'color' => $text_color,
                'hover' => $primary_color,
			),
        ),
        array(
			'id' => 'footer_title_color',
			'type' => 'color',
			'title' => esc_html__('Footer titles color', 'epcl_framework'),
			'default' => $black,
			'subtitle' =>  esc_html__('Default: '.$black, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'footer_title_decoration_color',
			'type' => 'color',
			'title' => esc_html__('Footer title dot color', 'epcl_framework'),
			'subtitle' =>  esc_html__("Default: ",$primary_color, 'epcl_framework'),
            'default' => $primary_color,
        ),
        array(
			'id' => 'footer_copyright_color',
			'type' => 'color',
			'title' => esc_html__('Footer copyright text color', 'epcl_framework'),
			'default' => $text_color,
			'subtitle' =>  esc_html__('Default: '.$text_color, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'footer_copyright_link_color',
			'type' => 'color',
			'title' => esc_html__('Footer copyright links color', 'epcl_framework'),
			'subtitle' => esc_html__('Default: '.$text_color, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false,
			'default' => $text_color
        ),
	)
) );
