<?php
$page_key = 'epcl_home';
$prefix_key = 'epcl_';

CSF::createMetabox( $page_key, array(
    'title'          => 'Home Builder',
    'post_type'      => 'page',
    'page_templates' => 'page-templates/home.php', // Spesific page templates
    // 'context'   => 'normal',
  ) );
  
CSF::createSection( $page_key, array(
    'title'  => 'Modules creator',
    'icon'   => 'fa fa-rocket',
    'fields' => array(
        array(
            'id' => 'modules',
            'type' => 'group',
            'button_title' => esc_html__('Add Row', 'epcl_framework'),
            'title' => esc_html__('Modules *', 'epcl_framework'),
            'subtitle' => __('Add different kinds of layouts.<br><small><b>Important:</b> Only 1 Post List per Page.</small>', 'epcl_framework'),
            // 'accordion_title_number' => true,
            'fields' => array(
                array(
                    'id'         => 'module_name',
                    'type'       => 'text',
                    'title'      => 'Module',
                    // 'default'    => 'Grid Posts',
                    // 'value' => 'Grid Posts',
                    // 'attributes' => array(
                    //     'type' => 'hidden',
                    //     'required' => 'required'
                    // ),
                ),
                array(
                    'id'    => 'layout',
                    'type'  => 'radio',
                    'title' => esc_attr__('Select Layout:', 'epcl_framework'),
                    'inline' => true,
                    'placeholder' => 'Select an option',
                    'validate' => 'csf_validate_required',
                    'options' => array(
                        'Post Lists' => array(
                            'grid_posts' => esc_html__('Grid Posts', 'epcl_framework'),
                            'grid_sidebar' => esc_html__('Grid Posts with Sidebar', 'epcl_framework'),
                            'classic_posts' => esc_html__('Classic Posts', 'epcl_framework'),
                            'classic_posts_sidebar' => esc_html__('Classic with Sidebar', 'epcl_framework'),
                        ),
                        'Slider / Carousel' => array(
                            'posts_slider' => esc_html__('Posts Slider', 'epcl_framework'),
                            'posts_carousel' => esc_html__('Posts Carousel', 'epcl_framework'),
                            'categories_carousel' => esc_html__('Categories Carousel', 'epcl_framework'),
                        ),
                        'Others' => array(
                            'advertising' => esc_html__('Advertising', 'epcl_framework'),
                            'text_editor' => esc_html__('Text Editor', 'epcl_framework'),
                        ),                                               
                    ),
                    // 'default' => 'module_grid_posts'
                ),
                // Categories Carousel Only
                array (
                    'id' => 'cat_carousel_title',
                    'title' => esc_html__('Title (optional)', 'epcl_framework'),
                    'type' => 'text',
                    'default' => '',
                    'dependency' => array('layout', '==', 'categories_carousel'),
                ),
                // ALl Posts Lists
                array (
                    'id' => 'orderby',
                    'title' => esc_html__('Order by (optional)', 'epcl_framework'),
                    'subtitle' => esc_html__('Default: By Date', 'epcl_framework'),
                    'type' => 'select',
                    'options' => array(
                        'date' => esc_html__('By Date (recent posts)', 'epcl_framework'),
                        'views' => esc_html__('By Post Views (popular posts)', 'epcl_framework'),
                        'title' => esc_html__('By Name', 'epcl_framework'),
                    ),
                    'default' => 'date',
                    'dependency' => array('layout', 'any', 'grid_posts,grid_sidebar,classic_posts,classic_posts_sidebar,posts_carousel'),   
                ),
                array (
                    'id' => 'date',
                    'title' => esc_html__('Date (optional)', 'epcl_framework'),
                    'subtitle' => esc_html__('Default: All Time', 'epcl_framework'),
                    'desc' => esc_html__('Combine with order by Post Views to get your popular posts.', 'epcl_framework'),
                    'type' => 'select',
                    'options' => array(
                        'alltime' => esc_html__('All Time', 'epcl_framework'),
                        'pastyear' => esc_html__('Past Year', 'epcl_framework'),
                        'pastmonth' => esc_html__('Past Month', 'epcl_framework'),
                        'pastweek' => esc_html__('Past Week', 'epcl_framework'),
                    ),
                    'default' => 'alltime',
                    'dependency' => array('layout', 'any', 'grid_posts,grid_sidebar,classic_posts,classic_posts_sidebar,posts_carousel'),
                ),
                array (
                    'id' => 'posts_order',
                    'title' => esc_html__('Order (optional)', 'epcl_framework'),
                    'subtitle' => esc_html__('Default: DESC', 'epcl_framework'),
                    'instructions' => esc_html__('Default descending (highest to lowest value).', 'epcl_framework'),
                    'type' => 'select',
                    'options' => array(
                        'ASC' => esc_html__('ASC (ascending)', 'epcl_framework'),
                        'DESC' => esc_html__('DESC (descending)', 'epcl_framework'),
                    ),
                    'default' => 'DESC',
                    'dependency' => array('layout', 'any', 'grid_posts,grid_sidebar,classic_posts,classic_posts_sidebar,posts_carousel'), 
                ),
                array(
                    'id' => 'featured_categories',
                    'title' => esc_html__('Featured Categories', 'epcl_framework'),                    
                    'desc' => esc_html__('(Optional) select only post from these categories or leave blank to display all posts.', 'epcl_framework'),
                    'type' => 'select',
                    'chosen' => true,
                    'multiple' => true,
                    'sortable' => true,
                    'options' => 'categories',
                    'default' => '',
                    'dependency' => array('layout', 'any', 'grid_posts,grid_sidebar,classic_posts,classic_posts_sidebar,posts_slider,posts_carousel,categories_carousel'), 
                ),
                array(
                    'id' => 'excluded_categories',
                    'title' => esc_html__('Excluded Categories', 'epcl_framework'),
                    'type' => 'select',
                    'desc' => esc_html__('(Optional) Usefull if you dont want to display posts used on the carousel.', 'epcl_framework'),
                    'chosen' => true,
                    'multiple' => true,
                    'sortable' => true,
                    'options' => 'categories',
                    'dependency' => array('layout', 'any', 'grid_posts,grid_sidebar,classic_posts,classic_posts_sidebar,categories_carousel'), 
                ),
                array(
                    'id' => 'grid_posts_column',
                    'title' => esc_html__('Number of Columns', 'epcl_framework'),
                    'subtitle' => esc_html__('Default: 3', 'epcl_framework'),
                    'type' => 'spinner',
                    'instructions' => esc_html__('2 to 4 columns', 'epcl_framework'),
                    'default' => '3',
                    'min' => '2',
                    'step' => '1',
                    'max' => '4',
                    'dependency' => array('layout', '==', 'grid_posts'),
                ),
                array(
                    'id' => 'posts_per_page',
                    'title' => esc_html__('Posts per page', 'epcl_framework'),
                    'type' => 'spinner',
                    'desc' => esc_html__('(Optional) by default is used the amount from Settings -> Reading option.', 'epcl_framework'),
                    'min' => '2',
                    'max' => '30',
                    'step' => '1',
                    'default' => '',
                    'dependency' => array('layout', 'any', 'grid_posts,grid_sidebar,classic_posts,classic_posts_sidebar'), 
                    // 'unit' => 'articles'
                ),
                // With Sidebar
                array (
                    'id' => 'sidebar',
                    'title' => esc_html__('Sidebar (optional)', 'epcl_framework'),
                    'subtitle' => esc_html__('Default: Home Sidebar', 'epcl_framework'),
                    'desc' => esc_html__('Use a different sidebar for this module.', 'epcl_framework'),       
                    'type' => 'select',             
                    'chosen' => false,
                    'options' => 'sidebars',
                    'default' => 'epcl_sidebar_home',
                    'dependency' => array('layout', 'any', 'grid_sidebar,classic_posts_sidebar'),          
                ),
                // Slider
                array(
                    'id' => 'posts_slider_limit',
                    'title' => esc_html__('Posts Limit', 'epcl_framework'),                    
                    'desc' => esc_html__('Max number of posts to retrieve.', 'epcl_framework'),
                    'type' => 'spinner',
                    'min' => '1',
                    'max' => '30',
                    'step' => '1',
                    'default' => '6',
                    'dependency' => array('layout', '==', 'posts_slider'),
                ),
                array (
                    'id' => 'enable_author',
                    'title' => esc_html__('Enable author', 'epcl_framework'),
                    'type' => 'switcher',
                    'default' => true,
                    'dependency' => array('layout', '==', 'posts_slider'),
                ),
                array (
                    'id' => 'enable_autoplay',
                    'title' => esc_html__('Enable Autoplay', 'epcl_framework'),
                    'type' => 'switcher',
                    'default' => false,
                    'dependency' => array('layout', '==', 'posts_slider'),
                ),
                array (
                    'id' => 'autoplay_time',
                    'title' => esc_html__('Autoplay Time', 'epcl_framework'),
                    'subtitle' => esc_html__('In miliseconds, 3000 = 3 secs', 'epcl_framework'),
                    'type' => 'spinner',
                    'min' => '1000',
                    'max' => '10000',
                    'step' => '100',
                    'default' => '3000',
                    'dependency' => array('layout', '==', 'posts_slider'),
                ),
                // Posts Carousel
                array(
                    'id' => 'posts_carousel_limit',
                    'title' => esc_html__('Posts Limit', 'epcl_framework'),                    
                    'desc' => esc_html__('Max number of posts to retrieve.', 'epcl_framework'),
                    'type' => 'spinner',
                    'min' => '3',
                    'max' => '30',
                    'step' => '1',
                    'default' => '12',
                    'dependency' => array('layout', '==', 'posts_carousel'),
                ),
                array(
                    'id' => 'posts_carousel_show_limit',
                    'title' => esc_html__('Visible Items', 'epcl_framework'),                    
                    'desc' => esc_html__('Number of visible elements, recommended: 4', 'epcl_framework'),
                    'type' => 'spinner',
					'min' => '2',
                    'max' => '6',
                    'step' => '1',
                    'default' => '4',
                    'dependency' => array('layout', '==', 'posts_carousel'),
                ),
                array (
                    'id' => 'posts_carousel_enable_author',
                    'title' => esc_html__('Enable author & date', 'epcl_framework'),
                    'type' => 'switcher',
                    'default' => false,
                    'dependency' => array('layout', '==', 'posts_carousel'),
                ),
                // Categories Carousel
                array(
                    'id' => 'categories_carousel_limit',
                    'title' => esc_html__('Categories Limit', 'epcl_framework'),                    
                    'desc' => esc_html__('Max number of categories to retrieve.', 'epcl_framework'),
                    'type' => 'spinner',
                    'min' => '1',
                    'max' => '50',
                    'step' => '1',
                    'default' => '9',
                    'dependency' => array('layout', '==', 'categories_carousel'),
                ),
                array(
                    'id' => 'categories_carousel_show_limit',
                    'title' => esc_html__('Visible Items', 'epcl_framework'),                    
                    'desc' => esc_html__('Number of visible elements, recommended: 5', 'epcl_framework'),
                    'type' => 'spinner',
					'min' => '2',
                    'max' => '30',
                    'step' => '1',
                    'default' => '5',
                    'dependency' => array('layout', '==', 'categories_carousel'),
                ),
                // Advertising
                array(
                    'id' => 'advertising_type',
                    'type' => 'button_set',
                    'title' => esc_html__('Advertising Type', 'epcl_framework'),
                    'options'  => array(
                        'image' => esc_html__('Image', 'epcl_framework'),
                        'code' => esc_html__('External Code', 'epcl_framework'),             
                    ),
                    'default' => 'image',
                    'dependency' => array('layout', '==', 'advertising'),
                ),
                array(
                    'id' => 'advertising_image',
                    'title' => esc_html__('Image', 'epcl_framework'),
                    'desc' => esc_html__('Recommended size: 728x90', 'epcl_framework'),
                    'type' => 'media',                    
                    'url' => true,
                    'preview'=> true,
                    'dependency' => array(
                        array('layout', '==', 'advertising'),
                        array('advertising_type', '==', 'image')
                    )
                ),
                array (
                    'id' => 'advertising_url',
                    'title' => esc_html__('URL', 'epcl_framework'),
                    'desc' => esc_html__('Where the user will be redirected on click.', 'epcl_framework'),
                    'type' => 'text', 
                    'validate' => 'csf_validate_url',                   
                    'dependency' => array(
                        array('layout', '==', 'advertising'),
                        array('advertising_type', '==', 'image')
                    )
                ),
                array(                  
                    'id' => 'advertising_code',
                    'title' => esc_html__('Advertising Code', 'epcl_framework'),
                    'desc' => esc_html__('Add custom code for your banner for example Google Adsense <script>', 'epcl_framework'),
                    'type' => 'code_editor',
                    'settings' => array(
                        'theme'  => 'dracula',
                        'mode'   => 'htmlmixed',
                        'tabSize' => 4
                    ),
                    'dependency' => array(
                        array('layout', '==', 'advertising'),
                        array('advertising_type', '==', 'code')
                    )
                ),
                // Text Editor
                array(
                    'id' => 'text_editor_content',
                    'title' => esc_html__('Add your description', 'epcl_framework'),
                    'subtitle' => esc_html__('Shortcodes are allowed', 'epcl_framework'),
                    'desc' => '',
                    'type' => 'wp_editor',                    
                    'media_buttons' => true,
                    'dependency' => array('layout', '==', 'text_editor'),
                ),
            ),
        ),
    )
) );
