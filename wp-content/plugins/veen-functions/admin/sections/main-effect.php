<?php


/* AMP Settings */

CSF::createSection( $opt_name, array(
    'id' => 'effect',
    'title' => esc_html__('Main Effect', 'epcl_framework'),
    'icon' => 'fa fa-paint-brush',
    'fields' => array(
        array(
			'id' => 'title_main_effect',
            'type' => 'subheading',
            'notice' => false,
            'title' => __('Important Information', 'epcl_framework'),
            'subtitle' => __( 'This section will help you to improve <b>typography rendering</b> when selecting <b>custom fonts</b>. If you are using the default font <b>"Josefin Sans"</b> for titles, you can skip this section.<br><br>If you have any problem like this: <a href="https://prnt.sc/s2kmu8" target="_blank">https://prnt.sc/s2kmu8</a> it is recommended to edit these options.', 'epcl_framework'),
		),
		array(
			'id' => 'main_effect_border_width',
			'type' => 'slider',
			'title' => esc_html__('Main title border width', 'epcl_framework'),
			'subtitle' => 'Default: 14 pixels.',
			'desc' => __('This will generate blank space on titles, e.g. <a href="https://prnt.sc/s2kk07" target="_blank">https://prnt.sc/s2kk07</a>', 'epcl_framework'),
			'default' => '14',
			'min' => '3',
			'step' => '1',
            'max' => '30',
            'unit' => 'px',
        ),
        array(
			'id' => 'main_effect_line_height',
			'type' => 'slider',
			'title' => esc_html__('Main title Line Height', 'epcl_framework'),
			'subtitle' => 'Default: 145%',
			'desc' => __('This will generate blank space between lines, e.g. <a href="https://prnt.sc/s2klre" target="_blank">https://prnt.sc/s2klre</a><br> A larger line height could fix cut off letters <a href="https://prnt.sc/s2kmu8" target="_blank">https://prnt.sc/s2kmu8</a>', 'epcl_framework'),
			'default' => '145',
			'min' => '100',
			'step' => '5',
            'max' => '200',
            'unit' => '%',
		),
    )
) );
