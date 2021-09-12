<?php

/* Unique options for every EP theme */

$opt_name = EPCL_FRAMEWORK_VAR;
$bg_color = '#252A40';

/* General Settings */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Subscribe Settings', 'epcl_framework'),
	'icon' => ' fa fa-envelope',
	'fields' => array(
        array(
			'id' => 'enable_subscribe',
			'type' => 'switcher',
			'title' => esc_html__('Display subscribe button on Header', 'epcl_framework'),
			'desc' => esc_html__('You must enter a valid Mailchimp url to use this section.', 'epcl_framework'),
			'default' => false
        ),
		array(
			'id' => 'mailchimp_url',
			'type' => 'text',
			// 'validate' => 'url',
			'title' => esc_html__('Subscribe Url', 'epcl_framework'),
			'subtitle' => esc_html__('You can use a Mailchimp Form or any mailing system that generate a public Url. (Mailchimp is recommended, check the documentation).', 'epcl_framework'),
			'fullwidth' => true,
			'desc' => esc_html__('e.g. http://eepurl.com/dxHIUz', 'epcl_framework')
        ),
        array(
			'id' => 'title_subscribe_button',
			'type' => 'text',
			'title' => esc_html__('Title of subscribe button', 'epcl_framework'),
			'desc' => esc_html__('e.g. Subscribe', 'epcl_framework'),
        ),
        array(
			'id' => 'footer_enable_subscribe',
			'type' => 'switcher',
			'title' => esc_html__('Display subscribe section on Footer', 'epcl_framework'),
			'desc' => esc_html__('You must enter a valid Mailchimp url to use this section.', 'epcl_framework'),
			'default' => false
        ),
        array(
			'id' => 'footer_subscribe_title',
			'type' => 'text',
			'title' => esc_html__('Title of subscribe section (Optional)', 'epcl_framework'),
            'desc' => esc_html__('e.g. Subscribe to Veen', 'epcl_framework'),
            'dependency' => array('footer_enable_subscribe', '==', '1'),
        ),
        array(
			'id' => 'footer_subscribe_description',
			'type' => 'text',
			'title' => esc_html__('Description of subscribe section (Optional)', 'epcl_framework'),
            'desc' => esc_html__('e.g. Get the latest posts delivered right to your email.', 'epcl_framework'),
            'dependency' => array('footer_enable_subscribe', '==', '1'),
        ),
        array(
			'id' => 'footer_subscribe_background_color',
			'type' => 'color',
			'title' => esc_html__('Background Color (optional)', 'epcl_framework'),
			'default' => $bg_color,
			'subtitle' =>  esc_html__('Default: '.$bg_color, 'epcl_framework'),
			// 'validate' => 'color',
			'transparent' => false
        ),
        array(
			'id' => 'footer_subscribe_background',
			'type' => 'media',
			'dependency' => array('footer_enable_subscribe', '==', '1'),
			'url' => true,
			'preview'=> true,
            'title' => esc_html__('Subscribe Background', 'epcl_framework'),
            'subtitle' =>  esc_html__('(Optional)', 'epcl_framework'),
			'desc' => esc_html__('Recommended sizes - width: 1920px, height: 150px.', 'epcl_framework'),
        ),
        array(
			'id' => 'footer_subscribe_parameters',
			'type' => 'code_editor',
            'title' => esc_html__('Extra Parameters', 'epcl_framework'),
            'subtitle' =>  esc_html__('(Optional)', 'epcl_framework'),
            'desc' => __('You can add Custom HTML like input fields, to send extra parameters to Mailchimp, example: <a href="https://prnt.sc/rshj91" target="_blank">https://prnt.sc/rshj91</a> <a href="https://prnt.sc/rshqv6" target="_blank">https://prnt.sc/rshqv6</a>', 'epcl_framework'),
            'dependency' => array('footer_enable_subscribe', '==', '1'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'htmlmixed',
                'tabSize' => 4
            ),
            'sanitize' => false
        ),
	)
) );
