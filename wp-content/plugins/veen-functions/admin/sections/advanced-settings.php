<?php

/* Unique options for every EP theme */

$opt_name = EPCL_FRAMEWORK_VAR;

CSF::createSection( $opt_name, array(
    'title'       => esc_html__('Advanced Settings', 'epcl_framework'),
    'icon'        => 'fa fa-cogs',
    'description' => __('Remember to backup your Theme Options before <b>Update the Theme.</b>', 'epcl_framework'),
    'fields'      => array(
        array(
			'id' => 'enable_gutenberg_admin',
			'type' => 'switcher',
			'title' => esc_html__('Enable Gutenberg Custom Styles', 'epcl_framework'),
			'desc' => esc_html__('By default the Gutenberg editor will display same background and styles from the front-end, you can disable them if you want to show the Gutenberg default styles.', 'epcl_framework'),
			'default' => 1
		),
        array(
			'id' => 'enable_open_graph',
			'type' => 'switcher',
			'title' => esc_html__('Enable Open Graph', 'epcl_framework'),
			'desc' => esc_html__('Enable Open Graph basic support, if you are using Yoast SEO, it is recommended to disable this option.', 'epcl_framework'),
			'default' => 1
		),
		array(
			'id' => 'css_code',
			'type' => 'code_editor',
			'title' => esc_html__('Custom CSS Code', 'epcl_framework'),
			'desc' => esc_html__('e.g. #header{ background: #000; } Dont use &lt;style&gt; tags', 'epcl_framework'),
			'subtitle' => esc_html__('Paste your CSS code here.', 'epcl_framework'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'css',
                'tabSize' => 4
            ),
            'sanitize' => false
        ),
        array(
			'id' => 'custom_scripts',
			'type' => 'code_editor',
			'title' => esc_html__('Custom Scripts Below <head>', 'epcl_framework'),
            'desc' => esc_html__('Here you can paste your Google Analytics code (not your id) or Adsense code. If you dont have it or you are already using one, just leave blank.', 'epcl_framework'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'htmlmixed',
                'tabSize' => 4
            ),
            'sanitize' => false
        ),
        array(
			'id' => 'custom_scripts_footer',
			'type' => 'code_editor',
			'title' => esc_html__('Custom Scripts on Footer before closing </body>', 'epcl_framework'),
            'desc' => esc_html__('Here you can paste your any custom script that will be included on Footer with less priority.', 'epcl_framework'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'htmlmixed',
                'tabSize' => 4
            ),
            'sanitize' => false
        ),
    )
) );
