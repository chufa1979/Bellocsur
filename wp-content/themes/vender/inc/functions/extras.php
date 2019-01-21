<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package vender
 */

/**
 * Check whether the Storefront Customizer settings ar enabled
 * @return boolean
 * @since  1.1.2
 */
function is_vender_customizer_enabled() {
	return apply_filters( 'vender_customizer_enabled', true );
}

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'vender_is_woocommerce_activated' ) ) {
	function vender_is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

/*
 * Removing this class because custom layout breaks
 *
*/
function vender_remove_a_body_class($wp_classes) {

	foreach($wp_classes as $key => $value) {
	if ($value == 'storefront-full-width-content') unset($wp_classes[$key]);
	}

	return $wp_classes;

}

/* social icons*/
function vender_social_icons()  { 

	$social_networks = array( array( 'name' => __('Facebook','vender'), 'theme_mode' => 'vender_facebook','icon' => 'fa-facebook' ),
	array( 'name' => __('Twitter','vender'), 'theme_mode' => 'vender_twitter','icon' => 'fa-twitter' ),
	array( 'name' => __('Google+','vender'), 'theme_mode' => 'vender_google','icon' => 'fa-google-plus' ),
	array( 'name' => __('Pinterest','vender'), 'theme_mode' => 'vender_pinterest','icon' => 'fa-pinterest' ),
	array( 'name' => __('Linkedin','vender'), 'theme_mode' => 'vender_linkedin','icon' => 'fa-linkedin' ),
	array( 'name' => __('Youtube','vender'), 'theme_mode' => 'vender_youtube','icon' => 'fa-youtube' ),
	array( 'name' => __('Tumblr','vender'), 'theme_mode' => 'vender_tumblr','icon' => 'fa-tumblr' ),
	array( 'name' => __('Instagram','vender'), 'theme_mode' => 'vender_instagram','icon' => 'fa-instagram' ),
	array( 'name' => __('Flickr','vender'), 'theme_mode' => 'vender_flickr','icon' => 'fa-flickr' ),
	array( 'name' => __('Vimeo','vender'), 'theme_mode' => 'vender_vimeo','icon' => 'fa-vimeo-square' ),
	array( 'name' => __('RSS','vender'), 'theme_mode' => 'vender_rss','icon' => 'fa-rss' )
	);


	for ($row = 0; $row < 11; $row++){
		if (get_theme_mod( $social_networks[$row]["theme_mode"])): ?>
			<a href="<?php echo esc_url( get_theme_mod($social_networks[$row]['theme_mode']) ); ?>" class="social-tw" title="<?php echo esc_url( get_theme_mod( $social_networks[$row]['theme_mode'] ) ); ?>" aria-label="<?php echo $social_networks[$row]['name']; ?>" >
			<span class="fa <?php echo $social_networks[$row]['icon']; ?>" aria-hidden="true"></span> 
			</a>
		<?php endif;
	}
										
}

function vender_check_number( $value ) {
		$value = (int) $value; // Force the value into integer type.
		return ( 0 < $value ) ? $value : null;
}
