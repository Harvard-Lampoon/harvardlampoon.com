<?php

$is_floating = isset( $floating ) && 'yes' == $floating;
$position    = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switcher_position', 'right_bottom' );
$light_text  = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switch_text_light', 'Light' );
$dark_text   = wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'switch_text_dark', 'Dark' );

if ( 'on' != wp_dark_mode_get_settings( 'wp_dark_mode_switch', 'custom_switch_text', 'off' ) ) {
	$light_text = 'Light';
	$dark_text  = 'Dark';
}

?>

<div class="wp-dark-mode-switcher wp-dark-mode-ignore style-2  <?php echo !empty($class) ? $class : ''; ?> <?php echo $is_floating ? "floating $position" : ''; ?>">

    <label for="wp-dark-mode-switch wp-dark-mode-ignore">
        <div class="toggle wp-dark-mode-ignore"></div>
        <div class="modes wp-dark-mode-ignore">
            <p class="light"><?php echo $light_text; ?></p>
            <p class="dark"><?php echo $dark_text; ?></p>
        </div>
    </label>

</div>