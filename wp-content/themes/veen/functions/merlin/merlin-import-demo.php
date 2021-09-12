<?php
/**
 * Available filters for extending Merlin WP.
 *
 * @package   Merlin WP
 * @version   @@pkg.version
 * @link      https://merlinwp.com/
 * @author    Rich Tabor, from ThemeBeans.com & the team at ProteusThemes.com
 * @copyright Copyright (c) 2018, Merlin WP of Inventionn LLC
 * @license   Licensed GPLv3 for Open Source Use
 */

/**
 * Add your widget area to unset the default widgets from.
 * If your theme's first widget area is "sidebar-1", you don't need this.
 *
 * @see https://stackoverflow.com/questions/11757461/how-to-populate-widgets-on-sidebar-on-theme-activation
 *
 * @param  array $widget_areas Arguments for the sidebars_widgets widget areas.
 * @return array of arguments to update the sidebars_widgets option.
 */
function prefix_merlin_unset_default_widgets_args( $widget_areas ) {

    // Unset any widget on our custom sidebars
	$widget_areas = array(
        'epcl_sidebar_default' => array(),
        'epcl_sidebar_home' => array(),
        'epcl_sidebar_footer' => array(),
	);

	return $widget_areas;
}
add_filter( 'merlin_unset_default_widgets_args', 'prefix_merlin_unset_default_widgets_args' );

/**
 * Define the demo import files (local files).
 *
 * You have to use the same filter as in above example,
 * but with a slightly different array keys: local_*.
 * The values have to be absolute paths (not URLs) to your import files.
 * To use local import files, that reside in your theme folder,
 * please use the below code.
 * Note: make sure your import files are readable!
 */
function prefix_merlin_local_import_files() {
	return array(
        array(
			'import_file_name'             => 'Import Demo',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'functions/import/demo-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'functions/import/widgets.wie',
            'local_import_csf'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'functions/import/csf-options.json',
                    'option_name' => 'epcl_theme',
                ),
            ),
			'import_preview_image_url'     => get_template_directory_uri().'/screenshot.jpg',
			'import_notice'                => 'Before install Demo config, it is recommended to install our 2 required plugins (ACF and '.EPCL_THEMENAME.' Functions)',            
			'preview_url'                  => 'http://estudiopatagon.com/themes/wordpress/'.EPCL_THEMESLUG,
		),
	);
}
add_filter( 'merlin_import_files', 'prefix_merlin_local_import_files' );

/**
 * Execute custom code after the whole import has finished.
 */
function prefix_merlin_after_import_setup() {
	// Assign menus to their locations.
    $header_menu = get_term_by( 'name', 'Header', 'nav_menu' );

	set_theme_mod(
		'nav_menu_locations', array(
            'epcl_header' => $header_menu->term_id
		)
	);

}
add_action( 'merlin_after_all_import', 'prefix_merlin_after_import_setup' );
