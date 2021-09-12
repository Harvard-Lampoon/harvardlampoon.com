<?php 
$post_id = get_the_ID();
$post_format = get_post_format();
?>
<header>

    <?php echo epcl_display_post_format( $post_format, $post_id ); ?>

	<div class="clear"></div>

</header>