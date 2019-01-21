<?php
/**
 * vender engine room
 *
 * @package vender
 */


/*
 * Structure.
 * Template functions used throughout the theme.
 */
require get_stylesheet_directory() . '/inc/structure/hooks.php';
require get_stylesheet_directory() . '/inc/structure/header.php';
require get_stylesheet_directory() . '/inc/structure/post.php';
require get_stylesheet_directory() . '/inc/structure/template-tags.php';
require get_stylesheet_directory() . '/inc/structure/footer.php';

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_stylesheet_directory() . '/inc/tgm/class-tgm-plugin-activation.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_stylesheet_directory() . '/inc/functions/extras.php';
require get_stylesheet_directory() . '/inc/functions/vender-setup.php';

/**
 * Customizer additions.
 */
if ( is_vender_customizer_enabled() ) {
	require get_stylesheet_directory() . '/inc/customizer/vender-customizer.php';
}

/**
 * Load WooCommerce compatibility files.
 */
if ( vender_is_woocommerce_activated() ) {
	require get_stylesheet_directory() . '/inc/woocommerce/hooks.php';
}
