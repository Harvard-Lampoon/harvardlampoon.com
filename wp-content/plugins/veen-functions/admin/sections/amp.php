<?php


/* AMP Settings */

CSF::createSection( $opt_name, array(
    'id' => 'amp',
    'title' => esc_html__('AMP', 'epcl_framework'),
    'icon' => 'fa fa-bolt'
) );


CSF::createSection( $opt_name, array(
	'title' => esc_html__('Global Options', 'epcl_framework'),
    // 'icon' => 'fa fa-bolt',
    'parent' => 'amp',
	'fields' => array(
		array(
			'id' => 'amp_enabled',
			'type' => 'switcher',
            'title' => esc_html__('Enable AMP Optimization', 'epcl_framework'),
            // 'subtitle' => esc_html__('W3 Total Cache plugin recommended', 'epcl_framework'),
			'desc' => __('You must install the <a href="https://wordpress.org/plugins/amp/" target="_blank">Official AMP plugin for WordPress</a> to enable this option. <b>Important: AMP will remove all scripts</b> so maybe some third party plugins will stop working, in that case is a good idea to hide those elements who are not working with custom CSS.', 'epcl_framework'),
			'default' => false
        ),
        array(
			'id' => 'amp_home_layout',
			'type' => 'button_set',
			'title' => esc_html__('Home layout on AMP', 'epcl_framework'),
            'desc' => esc_html__('By default is used classic posts.', 'epcl_framework'),
            'options'  => array(
                'classic-posts' => esc_html__('Classic Posts', 'epcl_framework'),
                'grid-posts' => esc_html__('Grid Posts', 'epcl_framework'),          
            ),
			'default' => 'classic-posts'
        ),
        array(
			'id' => 'amp_archives_layout',
			'type' => 'button_set',
			'title' => esc_html__('Archives layout on AMP', 'epcl_framework'),
            'desc' => esc_html__('By default is used grid posts.', 'epcl_framework'),
            'options'  => array(
                'classic-posts' => esc_html__('Classic Posts', 'epcl_framework'),
                'grid-posts' => esc_html__('Grid Posts', 'epcl_framework'),          
            ),
			'default' => 'grid-posts'
        ),
        array(
			'id' => 'amp_enable_google_fonts',
			'type' => 'switcher',
            'title' => esc_html__('Load default Google Fonts', 'epcl_framework'),
            'subtitle' => esc_html__('Montserrat and Poppins.', 'epcl_framework'),
			'desc' => esc_html__('Enable/disable theme default Google Fonts, you can disable them if you are using a system font and you want to increase the overall speed.', 'epcl_framework'),
            'default' => true,
        ),
        array(
			'id' => 'amp_body_font',
			'type' => 'typography',
			'title' => esc_html__('Safe Regular Text Font', 'epcl_framework'),
            'subtitle' => esc_html__('Default: Josefin Sans (Google font)', 'epcl_framework'),		
            'desc' => esc_html__('Recommended: Verdana:400', 'epcl_framework'),		
			'subset' => false,
			'font_size' => false,
			'line_height' => false,
            'text_align' => false,
            'text_transform' => false,
            'letter_spacing' => false,
            'color' => false,
            'exclude' => 'google',
            'dependency' => array(
                array( 'amp_enable_google_fonts', '==', '0' ),              
            ),
            'default' => array(
				'font-size' => '15px',
				'font-family' => '',
				'font-weight' => '400'
			)
        ),
        array(
			'id' => 'amp_primary_titles_font',
			'type' => 'typography',
			'title' => esc_html__('Safe Primary Titles Font Family', 'epcl_framework'),
			'subtitle' => esc_html__('Default: Nunito (Google font)', 'epcl_framework'),
			'desc' => esc_html__('Recommended: Trebuchet MS:700', 'epcl_framework'),		
			'subset' => false,
			'font_size' => false,
			'line_height' => false,
            'text_align' => false,
            'text_transform' => false,
            'letter_spacing' => false,
            'color' => false,
            'exclude' => 'google',
            'dependency' => array(
                array( 'amp_enable_google_fonts', '==', '0' ),              
            ),
            'default' => array(
				'font-family' => '',
				'font-weight' => '700',
			)
		),
        array(
			'id' => 'amp_css_code',
			'type' => 'code_editor',
			'title' => esc_html__('Custom CSS Code only for AMP pages', 'epcl_framework'),
			'desc' => esc_html__('e.g. #header{ background: #000; } Dont use &lt;style&gt; tags', 'epcl_framework'),
			'subtitle' => __('You must follow <a href="https://amp.dev/documentation/guides-and-tutorials/develop/style_and_layout/style_pages/" target="_blank">AMP CSS Rules</a>', 'epcl_framework'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'css',
                'tabSize' => 4
            ),
            'sanitize' => false
        ),
        array(
			'id' => 'amp_custom_code',
			'type' => 'code_editor',
			'title' => esc_html__('Custom Code only for AMP pages', 'epcl_framework'),
			'desc' => __('This code will appear between <body></body> HTML tags.<br>Only AMP elements and JSON is allowed <b>(NO JAVASCRIPT OR JQUERY).</b>', 'epcl_framework'),
			'subtitle' => __('For example you can paste your AMP only <a href="https://developers.google.com/analytics/devguides/collection/amp-analytics/" target="_blank">Analytics Code</a><br><br>The full list of Analytics providers and their implementations are <a href="https://amp.dev/documentation/guides-and-tutorials/optimize-and-measure/configure-analytics/analytics-vendors/?format=websites" target="_blank">here.</a>', 'epcl_framework'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'css',
                'tabSize' => 4
            ),
            'sanitize' => false
        ),
	)
) );

/*  Advertising  */

CSF::createSection( $opt_name, array(
    'title' => esc_html__('Advertising', 'epcl_framework'),
    // 'icon' => 'fa fa-dollar',
    'parent' => 'amp',
    'fields' => array(
		array(
			'id' => 'amp_auto_ads',
			'type' => 'subheading',
			'title' => __('Adsense Auto ADS', 'epcl_framework'),
			'subtitle' => __('Auto ADS is the best way to monetize your blog without evaluating the best places inside your content.', 'epcl_framework'),
			'indent' => true
		),
		array(
			'id' => 'amp_auto_ads_enabled',
			'type' => 'switcher',
			'title' => esc_html__('Display Advertise', 'epcl_framework'),
			'desc' => esc_html__('Enable or disable this particular ads section.', 'epcl_framework'),
			'default' => 0
        ),
		array(
			'id' => 'amp_auto_ads_client',
			'type' => 'text',
			'title' => esc_html__('Adsense AD Client', 'epcl_framework'),
			'desc' => esc_html__('e.g. ca-pub-1234567891234567', 'epcl_framework'),
			'dependency' => array('amp_auto_ads_enabled', '==', '1'),
        ),	
    )
) );
