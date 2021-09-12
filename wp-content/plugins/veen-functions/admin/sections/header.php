<?php

/* Unique options for every EP theme */

$admin_url = EPCL_PLUGIN_URL.'/functions/admin';
$opt_name = EPCL_FRAMEWORK_VAR;

$primary_color = '#FF486A';
$secondary_color = '#7169FE';
$text_color = '#596172';
$border_color = '#eee';
$input_bg_color = '#f9f9f9';
$black = '#242323';
$white = '#ffffff';

/* Header */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Header', 'epcl_framework'),
	'icon' => 'fa fa-columns',
	'fields' => array(
		array(
			'id' => 'title_header',
            'type' => 'subheading',
			'title' => __( 'Headers', 'epcl_framework')
		),
		array(
			'id' => 'header_type',
			'type' => 'radio',
			'title' => esc_html__('Header Layout', 'epcl_framework'),
			'desc' => '',
			'options'   => array(
				'minimalist' => 'Minimalist',
                'classic' => 'Classic',
                'advertising' => 'Advertising Area',
			),
			'default' => 'classic',
			'desc' => __( 'Important: if advertising area is selected, you must add your banner on advertising section -> header.', 'epcl_framework')
        ),
        array(
			'id' => 'enable_sticky_header',
			'type' => 'switcher',
			'title' => esc_html__('Enable sticky header', 'epcl_framework'),
			'desc' => '',
			'default' => '0'
        ),
        array(
			'id' => 'enable_share_header',
			'type' => 'switcher',
			'title' => esc_html__('Enable Share Buttons on Header', 'epcl_framework'),
			'desc' => esc_html__('Don\'t forget to fill your social profiles', 'epcl_framework').' <a href="'.admin_url().'admin.php?page=ThemeOptionsPanel&tab=27">'.esc_html__('here', 'epcl_framework').'.</a>',
			'default' => '0'
        ),
        array(
			'id' => 'enable_search_header',
			'type' => 'switcher',
			'title' => esc_html__('Enable Search Button on main menu', 'epcl_framework'),			
			'default' => '1'
        ),
        array(
			'id' => 'enable_scroll_submenu',
			'type' => 'switcher',
			'title' => esc_html__('Enable Scroll on Sub Menus', 'epcl_framework'),
			'desc' => __('If you have large sub menus, it is recommendable to enable this option, but you can\'t use 2nd level menus <a href="http://prntscr.com/lal72g" target="_blank">Example Here</a>', 'epcl_framework'),
			'default' => '0'
        ),
		array(
			'id' => 'title_logo',
            'type' => 'subheading',
			'title' => __( 'Logo', 'epcl_framework')
		),
		array(
			'id' => 'logo_type',
			'type' => 'button_set',
			'title' => esc_html__('Logo Type', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Select image if you want to upload a custom logo.', 'epcl_framework'),
			'options' => array('1' => 'Image', '2' => 'Text'),
			'default' => '2'
		),
		array(
			'id' => 'logo_icon',
			'type' => 'icon',
			'dependency' => array('logo_type', '==', '2'),
			'title' => esc_html__('Logo icon (optional)', 'epcl_framework'),
			'desc' => esc_html__('e.g. fa-shield', 'epcl_framework'),
		),
		array(
			'id' => 'logo_icon_color',
			'type' => 'color',
			'dependency' => array('logo_type', '==', '2'),
			'title' => esc_html__('Logo Icon Color', 'epcl_framework'),
			'default' => $black,
			// 'validate' => 'color',
			'transparent' => false
		),
		array(
			'id' => 'logo_text_color',
			'type' => 'color',
			'dependency' => array('logo_type', '==', '2'),
			'title' => esc_html__('Logo Text Color', 'epcl_framework'),
			'default' => $black,
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'logo_font_size_desktop',
            'type' => 'slider',
            'dependency' => array('logo_type', '==', '2'),
			'title' => esc_html__('Desktop Logo Font Size', 'epcl_framework'),
			// 'subtitle' => esc_html__('Paragraphs and general content.', 'epcl_framework'),
			'desc' => esc_html__('Default: 60 pixels.', 'epcl_framework'),
			'default' => '60',
			'min' => '9',
			'step' => '1',
            'max' => '100',
            'unit' => 'px',
        ),
        array(
			'id' => 'logo_font_size_mobile',
            'type' => 'slider',
            'dependency' => array('logo_type', '==', '2'),
			'title' => esc_html__('Mobile Logo Font Size', 'epcl_framework'),
			// 'subtitle' => esc_html__('Paragraphs and general content.', 'epcl_framework'),
			'desc' => esc_html__('Default: 40 pixels.', 'epcl_framework'),
			'default' => '40',
			'min' => '9',
			'step' => '1',
            'max' => '100',
            'unit' => 'px',
		),
        // Image logo
		array(
			'id' => 'logo_image',
			'type' => 'media',
			'dependency' => array('logo_type', '==', '1'),
			'url' => true,
			'preview'=> true,
			'title' => esc_html__('Logo Uploader', 'epcl_framework'),
			'desc' => esc_html__('Recommended sizes - width: 320px, height: 120px.', 'epcl_framework'),
		),
		array(
			'id' => 'info_image_size',
			'type' => 'submessage',
			'style' => 'info',
			'dependency' => array('logo_type', '==', '1'),
			// 'title' => esc_html__('Important!', 'epcl_framework'),
			'content' => __('You must set the half width and height of your uploaded logo.<br> Example, if your logo is 500x200 you must enter 250 in the width input field and 100 in the next one.', 'epcl_framework')
		),
		array(
			'id' => 'logo_width',
			'type' => 'number',
			// 'validate' => 'numeric',
			'dependency' => array('logo_type', '==', '1'),
			'title' => esc_html__('Logo width (Optional)', 'epcl_framework'),
			'subtitle' => esc_html__('Default: 160 (pixels)', 'epcl_framework'),
			'desc' => esc_html__('Note: this is the half width of your uploaded logo for retina display purposes.', 'epcl_framework'),
            'default' => '',
            'unit' => 'px'
        ),
        array(
			'id' => 'sticky_logo_image',
			'type' => 'media',
			'dependency' => array('logo_type', '==', '1'),
			'url' => true,
			'preview'=> true,
			'title' => esc_html__('Sticky Logo Uploader (Optional)', 'epcl_framework'),
			'desc' => esc_html__('If blank, logo image will be used. Recommended size - width: 160px, height: 40px.', 'epcl_framework'),
        ),
        array(
			'id' => 'sticky_logo_width',
			'type' => 'number',
			// 'validate' => 'numeric',
			'dependency' => array('logo_type', '==', '1'),
			'title' => esc_html__('Sticky Logo width (Optional)', 'epcl_framework'),
			'subtitle' => esc_html__('Default: 160 (pixels)', 'epcl_framework'),
			// 'desc' => esc_html__('Note: this is the half width of your uploaded logo for retina display purposes.', 'epcl_framework'),
            'default' => '',
            'unit' => 'px'
        ),
		// array(
		// 	'id' => 'sticky_logo',
		// 	'type' => 'media',
		// 	'dependency' => array('logo_type', '==', '1'),
		// 	'url' => true,
		// 	'preview'=> true,
		// 	'title' => esc_html__('Small Logo Uploader', 'epcl_framework'),
		// 	'subtitle' => esc_html__('Used like sticky logo and minimalist header type.', 'epcl_framework'),
		// 	'desc' => esc_html__('Recommended sizes - <b>width: 448px</b>, <b>height: 48px</b>. (For retina display purposes)', 'epcl_framework'),
		// ),
		// array(
		// 	'id' => 'sticky_logo_width',
		// 	'type' => 'text',
		// 	'validate' => 'numeric',
		// 	'dependency' => array('logo_type', '==', '1'),
		// 	'title' => esc_html__('Small Logo width (Optional)', 'epcl_framework'),
		// 	'subtitle' => esc_html__('Default: <b>224</b> (pixels)', 'epcl_framework'),
		// 	'desc' => esc_html__('Note: this is the half width of your uploaded logo for retina display purposes.', 'epcl_framework'),
		// 	'default' => '224'
		// ),
		array(
			'id' => 'title_notice',
            'type' => 'subheading',
            'notice' => false,
			'title' => __( 'Notice / Advertise', 'epcl_framework')
		),
		array(
			'id' => 'enable_notice',
			'type' => 'switcher',
			'title' => esc_html__('Display Header Notice', 'epcl_framework'),
			'desc' => '',
			'default' => 0
        ),
        array(
			'id' => 'enable_notice_close',
			'type' => 'switcher',
            'title' => esc_html__('Display Notice close button', 'epcl_framework'),
            'subtitle' => esc_html__('If an user click the close button, the notice will be removed for 5 days.', 'epcl_framework'),
			'desc' => '',
			'default' => 0
		),
		array(
			'id' => 'notice_text',
			'type' => 'wp_editor',
			'title' => esc_html__('Notice text', 'epcl_framework'),
			'subtitle' => esc_html__('HTML and Shortcodes are allowed', 'epcl_framework'),
            'desc' => '',
            'media_buttons' => false,
		),
	)
) );
