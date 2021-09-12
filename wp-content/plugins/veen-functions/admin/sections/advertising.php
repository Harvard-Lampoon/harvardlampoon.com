<?php

/* Unique options for every EP theme */

$opt_name = EPCL_FRAMEWORK_VAR;

/* Advertising Settings */

CSF::createSection( $opt_name, array(
    'id' => 'advertising',
    'title' => esc_html__('Advertising', 'epcl_framework'),
    'icon' => 'fa fa-dollar'
) );

/* Header */

CSF::createSection( $opt_name, array(
    'title' => esc_html__('Header section', 'epcl_framework'),
    // 'icon' => 'fa fa-dollar',
    'parent' => 'advertising',
    'fields' => array(
        array(
			'id' => 'ads_top_header',
			'type' => 'subheading',
			'title' => __('Top Header', 'epcl_framework'),
			'subtitle' => __('This section is only visible when header layout is equal to advertising area. Size: 728x90px', 'epcl_framework'),
			'indent' => true
		),
		array(
			'id' => 'header_advertising_type',
			'type' => 'button_set',
			'title' => esc_html__('Header Advertising Type', 'epcl_framework'),
			'desc' => '',
			'options'   => array(
				'image' => 'Image',
				'code' => 'Code',
			),
			'default' => 'image',
        ),
        array(
			'id' => 'header_advertising_image',
			'type' => 'media',
			'dependency' => array('header_advertising_type', '==', 'image'),
			'url' => true,
			'preview'=> true,
			'title' => esc_html__('Header Advertising Image', 'epcl_framework'),
			'desc' => esc_html__('Recommended sizes - width: 728px, height: 90px.', 'epcl_framework'),
        ),
        array(
			'id' => 'header_advertising_url',
			'type' => 'text',
			'dependency' => array('header_advertising_type', '==', 'image'),
            'sanitize' => 'sanitize_url',
			'title' => esc_html__('Header Advertising URL', 'epcl_framework'),
			'desc' => esc_html__('e.g. http://www.ads.com/myurl', 'epcl_framework')
		),
		array(
			'id' => 'header_advertising_code',
			'type' => 'code_editor',
			'dependency' => array('header_advertising_type', '==', 'code'),
			'title' => esc_html__('Header Custom Code', 'epcl_framework'),
            'desc' => esc_html__('Here you can paste your custom advertising code.', 'epcl_framework'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'htmlmixed',
                'tabSize' => 4
            ),
            'sanitize' => false
        ),
        // Below header
		array(
			'id' => 'ads_below_header',
			'type' => 'subheading',
			'title' => __('Below Header', 'epcl_framework'),
			'subtitle' => __('This section will show a global ads (pages, single posts, archives, etc). Size: 970x90 (or ad-format="horizontal" for adsense)', 'epcl_framework'),
			'indent' => true
		),
		array(
			'id' => 'ads_enabled_below_header',
			'type' => 'switcher',
			'title' => esc_html__('Display Advertise', 'epcl_framework'),
			'desc' => esc_html__('Enable or disable this particular ads section.', 'epcl_framework'),
			'default' => 0
		),
		array(
			'id' => 'ads_type_below_header',
			'type' => 'button_set',
			'title' => esc_html__('Advertising Type', 'epcl_framework'),
			'desc' => '',
			'options'   => array(
				'image' => 'Image',
				'code' => 'Code',
			),
			'default' => 'image',
			'dependency' => array('ads_enabled_below_header', '==', '1')
        ),
        array(
			'id' => 'ads_mobile_below_header',
			'type' => 'switcher',
			'title' => esc_html__('Display Advertise on Mobile', 'epcl_framework'),
			'desc' => esc_html__('Disabling ads on mobile can improve your website speed on cellphones.', 'epcl_framework'),
            'default' => 1,
            'dependency' => array('ads_enabled_below_header', '==', '1')
		),
		array(
			'id' => 'ads_image_below_header',
			'type' => 'media',
            'dependency' => array(
                array( 'ads_enabled_below_header',   '==', '1' ),
                array( 'ads_type_below_header', '==', 'image' ),                
            ),
			'url' => true,
			'preview'=> true,
			'title' => esc_html__('Advertising Image', 'epcl_framework'),
			'desc' => esc_html__('Recommended sizes - width: 728px, height: 90px.', 'epcl_framework'),
		),

		array(
			'id' => 'ads_url_below_header',
			'type' => 'text',
            'dependency' => array(
                array( 'ads_enabled_below_header',   '==', '1' ),
                array( 'ads_type_below_header', '==', 'image' ),                
            ),
			'sanitize' => 'sanitize_url',
			'title' => esc_html__('Advertising URL', 'epcl_framework'),
			'desc' => esc_html__('e.g. http://www.ads.com/myurl', 'epcl_framework')
		),
		array(
			'id' => 'ads_code_below_header',
			'type' => 'code_editor',
            'dependency' => array(
                array( 'ads_enabled_below_header',   '==', '1' ),
                array( 'ads_type_below_header', '==', 'code' ),                
            ),
			'title' => esc_html__('Custom Code', 'epcl_framework'),
            'desc' => esc_html__('Here you can paste your custom advertising code.', 'epcl_framework'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'htmlmixed',
                'tabSize' => 4
            ),
            'sanitize' => false
		),
		array(
			'id' => 'ads_mt_below_header',
			'type' => 'slider',
			'title' => esc_html__('Spacing Top', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 50 pixels.', 'epcl_framework'),
			'default' => '50',
			'min' => '0',
			'step' => '1',
            'max' => '100',
            'unit' => 'px',
			'dependency' => array('ads_enabled_below_header', '==', '1')
		),
		array(
			'id' => 'ads_mb_below_header',
			'type' => 'slider',
			'title' => esc_html__('Spacing Bottom', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 50 pixels.', 'epcl_framework'),
			'default' => '50',
			'min' => '0',
			'step' => '1',
            'max' => '100',
            'unit' => 'px',
			'dependency' => array('ads_enabled_below_header', '==', '1')
		),
    )
) );

/* Single Post  */

CSF::createSection( $opt_name, array(
    'title' => esc_html__('Single Post section', 'epcl_framework'),
    // 'icon' => 'fa fa-dollar',
    'parent' => 'advertising',
    'fields' => array(
		array(
			'id' => 'ads_single_top',
			'type' => 'subheading',
			'title' => __('Before Post Content', 'epcl_framework'),
			'subtitle' => __('This section will show an advertise only on single post content.', 'epcl_framework'),
			'indent' => true
		),
		array(
			'id' => 'ads_enabled_single_top',
			'type' => 'switcher',
			'title' => esc_html__('Display Advertise', 'epcl_framework'),
			'desc' => esc_html__('Enable or disable this particular ads section.', 'epcl_framework'),
			'default' => 0
        ),
        array(
			'id' => 'ads_mobile_single_top',
			'type' => 'switcher',
			'title' => esc_html__('Display Advertise on Mobile', 'epcl_framework'),
			'desc' => esc_html__('Disabling ads on mobile can improve your website speed on cellphones.', 'epcl_framework'),
            'default' => 1,
            'dependency' => array('ads_enabled_single_top', '==', '1')
		),
		array(
			'id' => 'ads_type_single_top',
			'type' => 'button_set',
			'title' => esc_html__('Advertising Type', 'epcl_framework'),
			'desc' => '',
			'options'   => array(
				'image' => 'Image',
				'code' => 'Code',
			),
			'default' => 'image',
			'dependency' => array('ads_enabled_single_top', '==', '1')
		),
		array(
			'id' => 'ads_image_single_top',
			'type' => 'media',
            'dependency' => array(
                array( 'ads_enabled_single_top',   '==', '1' ),
                array( 'ads_type_single_top', '==', 'image' ),                
            ),
			'url' => true,
			'preview'=> true,
			'title' => esc_html__('Advertising Image', 'epcl_framework'),
//			'desc' => esc_html__('Recommended sizes - width: 728px, height: 90px.', 'epcl_framework'),
		),
		array(
			'id' => 'ads_url_single_top',
			'type' => 'text',
            'dependency' => array(
                array( 'ads_enabled_single_top',   '==', '1' ),
                array( 'ads_type_single_top', '==', 'image' ),                
            ),
			'sanitize' => 'sanitize_url',
			'title' => esc_html__('Advertising URL', 'epcl_framework'),
			'desc' => esc_html__('e.g. http://www.ads.com/myurl', 'epcl_framework')
		),
		array(
			'id' => 'ads_code_single_top',
			'type' => 'code_editor',
            'dependency' => array(
                array( 'ads_enabled_single_top',   '==', '1' ),
                array( 'ads_type_single_top', '==', 'code' ),                
            ),
			'title' => esc_html__('Custom Code', 'epcl_framework'),
            'desc' => esc_html__('Here you can paste your custom advertising code.', 'epcl_framework'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'htmlmixed',
                'tabSize' => 4
            ),
            'sanitize' => false
		),
		array(
			'id' => 'ads_mt_single_top',
			'type' => 'slider',
			'title' => esc_html__('Spacing Top', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 25 pixels.', 'epcl_framework'),
			'default' => '25',
			'min' => '0',
			'step' => '1',
            'max' => '100',
            'unit' => 'px',
			'dependency' => array('ads_enabled_single_top', '==', '1')
		),
		array(
			'id' => 'ads_mb_single_top',
			'type' => 'slider',
			'title' => esc_html__('Spacing Bottom', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 25 pixels.', 'epcl_framework'),
			'default' => '25',
			'min' => '0',
			'step' => '1',
            'max' => '100',
            'unit' => 'px',
			'dependency' => array('ads_enabled_single_top', '==', '1')
        ),
        // Single Bottom
		array(
			'id' => 'ads_single_bottom',
			'type' => 'subheading',
			'title' => __('After Post content', 'epcl_framework'),
			'subtitle' => __('This section will show an advertise at the of the single post content.', 'epcl_framework'),
			'indent' => true
		),
		array(
			'id' => 'ads_enabled_single_bottom',
			'type' => 'switcher',
			'title' => esc_html__('Display Advertise', 'epcl_framework'),
			'desc' => esc_html__('Enable or disable this particular ads section.', 'epcl_framework'),
			'default' => 0
        ),
        array(
			'id' => 'ads_mobile_single_bottom',
			'type' => 'switcher',
			'title' => esc_html__('Display Advertise on Mobile', 'epcl_framework'),
			'desc' => esc_html__('Disabling ads on mobile can improve your website speed on cellphones.', 'epcl_framework'),
            'default' => 1,
            'dependency' => array('ads_enabled_single_bottom', '==', '1')
		),
		array(
			'id' => 'ads_type_single_bottom',
			'type' => 'button_set',
			'title' => esc_html__('Advertising Type', 'epcl_framework'),
			'desc' => '',
			'options'   => array(
				'image' => 'Image',
				'code' => 'Code',
			),
            'default' => 'image',
            'dependency' => array('ads_enabled_single_bottom', '==', '1')
		),
		array(
			'id' => 'ads_image_single_bottom',
			'type' => 'media',
            'dependency' => array(
                array( 'ads_enabled_single_bottom',   '==', '1' ),
                array( 'ads_type_single_bottom', '==', 'image' ),                
            ),
			'url' => true,
			'preview'=> true,
			'title' => esc_html__('Advertising Image', 'epcl_framework'),
//			'desc' => esc_html__('Recommended sizes - width: 728px, height: 90px.', 'epcl_framework'),
		),
		array(
			'id' => 'ads_url_single_bottom',
			'type' => 'text',
            'dependency' => array(
                array( 'ads_enabled_single_bottom',   '==', '1' ),
                array( 'ads_type_single_bottom', '==', 'image' ),                
            ),
			'sanitize' => 'sanitize_url',
			'title' => esc_html__('Advertising URL', 'epcl_framework'),
			'desc' => esc_html__('e.g. http://www.ads.com/myurl', 'epcl_framework')
		),
		array(
			'id' => 'ads_code_single_bottom',
			'type' => 'code_editor',
            'dependency' => array(
                array( 'ads_enabled_single_bottom',   '==', '1' ),
                array( 'ads_type_single_bottom', '==', 'code' ),                
            ),
			'title' => esc_html__('Custom Code', 'epcl_framework'),
            'desc' => esc_html__('Here you can paste your custom advertising code.', 'epcl_framework'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'htmlmixed',
                'tabSize' => 4
            ),
            'sanitize' => false
		),
		array(
			'id' => 'ads_mt_single_bottom',
			'type' => 'slider',
			'title' => esc_html__('Spacing Top', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 25 pixels.', 'epcl_framework'),
			'default' => '25',
			'min' => '0',
			'step' => '1',
            'max' => '100',
            'unit' => 'px',
			'dependency' => array('ads_enabled_single_bottom', '==', '1')
		),
		array(
			'id' => 'ads_mb_single_bottom',
			'type' => 'slider',
			'title' => esc_html__('Spacing Bottom', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 25 pixels.', 'epcl_framework'),
			'default' => '25',
			'min' => '0',
			'step' => '1',
            'max' => '100',
            'unit' => 'px',
			'dependency' => array('ads_enabled_single_bottom', '==', '1')
		),
    )
) );

/* Custom Shortcode ADS */

CSF::createSection( $opt_name, array(
    'title' => esc_html__('Custom Ads (shortcode)', 'epcl_framework'),
    // 'icon' => 'fa fa-dollar',
    'parent' => 'advertising',
    'fields' => array(
		array(
			'id' => 'ads_custom_shortcode_title_1',
			'type' => 'subheading',
            'title' => __('Shortcode nº 1', 'epcl_framework'),
			'subtitle' => __('This section can be displayed anywhere on the website, just copy and paste the shortcode below.', 'epcl_framework'),
			'indent' => true
		),
		array(
			'id' => 'ads_custom_shortcode_copy',
			'type' => 'text',
			'title' => esc_html__('Shortcode', 'epcl_framework'),
			'default' => '[epcl_custom_ads id="1"]',
            'attributes' => array(
                'readonly' => true,
            ),
		),
		array(
			'id' => 'ads_enabled_custom_shortcode',
			'type' => 'switcher',
			'title' => esc_html__('Display Advertise', 'epcl_framework'),
			'desc' => esc_html__('Enable or disable this particular ads section.', 'epcl_framework'),
			'default' => 0
        ),
        array(
			'id' => 'ads_mobile_custom_shortcode',
			'type' => 'switcher',
			'title' => esc_html__('Display Advertise on Mobile', 'epcl_framework'),
			'desc' => esc_html__('Disabling ads on mobile can improve your website speed on cellphones.', 'epcl_framework'),
            'default' => 1,
            'dependency' => array('ads_enabled_custom_shortcode', '==', '1')
		),
		array(
			'id' => 'ads_type_custom_shortcode',
			'type' => 'button_set',
			'title' => esc_html__('Advertising Type', 'epcl_framework'),
			'desc' => '',
			'options'   => array(
				'image' => 'Image',
				'code' => 'Code',
			),
			'default' => 'image',
			'dependency' => array('ads_enabled_custom_shortcode', '==', '1')
		),
		array(
			'id' => 'ads_image_custom_shortcode',
			'type' => 'media',
            'dependency' => array(
                array( 'ads_enabled_custom_shortcode',   '==', '1' ),
                array( 'ads_type_custom_shortcode', '==', 'image' ),                
            ),
			'url' => true,
			'preview'=> true,
			'title' => esc_html__('Advertising Image', 'epcl_framework'),
//			'desc' => esc_html__('Recommended sizes - width: 728px, height: 90px.', 'epcl_framework'),
		),
		array(
			'id' => 'ads_url_custom_shortcode',
			'type' => 'text',
            'dependency' => array(
                array( 'ads_enabled_custom_shortcode',   '==', '1' ),
                array( 'ads_type_custom_shortcode', '==', 'image' ),                
            ),
			'sanitize' => 'sanitize_url',
			'title' => esc_html__('Advertising URL', 'epcl_framework'),
			'desc' => esc_html__('e.g. http://www.ads.com/myurl', 'epcl_framework')
		),
		array(
			'id' => 'ads_code_custom_shortcode',
			'type' => 'code_editor',
            'dependency' => array(
                array( 'ads_enabled_custom_shortcode',   '==', '1' ),
                array( 'ads_type_custom_shortcode', '==', 'code' ),                
            ),
			'title' => esc_html__('Custom Code', 'epcl_framework'),
            'desc' => esc_html__('Here you can paste your custom advertising code.', 'epcl_framework'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'htmlmixed',
                'tabSize' => 4
            ),
            'sanitize' => false
		),
		array(
			'id' => 'ads_mt_custom_shortcode',
			'type' => 'slider',
			'title' => esc_html__('Spacing Top', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 25 pixels.', 'epcl_framework'),
			'default' => '25',
			'min' => '0',
			'step' => '1',
            'max' => '100',
            'unit' => 'px',
			'dependency' => array('ads_enabled_custom_shortcode', '==', '1')
		),
		array(
			'id' => 'ads_mb_custom_shortcode',
			'type' => 'slider',
			'title' => esc_html__('Spacing Bottom', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 25 pixels.', 'epcl_framework'),
			'default' => '25',
			'min' => '0',
			'step' => '1',
            'max' => '100',
            'unit' => 'px',
			'dependency' => array('ads_enabled_custom_shortcode', '==', '1')
        ),
        // Shortcode nº 2
        array(
			'id' => 'ads_custom_shortcode_title_2',
			'type' => 'subheading',
			'title' => __('Shortcode nº 2', 'epcl_framework'),
			'subtitle' => __('This section can be displayed anywhere on the website, just copy and paste the shortcode below.', 'epcl_framework'),
			'indent' => true
		),
        array(
			'id' => 'ads_custom_shortcode_copy_2',
			'type' => 'text',
			'title' => esc_html__('Shortcode', 'epcl_framework'),
			'default' => '[epcl_custom_ads id="2"]',
			'attributes' => array(
                'readonly' => true
            )
		),
		array(
			'id' => 'ads_enabled_custom_shortcode_2',
			'type' => 'switcher',
			'title' => esc_html__('Display Advertise', 'epcl_framework'),
			'desc' => esc_html__('Enable or disable this particular ads section.', 'epcl_framework'),
			'default' => 0
        ),
        array(
			'id' => 'ads_mobile_custom_shortcode_2',
			'type' => 'switcher',
			'title' => esc_html__('Display Advertise on Mobile', 'epcl_framework'),
			'desc' => esc_html__('Disabling ads on mobile can improve your website speed on cellphones.', 'epcl_framework'),
            'default' => 1,
            'dependency' => array('ads_enabled_custom_shortcode_2', '==', '1')
		),
		array(
			'id' => 'ads_type_custom_shortcode_2',
			'type' => 'button_set',
			'title' => esc_html__('Advertising Type', 'epcl_framework'),
			'desc' => '',
			'options'   => array(
				'image' => 'Image',
				'code' => 'Code',
			),
			'default' => 'image',
			'dependency' => array('ads_enabled_custom_shortcode_2', '==', '1')
		),
		array(
			'id' => 'ads_image_custom_shortcode_2',
			'type' => 'media',
            'dependency' => array(
                array( 'ads_enabled_custom_shortcode_2',   '==', '1' ),
                array( 'ads_type_custom_shortcode_2', '==', 'image' ),                
            ),
			'url' => true,
			'preview'=> true,
			'title' => esc_html__('Advertising Image', 'epcl_framework'),
//			'desc' => esc_html__('Recommended sizes - width: 728px, height: 90px.', 'epcl_framework'),
		),
		array(
			'id' => 'ads_url_custom_shortcode_2',
			'type' => 'text',
            'dependency' => array(
                array( 'ads_enabled_custom_shortcode_2',   '==', '1' ),
                array( 'ads_type_custom_shortcode_2', '==', 'image' ),                
            ),
			'sanitize' => 'sanitize_url',
			'title' => esc_html__('Advertising URL', 'epcl_framework'),
			'desc' => esc_html__('e.g. http://www.ads.com/myurl', 'epcl_framework')
		),
		array(
			'id' => 'ads_code_custom_shortcode_2',
			'type' => 'code_editor',
            'dependency' => array(
                array( 'ads_enabled_custom_shortcode_2',   '==', '1' ),
                array( 'ads_type_custom_shortcode_2', '==', 'code' ),                
            ),
			'title' => esc_html__('Custom Code', 'epcl_framework'),
            'desc' => esc_html__('Here you can paste your custom advertising code.', 'epcl_framework'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'htmlmixed',
                'tabSize' => 4
            ),
            'sanitize' => false
		),
		array(
			'id' => 'ads_mt_custom_shortcode_2',
			'type' => 'slider',
			'title' => esc_html__('Spacing Top', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 25 pixels.', 'epcl_framework'),
			'default' => '25',
			'min' => '0',
			'step' => '1',
            'max' => '100',
            'unit' => 'px',
			'dependency' => array('ads_enabled_custom_shortcode_2', '==', '1')
		),
		array(
			'id' => 'ads_mb_custom_shortcode_2',
			'type' => 'slider',
			'title' => esc_html__('Spacing Bottom', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 25 pixels.', 'epcl_framework'),
			'default' => '25',
			'min' => '0',
			'step' => '1',
            'max' => '100',
            'unit' => 'px',
			'dependency' => array('ads_enabled_custom_shortcode_2', '==', '1')
		),
    )
) );

/* Custom Shortcode ADS */

/* Loops */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Ads on grid loop', 'epcl_framework'),
	'parent' => 'advertising',
	'fields' => array(
		array(
			'id' => 'ads_custom_shortcode',
			'type' => 'subheading',
			'title' => __('Advertising on grid loops', 'epcl_framework'),
			'subtitle' => __('This section will be displayed between posts, specifically on grids articles loop.', 'epcl_framework'),
			'indent' => true
		),
		array(
			'id' => 'ads_enabled_grid_loop',
			'type' => 'switcher',
			'title' => esc_html__('Display Advertise', 'epcl_framework'),
			'desc' => esc_html__('Enable or disable this particular ads section.', 'epcl_framework'),
			'default' => 0
        ),
        array(
			'id' => 'ads_mobile_grid_loop',
			'type' => 'switcher',
			'title' => esc_html__('Display Advertise on Mobile', 'epcl_framework'),
			'desc' => esc_html__('Disabling ads on mobile can improve your website speed on cellphones.', 'epcl_framework'),
            'default' => 1,
            'dependency' => array('ads_enabled_grid_loop', '==', '1')
		),
		array(
			'id' => 'ads_position_grid_loop',
			'type' => 'slider',
			'title' => esc_html__('Ads position', 'epcl_framework'),
			'subtitle' => esc_html__('Recommended: 3', 'epcl_framework'),
			'desc' => esc_html__('Set the position that will use this ads on the main loop.', 'epcl_framework'),
			'default' => '3',
			'min' => '1',
			'step' => '1',
			'max' => get_option( 'posts_per_page' ),
			'dependency' => array('ads_enabled_grid_loop', '==', '1')
		),
		array(
			'id' => 'ads_type_grid_loop',
			'type' => 'button_set',
			'title' => esc_html__('Advertising Type', 'epcl_framework'),
			'desc' => '',
			'options'   => array(
				'image' => 'Image',
				'code' => 'Code',
			),
			'default' => 'image',
			'dependency' => array('ads_enabled_grid_loop', '==', '1')
		),
		array(
			'id' => 'ads_image_grid_loop',
			'type' => 'media',
            'dependency' => array(
                array( 'ads_enabled_grid_loop', '==', '1' ),
                array( 'ads_type_grid_loop', '==', 'image' ),                
            ),
			'url' => true,
			'preview'=> true,
			'title' => esc_html__('Advertising Image', 'epcl_framework'),
//			'desc' => esc_html__('Recommended sizes - width: 728px, height: 90px.', 'epcl_framework'),
		),
		array(
			'id' => 'ads_url_grid_loop',
			'type' => 'text',
            'dependency' => array(
                array( 'ads_enabled_grid_loop', '==', '1' ),
                array( 'ads_type_grid_loop', '==', 'image' ),                
            ),
			'sanitize' => 'sanitize_url',
			'title' => esc_html__('Advertising URL', 'epcl_framework'),
			'desc' => esc_html__('e.g. http://www.ads.com/myurl', 'epcl_framework')
		),
		array(
			'id' => 'ads_code_grid_loop',
			'type' => 'code_editor',
            'dependency' => array(
                array( 'ads_enabled_grid_loop', '==', '1' ),
                array( 'ads_type_grid_loop', '==', 'code' ),                
            ),
			'title' => esc_html__('Custom Code', 'epcl_framework'),
            'desc' => esc_html__('Here you can paste your custom advertising code.', 'epcl_framework'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'htmlmixed',
                'tabSize' => 4
            ),
            'sanitize' => false
		),
		array(
			'id' => 'ads_mt_grid_loop',
			'type' => 'slider',
			'title' => esc_html__('Spacing Top', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 25 pixels.', 'epcl_framework'),
			'default' => '25',
			'min' => '0',
			'step' => '1',
            'max' => '100',
            'unit' => 'px',
			'dependency' => array('ads_enabled_grid_loop', '==', '1')
		),
		array(
			'id' => 'ads_mb_grid_loop',
			'type' => 'slider',
			'title' => esc_html__('Spacing Bottom', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 25 pixels.', 'epcl_framework'),
			'default' => '25',
			'min' => '0',
			'step' => '1',
            'max' => '100',
            'unit' => 'px',
			'dependency' => array('ads_enabled_grid_loop', '==', '1')
		),
	)
) );
