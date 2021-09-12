<?php

/* Unique options for every EP theme */

$opt_name = EPCL_FRAMEWORK_VAR;

CSF::createSection( $opt_name, array(
    'title'       => 'Backup',
    'icon'        => 'fa fa-cloud-download',
    'description' => __('Remember to backup your Theme Options&nbsp;<b>before update the theme.</b>', 'epcl_framework'),
    'fields'      => array(
        array(
            'type' => 'backup',
        ),  
    )
) );

