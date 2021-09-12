<?php

function ocdi_import_files() {
    return array(
        array(
            'import_file_name'             => 'Import Veen Demo',
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'functions/import/demo-content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'functions/import/widgets.wie',
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'functions/import/redux-options.json',
                    'option_name' => 'epcl_theme',
                ),
            ),
            'import_preview_image_url'     => get_template_directory_uri().'/screenshot.jpg',
            'preview_url'                  => 'http://estudiopatagon.com/themes/wordpress/veen/',
        ),

    );
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );

?>