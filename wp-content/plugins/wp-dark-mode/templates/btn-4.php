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

<div class="wp-dark-mode-switcher wp-dark-mode-ignore  style-4  <?php echo $class; ?> <?php echo $is_floating ? "floating $position" : ''; ?>">

    <p class="wp-dark-mode-ignore"><?php echo $light_text; ?></p>

    <label for="wp-dark-mode-switch wp-dark-mode-ignore">
        <div class="modes wp-dark-mode-ignore">
            <img class="light" src="<?php echo WP_DARK_MODE_ASSETS.'/images/btn-4/sun.png'; ?>" alt="Light">
            <img class="dark" src="<?php echo WP_DARK_MODE_ASSETS.'/images/btn-4/moon.png'; ?>" alt="Dark">
        </div>
    </label>

    <p class="wp-dark-mode-ignore"><?php echo $dark_text; ?></p>

</div>