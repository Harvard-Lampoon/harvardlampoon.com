<?php 
$epcl_theme = epcl_get_theme_options();
$post_id = get_the_ID();
$post_format = get_post_format();
?>
<div class="fullcover-wrapper">
    <?php echo epcl_display_post_format( $post_format, $post_id ); ?>
</div>