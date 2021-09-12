<?php

$prefix = EPCL_THEMEPREFIX.'_';
$prefix_key = 'epcl_user_';

$page_key = 'epcl_user';

// Create profile options
CSF::createProfileOptions( $page_key );

CSF::createSection( $page_key, array(
    'title'  => esc_html__('(EP) Custom Fields'),
    'icon'   => 'fa fa-rocket',
    'fields' => array(
        array (
			'id' => 'facebook',
			'title' => esc_html__('Facebook URL', 'epcl_framework'),
			'desc' => esc_html__('e.g. http://www.facebook.com/estudiopatagon', 'epcl_framework'),
			'type' => 'text',
		),
		array (
			'id' => 'twitter',
			'title' => esc_html__('Twitter URL', 'epcl_framework'),
			'desc' => esc_html__('e.g: https://twitter.com/wordpress', 'epcl_framework'),
			'type' => 'text',
        ),
        array (
			'id' => 'position',
			'title' => esc_html__('Position (tagline)', 'epcl_framework'),
			'desc' => esc_html__('e.g: Founder & Editor', 'epcl_framework'),
			'type' => 'text',
        ),
        array (
            'id' => 'avatar',
            'title' => esc_html__('Optimized Avatar', 'epcl_framework'),
            'desc' => esc_html__('Recommended size: 150x150. This step is totally optional, it\'s just boost a little the web speed rendering the image directly from your hosting, instead of gravatar.', 'epcl_framework'),
            'type' => 'media',                    
            'url' => false,
            'preview'=> true,
        ),
    )
) );
