<?php
/*
* Common functionalities for all EP themes (static functions).
* These functions add or extends WordPress functiontionalities.
*
*/

if ( ! class_exists( 'epcl_static_functions' ) ) {

	class epcl_static_functions {

		public function __construct() {

            /* Body Classes */
            
            add_filter( 'body_class', array( $this, 'custom_body_classes'), 5 );

			/* Front-End: Custom Excerpt */

			add_filter('excerpt_more', array( $this, 'new_excerpt_more'));
            add_filter('excerpt_length', array( $this, 'custom_excerpt_length'), 999);

            /* Update notice */
            
            add_action( 'admin_notices', array($this, 'epcl_core_plugin_notice'), 999 );

        }
        
        public function custom_body_classes( $classes ) {
            $epcl_theme = epcl_get_theme_options();
            
            if( empty($epcl_theme) ) return $classes;

            if( isset($_GET['bg']) ){
                $epcl_theme['background_type'] = 3;
            }

            if($epcl_theme['background_type'] == 1 && isset($epcl_theme['bg_body_pattern']['url']) && $epcl_theme['bg_body_pattern']['url']) $classes[] = ' pattern bg-image';
            if($epcl_theme['background_type'] == 3 && isset($epcl_theme['bg_body_full']['url']) && $epcl_theme['bg_body_full']['url']) $classes[] = ' cover bg-image';
            
            // Lazy Load for adsense
            if( isset($epcl_theme['enable_lazyload_adsense']) && $epcl_theme['enable_lazyload_adsense'] === '1' ) $classes[] = ' enable-lazy-adsense';
              
            // Theme Optimization enabled
            if( isset($epcl_theme['enable_optimization']) && $epcl_theme['enable_optimization'] === '1' ) $classes[] = ' enable-optimization';
            
            return $classes;
        }

		/* Replace [...] excerpt with a new one */

		public function new_excerpt_more($more){
			return '...';
		}

		/* Change excerpt length */

		public function custom_excerpt_length($length){
			return 25;
        }
        
        public function epcl_core_plugin_notice() {
            global $pagenow;
            if( in_array($pagenow, array('post.php', 'post-new.php')) ){
                return;
            }
            if( !defined('EPCL_PLUGIN_PATH') || !current_user_can( 'install_plugins' ) ){
                return;
            }
            $theme = wp_get_theme( EPCL_THEMESLUG );
            $ver = $theme->version;
            $plugin_data = get_plugin_data( EPCL_PLUGIN_PATH.'/'.EPCL_THEMESLUG.'-functions.php' );
            $plugin_version = $plugin_data['Version'];
            // If theme version is lower than plugin, just ignore
            if( version_compare($ver, $plugin_version, '<=') ){
                return;
            }
            ?>
            <div class="update-nag notice notice-warning inline" style="display: table;">
                Update <b> <?php echo EPCL_THEMENAME; ?> Functions Plugin to (v<?php echo esc_attr($ver); ?>)</b> to ensure maximum compatibility.
                <span>
                    <a href="<?php echo admin_url('themes.php?page=install-required-plugins&plugin_status=update'); ?>">Please update now</a>.
                </span>
                <div style="margin-top: 0.5em;"><b>Note:</b> If you can't update the plugin, <b>just remove</b> and <b>re-install</b> from <b>Appearance &rarr; Install plugins.</b></div>
            </div>
            <div class="clear"></div>
            <?php
        }

	}

	new epcl_static_functions();
}

