<?php
/*
* Variable usages:
*
* EPCL_ABSPATH: template folder, includes files inside the theme
* EPCL_THEMEPATH: includes relative file by http prottocol (url)
* EPCL_THEMEPREFIX:  Used for metaboxes and theme options panel. Must be equal to text domain.
* EPCL_FRAMEWORK_VAR: Used to storage information into wp database global variable, eg: $epcl_theme['carousel_category'].
*
*/

if( !defined('EPCL_ABSPATH') ) define('EPCL_ABSPATH', get_template_directory() );
if( !defined('EPCL_THEMEPATH') ) define('EPCL_THEMEPATH', get_template_directory_uri() );
if( !defined('EPCL_THEMEPREFIX') ) define('EPCL_THEMEPREFIX', 'epcl');
if( !defined('EPCL_FRAMEWORK_VAR') ) define('EPCL_FRAMEWORK_VAR', 'epcl_theme');
if( !defined('EPCL_THEMENAME') ) define('EPCL_THEMENAME', 'Veen' );
if( !defined('EPCL_THEMESLUG') ) define('EPCL_THEMESLUG', 'veen' ); // Do not change
if( !defined('EPCL_APIKEY') ) define('EPCL_APIKEY', 'A081B273A16DABAA7341' ); // Do not change
if( !isset($content_width) ) $content_width = 668; // oembed width

/* Main class function for all Estudio Patagon themes, avoids plugins errors with a unique name  */

if( !class_exists('epcl_theme_setup') ) {

	class epcl_theme_setup {

		public function __construct() {

			/* Theme Includes */

			add_action('after_setup_theme', array( $this, 'includes' ), 4 );

			/* Main Theme Options */

			add_action('after_setup_theme', array( $this, 'theme_support') );

		}

		public function includes(){

			/* Main Includes */

			require_once(EPCL_ABSPATH.'/functions/import/import-demo.php');
			require_once( get_theme_file_path('functions/post-formats.php') );
            require_once(EPCL_ABSPATH.'/functions/enqueue-scripts.php');
            require_once(EPCL_ABSPATH.'/functions/color-helper.php');
			require_once(EPCL_ABSPATH.'/functions/custom-styles.php');
			require_once( get_theme_file_path('functions/theme-functions.php') ); // Specific functions for this particular theme
			require_once(EPCL_ABSPATH.'/functions/core.php'); // Common functions for all EP themes

			/* Plugins */

			require_once(EPCL_ABSPATH.'/functions/plugins/class-tgm-plugin-activation.php');
            require_once(EPCL_ABSPATH.'/functions/plugins/recommended-plugins.php');

            /* Theme Wizard */

            if (!is_customize_preview()  && is_admin() ) {
                require_once(EPCL_ABSPATH.'/functions/merlin/vendor/autoload.php');
                require_once(EPCL_ABSPATH.'/functions/merlin/class-merlin.php');
                require_once(EPCL_ABSPATH.'/functions/merlin/merlin-config.php');
                require_once(EPCL_ABSPATH.'/functions/merlin/merlin-import-demo.php');
            }   

		}

		public function theme_support(){

			/* Languages */

			load_theme_textdomain('veen', EPCL_ABSPATH.'/languages');

			/* Thumbs */

			if( function_exists('add_theme_support') ){
				add_theme_support('post-formats', array( 'video', 'gallery', 'audio' ) );
				add_theme_support('post-thumbnails');
				add_theme_support('automatic-feed-links');
				add_theme_support('html5');
                add_theme_support('title-tag');
                add_theme_support('editor-styles'); // Gutenberg Support      
                add_theme_support('align-wide');  
                add_theme_support('responsive-embeds');        
                add_theme_support('amp', array(
                    'paired' => true,
                    'template_dir' => 'amp',
                    'templates_supported' => array(
                        // 'is_search' => false,
                    ),
                ) );
                if( epcl_get_option('enable_gutenberg_admin', true) ){
                    add_editor_style( epcl_gutenberg_fonts_url() ); // Enqueue fonts in the gutenberg editor               
                    add_editor_style( 'assets/dist/gutenberg.min.css' ); // Enqueue custom styles in the Gutenberg editor
                }


				$prefix = EPCL_THEMEPREFIX.'_';

				add_image_size($prefix.'admin_thumb', 100, 100, false);

				add_image_size($prefix.'classic_post', 950, 500, true);

				add_image_size($prefix.'single_standard', 1200, 500, true); // Fullcover or without sidebar post
				add_image_size($prefix.'single_related', 600, 550, true);
				add_image_size($prefix.'single_content', 700, 450, false);

                add_image_size($prefix.'page_header', 1950, 600, true);
                add_image_size($prefix.'slider', 1600, 450, true);

				add_image_size($prefix.'widget_thumb', 120, 120, true); // Required on widgets

				add_image_size($prefix.'large', 1600, 1200, false); // Required on portfolio lightbox

			}

			/* Menus */

			register_nav_menus(array(
                'epcl_header' => esc_html__('Header', 'veen')
			));

			/* Register Sidebars */

			require_once( get_theme_file_path('functions/sidebars.php') );

        }       

	}

	new epcl_theme_setup;
}