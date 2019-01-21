<?php
/**
 * Vender WooCommerce hooks
 *
 * @package vender
 */


/**
 * Header
 * @see  storefront_header_cart()
 */
add_action( 'vender_header_nav', 'storefront_header_cart', 		60 );


add_action( 'vender_breadcrumb', 				'woocommerce_breadcrumb', 					10 );
add_action( 'vender_shop_messages', 			'storefront_shop_messages', 				10 );