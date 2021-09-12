<?php
$epcl_module = epcl_get_module_options();
if( empty($epcl_module) ) return;
$module_class = '';
?>
<div class="epcl-text-editor section grid-container module-wrapper" id="<?php echo wp_unique_id('epcl-text-editor-'); ?>">
    <!-- start: .content-wrapper -->
    <div class="content-wrapper <?php echo esc_attr($module_class); ?>">
        <!-- start: .center -->
        <div class="center">
            <div class="text">
                <?php echo wpautop( wp_kses_post( do_shortcode($epcl_module['text_editor_content']) ) ); ?>
            </div>
        </div>
        <!-- end: .center -->
    </div>
    <!-- end: .content-wrapper -->
</div>