<?php
$epcl_module = epcl_get_module_options();
if( empty($epcl_module) ) return;

if( function_exists( 'epcl_render_ads' ) ){
    epcl_render_ads();
}
?>