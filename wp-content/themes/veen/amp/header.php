<?php $epcl_theme = epcl_get_theme_options(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <?php if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ): ?>
        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
    <?php endif; ?>

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
    <?php if( epcl_get_option('amp_auto_ads_enabled') && epcl_get_option('amp_auto_ads_client') ): ?>
        <amp-auto-ads type="adsense" data-ad-client="<?php echo epcl_get_option('amp_auto_ads_client'); ?>">
        </amp-auto-ads>
    <?php endif; ?>

    <?php if( epcl_get_option('amp_custom_code', false) ): ?>
        <?php echo epcl_get_option('amp_custom_code'); ?>
    <?php endif; ?>

    <!-- start: #wrapper -->
    <div id="wrapper">
		<?php get_template_part('amp/partials/header'); ?>
