<?php

$prefix = EPCL_THEMEPREFIX.'_';
$prefix_key = 'epcl_post_categories_';

$page_key = 'epcl_post_categories';

CSF::createTaxonomyOptions( $page_key, array(
    'title' => 'General Information',
    'taxonomy' => 'category',
) );

CSF::createSection( $page_key, array(
    // 'title'  => 'Modules creator',
    // 'icon'   => 'fa fa-rocket',
    'fields' => array(
        array(
			'id' => 'main_color',
			'type' => 'color',
			'title' => esc_html__('Category Main Color', 'epcl_framework'),
			'desc' => esc_html__('(Optional) add a custom color for tag cloud widget.', 'epcl_framework'),
			'default' => $primary_color,
			// 'validate' => 'color',
			'transparent' => false
        ),
        array (
			'id' => 'archives_image',
            'title' => esc_html__("Carousel Image", 'epcl_framework'),
			'desc' => __('Recommended: you can set an image for this particular category.', 'epcl_framework'),
            'type' => 'media',                    
            'url' => false,
            'preview'=> true,
            'button_title' => 'Upload Image'
        ),
    )
) );
