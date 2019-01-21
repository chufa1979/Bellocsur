<?php
/**
 * vender hooks
 *
 * @package vender
 */

add_action( 'widgets_init', 'vender_remove_widgets', 11 );
/**
 * General
 * @see  storefront_scripts()
 */

add_action( 'after_setup_theme',			'vender_theme_setup' );
add_action( 'wp_enqueue_scripts',			'vender_scripts');
add_action(	'wp_print_styles', 				'vender_google_fonts');

/**
 * Header
 * @see  storefront_skip_links()
 * @see  storefront_secondary_navigation()
 * @see  storefront_site_branding()
 * @see  storefront_primary_navigation()
 */

add_action( 'vender_header_top', 'vender_secondary_navigation',		10 );
add_action( 'vender_header_top', 'vender_social_media_links',		15 );


add_action( 'vender_skip_links', 'storefront_skip_links', 		0 );
add_action( 'vender_header_logo', 'vender_site_branding',			20 );

add_action( 'vender_main_nav', 'storefront_primary_navigation',	50 );
add_action( 'vender_header_nav', 'vender_product_search',	50 );

add_action( 'vender_slider', 'vender_featured_slider',	60 );

add_action( 'vender_title', 'vender_inner_title',	10 );

/**
 * Homepage
 * @see  storefront_homepage_content()
 * @see  storefront_product_categories()
 * @see  storefront_recent_products()
 * @see  storefront_featured_products()
 * @see  storefront_popular_products()
 * @see  storefront_on_sale_products()
 */
add_action( 'vender_homepage', 'storefront_homepage_content',		10 );
add_action( 'vender_homepage', 'storefront_product_categories',	20 );
add_action( 'vender_homepage', 'storefront_recent_products',		30 );
add_action( 'vender_homepage', 'storefront_featured_products',	40 );
add_action( 'vender_homepage', 'storefront_popular_products',		50 );
add_action( 'vender_homepage', 'storefront_on_sale_products',		60 );

/**
 * Posts
 * @see  storefront_post_meta()
 * @see  storefront_post_content()
 */
add_action( 'vender_single_post',		'storefront_post_content',		20 );

add_action( 'vender_blog_index_thumb',	'vender_post_thumb',				10 );
add_action( 'vender_blog_index_header',	'vender_post_header',				10 );
add_action( 'vender_blog_index_content',	'vender_post_content',			10 );

add_action( 'vender_blog_post_content',	'vender_post_meta',			10 );

/**
 * Pages
 * @see  storefront_page_content()
 */
add_action( 'vender_page', 			'storefront_page_content',		10 );

/**
 * Footer
 * @see  storefront_footer_widgets()
 * @see  storefront_credit()
 */
add_action( 'vender_footer_widgets', 'storefront_footer_widgets',	10 );
add_action( 'vender_credit_area', 'vender_credit',			20 );


/**
 * body class
 * @see  vender_remove_a_body_class()
 */

add_filter('body_class', 'vender_remove_a_body_class', 20, 2);