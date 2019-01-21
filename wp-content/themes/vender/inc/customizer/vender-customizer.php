<?php
/**
 * Vender Customizer Class
 *
 * @author   WooThemes
 * @package  storefront
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vender_Customizer' ) ) :

	/**
	 * The Vender Customizer class
	 */
	class Vender_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'customize_preview_init',          array( $this, 'customize_preview_js' ), 10 );
			add_action( 'customize_register',              array( $this, 'customize_register' ), 10 );
			add_filter( 'storefront_setting_default_values', array( $this, 'get_vender_defaults' ) );
			add_action( 'wp_enqueue_scripts',              array( $this, 'add_customizer_css' ), 1000 );
      add_action( 'customize_register',	array( $this, 'edit_default_customizer_settings' ),			99 );
		add_action( 'init',					array( $this, 'default_theme_mod_values' )					);
		}

    /**
  	 * Returns an array of the desired default Storefront options
  	 * @return array
  	 */
  	public function get_vender_defaults() {
  		return apply_filters( 'vender_default_settings', $args = array(
        'vender_header_top_background_color'    => '#124375',
        'vender_header_top_text_color'          => '#eeeeee',
        'storefront_header_background_color'  => '#124375',
        'storefront_header_link_color'        => '#ffffff',
        'storefront_header_text_color'        => '#ffffff',
        'vender_header_nav_bg_color'          => '#1e5792',
        'vender_slider_text_color'            => '#ffffff',
        'vender_slider_bg_color'              => '#124375',
        'vender_slider_item_bg_color'         => '#1e5792',
        'vender_sidebar_background_color'     => '#F2F2F2',
        'vender_sidebar_heading_background_color'   => '#124375',
        'storefront_footer_background_color'  => '#124375',
        'storefront_footer_link_color'        => '#ffffff',
        'storefront_footer_heading_color'     => '#ffffff',
        'storefront_footer_text_color'        => '#ffffff',
        'vender_footer_credits_background_color'=> '#124375',
        'storefront_text_color'               => '#60646c',
        'storefront_heading_color'            => '#484c51',
        'storefront_button_background_color'  => '#fdd922',
        'storefront_button_text_color'        => '#444444',
        'storefront_button_alt_background_color' => '#dd3333',
        'storefront_button_alt_text_color'       => '#ffffff',
				'storefront_accent_color'                => '#fdd922',

  		) );
  	}

    /**
	 * Set default Customizer settings based on Storechild design.
	 * @uses get_vender_defaults()
	 * @return void
	 */
	public function edit_default_customizer_settings( $wp_customize ) {
		foreach ( Vender_Customizer::get_vender_defaults() as $mod => $val ) {
			$setting = $wp_customize->get_setting( $mod );

			if ( is_object( $setting ) ) {
				$setting->default = $val;
			}
		}
	}

	/**
	 * Returns a default theme_mod value if there is none set.
	 * @uses get_vender_defaults()
	 * @return void
	 */
	public function default_theme_mod_values() {
		foreach ( Vender_Customizer::get_vender_defaults() as $mod => $val ) {
			add_filter( 'theme_mod_' . $mod, function( $setting ) use ( $val ) {
				return $setting ? $setting : $val;
			});
		}
	}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer along with several other settings.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 * @since  1.0.0
		 */
		public function customize_register( $wp_customize ) {

      /**
  		 * Header Top Background
  		 */
  		$wp_customize->add_setting( 'vender_header_top_background_color', array(
  			'default'           => apply_filters( 'vender_default_header_top_background_color', '#124375' ),
  			'sanitize_callback' => 'sanitize_hex_color',
  			'transport'			=> 'postMessage',
  		) );
  
  		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vender_header_top_background_color', array(
  			'label'	   => __( 'Top Background color', 'vender' ),
  			'section'  => 'header_image',
  			'settings' => 'vender_header_top_background_color',
  			'priority' => 10,
  		) ) );
  
  		/**
  		 * Header Top text color
  		 */
  		$wp_customize->add_setting( 'vender_header_top_text_color', array(
  			'default'           => apply_filters( 'vender_default_header_top_text_color', '#ffffff' ),
  			'sanitize_callback' => 'sanitize_hex_color',
  			'transport'			=> 'postMessage',
  		) );
  
  		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vender_header_top_text_color', array(
  			'label'	   => __( 'Top Text color', 'vender' ),
  			'section'  => 'header_image',
  			'settings' => 'vender_header_top_text_color',
  			'priority' => 12,
  		) ) );
  
  		/**
  		 * Header Nav Bg color
  		 */
  		$wp_customize->add_setting( 'vender_header_nav_bg_color', array(
  			'default'           => apply_filters( 'vender_default_header_nav_bg_color', '#1e5792' ),
  			'sanitize_callback' => 'sanitize_hex_color',
  			'transport'			=> 'postMessage',
  		) );
  
  		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vender_header_nav_bg_color', array(
  			'label'	   => __( 'Nav background color', 'vender' ),
  			'section'  => 'header_image',
  			'settings' => 'vender_header_nav_bg_color',
  			'priority' => 30,
  		) ) );
  
  		$wp_customize->add_section( 'vender_slider_section' , array(
  	      'title'       => __( 'Slider Options', 'vender' ),
  	      'priority'    => 33,
  	      'description' => __( '', 'vender' ),
  	    ) );
  
  	    $wp_customize->add_setting( 'vender_slider_area', array(
  	      'default' => 'recent',
  	      'sanitize_callback' => 'sanitize_text_field',
  	    ));
  
  	    $wp_customize->add_control( 'effect_select_box', array(
  	      'settings' => 'vender_slider_area',
  	      'label' => __( 'What products to show:', 'vender' ),
  	      'section' => 'vender_slider_section',
  	      'type' => 'select',
  	      'choices' => array(
  	        'featured' => 'Featured Products',
  	        'total_sales' => 'Best Selling Products',
  	        'recent' => 'Recent Products',
  	        'top_rated' => 'Top Rated Products',
  	        'sale' => 'On Sale Products',
  	      ),
  	      'priority' => 12,
  	    ));
  
  	    $wp_customize->add_setting( 'vender_slider_num_show', array (
  	    	'default' => 10,
        		'sanitize_callback' => 'vender_check_number',
  	    ) );
  
  	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vender_slider_num_show', array(
  	      'label'    => __( 'Products show at most', 'vender' ),
  	      'section'  => 'vender_slider_section',
  	      'settings' => 'vender_slider_num_show',
  	      'priority'    => 10,
  	    ) ) );
  
  	    $wp_customize->add_setting( 'vender_slider_bg_color', array(
  			'default'           => apply_filters( 'vender_default_slider_bg_color', '#124375' ),
  			'sanitize_callback' => 'sanitize_hex_color',
  			'transport'			=> 'postMessage',
  		) );
  
  		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vender_slider_bg_color', array(
  			'label'	   => __( 'Slider background color', 'vender' ),
  			'section'  => 'vender_slider_section',
  			'settings' => 'vender_slider_bg_color',
  			'priority' => 14,
  		) ) );
  
  		$wp_customize->add_setting( 'vender_slider_item_bg_color', array(
  			'default'           => apply_filters( 'vender_default_slider_item_bg_color', '#1E5792' ),
  			'sanitize_callback' => 'sanitize_hex_color',
  			'transport'			=> 'postMessage',
  		) );
  
  		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vender_slider_item_bg_color', array(
  			'label'	   => __( 'Slider Item Active background color', 'vender' ),
  			'section'  => 'vender_slider_section',
  			'settings' => 'vender_slider_item_bg_color',
  			'priority' => 15,
  		) ) );
  
  		$wp_customize->add_setting( 'vender_slider_text_color', array(
  			'default'           => apply_filters( 'vender_default_slider_text_color', '#ffffff' ),
  			'sanitize_callback' => 'sanitize_hex_color',
  			'transport'			=> 'postMessage',
  		) );
  
  		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vender_slider_text_color', array(
  			'label'	   => __( 'Text Color', 'vender' ),
  			'section'  => 'vender_slider_section',
  			'settings' => 'vender_slider_text_color',
  			'priority' => 15,
  		) ) );
  
  
  		$wp_customize->add_section( 'vender_sidebar_section' , array(
  	      'title'       => __( 'Sidebar Options', 'vender' ),
  	      'priority'    => 40,
  	      'description' => __( '', 'vender' ),
  	    ) );
  
  	    $wp_customize->add_setting( 'vender_sidebar_background_color', array(
  			'default'           => apply_filters( 'vender_default_sidebar_background_color', '#F2F2F2' ),
  			'sanitize_callback' => 'sanitize_hex_color',
  			'transport'			=> 'postMessage',
  		) );
  
  		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vender_sidebar_background_color', array(
  			'label'	   => __( 'Sidebar Background color', 'vender' ),
  			'section'  => 'vender_sidebar_section',
  			'settings' => 'vender_sidebar_background_color',
  			'priority' => 10,
  		) ) );
  
  		$wp_customize->add_setting( 'vender_sidebar_heading_background_color', array(
  			'default'           => apply_filters( 'vender_default_sidebar_heading_background_color', '#124375' ),
  			'sanitize_callback' => 'sanitize_hex_color',
  			'transport'			=> 'postMessage',
  		) );
  
  		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vender_sidebar_heading_background_color', array(
  			'label'	   => __( 'Sidebar Heading Background color', 'vender' ),
  			'section'  => 'vender_sidebar_section',
  			'settings' => 'vender_sidebar_heading_background_color',
  			'priority' => 13,
  		) ) );
  
  		/**
  		 * Footer Background
  		 */
  		$wp_customize->add_setting( 'vender_footer_credits_background_color', array(
  			'default'           => apply_filters( 'vender_default_footer_credits_background_color', '#124375' ),
  			'sanitize_callback' => 'sanitize_hex_color',
  			'transport'			=> 'postMessage',
  		) );
  
  		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vender_footer_credits_background_color', array(
  			'label'	   => __( 'Bottom Background color', 'vender' ),
  			'section'  => 'storefront_footer',
  			'settings' => 'vender_footer_credits_background_color',
  			'priority' => 50,
  		) ) );
  
  		/**
  		 * Social Media Icons
  		 */
  	    $wp_customize->add_section( 'vender_social_section' , array(
  	      'title'       => __( 'Social Media Icons', 'vender' ),
  	      'priority'    => 42,
  	      'description' => __( 'Optional media icons in the header', 'vender' ),
  	    ) );
  
  	    $wp_customize->add_setting( 'vender_facebook', array (
        		'sanitize_callback' => 'esc_url_raw',
  	    ) );
  
  	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vender_facebook', array(
  	      'label'    => __( 'Enter your Facebook url', 'vender' ),
  	      'section'  => 'vender_social_section',
  	      'settings' => 'vender_facebook',
  	      'priority'    => 101,
  	    ) ) );
  
  	    $wp_customize->add_setting( 'vender_twitter', array (
  	      'sanitize_callback' => 'esc_url_raw',
  	    ) );
  
  	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vender_twitter', array(
  	      'label'    => __( 'Enter your Twitter url', 'vender' ),
  	      'section'  => 'vender_social_section',
  	      'settings' => 'vender_twitter',
  	      'priority'    => 102,
  	    ) ) );
  
  	    $wp_customize->add_setting( 'vender_google', array (
  	      'sanitize_callback' => 'esc_url_raw',
  	    ) );
  
  	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vender_google', array(
  	      'label'    => __( 'Enter your Google+ url', 'vender' ),
  	      'section'  => 'vender_social_section',
  	      'settings' => 'vender_google',
  	      'priority'    => 103,
  	    ) ) );
  
  	    $wp_customize->add_setting( 'vender_pinterest', array (
  	      'sanitize_callback' => 'esc_url_raw',
  	    ) );
  
  	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vender_pinterest', array(
  	      'label'    => __( 'Enter your Pinterest url', 'vender' ),
  	      'section'  => 'vender_social_section',
  	      'settings' => 'vender_pinterest',
  	      'priority'    => 104,
  	    ) ) );
  
  	    $wp_customize->add_setting( 'vender_linkedin', array (
  	      'sanitize_callback' => 'esc_url_raw',
  	    ) );
  
  	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vender_linkedin', array(
  	      'label'    => __( 'Enter your Linkedin url', 'vender' ),
  	      'section'  => 'vender_social_section',
  	      'settings' => 'vender_linkedin',
  	      'priority'    => 105,
  	    ) ) );
  
  	    $wp_customize->add_setting( 'vender_youtube', array (
  	      'sanitize_callback' => 'esc_url_raw',
  	    ) );
  
  	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vender_youtube', array(
  	      'label'    => __( 'Enter your Youtube url', 'vender' ),
  	      'section'  => 'vender_social_section',
  	      'settings' => 'vender_youtube',
  	      'priority'    => 106,
  	    ) ) );
  
  	    $wp_customize->add_setting( 'vender_tumblr', array (
  	      'sanitize_callback' => 'esc_url_raw',
  	    ) );
  
  	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vender_tumblr', array(
  	      'label'    => __( 'Enter your Tumblr url', 'vender' ),
  	      'section'  => 'vender_social_section',
  	      'settings' => 'vender_tumblr',
  	      'priority'    => 107,
  	    ) ) );
  
  	    $wp_customize->add_setting( 'vender_instagram', array (
  	      'sanitize_callback' => 'esc_url_raw',
  	    ) );
  
  	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vender_instagram', array(
  	      'label'    => __( 'Enter your Instagram url', 'vender' ),
  	      'section'  => 'vender_social_section',
  	      'settings' => 'vender_instagram',
  	      'priority'    => 108,
  	    ) ) );
  
  	    $wp_customize->add_setting( 'vender_flickr', array (
  	      'sanitize_callback' => 'esc_url_raw',
  	    ) );
  
  	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vender_flickr', array(
  	      'label'    => __( 'Enter your Flickr url', 'vender' ),
  	      'section'  => 'vender_social_section',
  	      'settings' => 'vender_flickr',
  	      'priority'    => 109,
  	    ) ) );
  
  	    $wp_customize->add_setting( 'vender_vimeo', array (
  	      'sanitize_callback' => 'esc_url_raw',
  	    ) );
  
  	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vender_vimeo', array(
  	      'label'    => __( 'Enter your Vimeo url', 'vender' ),
  	      'section'  => 'vender_social_section',
  	      'settings' => 'vender_vimeo',
  	      'priority'    => 110,
  	    ) ) );
  
  	    $wp_customize->add_setting( 'vender_rss', array (
  	      'sanitize_callback' => 'esc_url_raw',
  	    ) );
  
  	    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'vender_rss', array(
  	      'label'    => __( 'Enter your RSS url', 'vender' ),
  	      'section'  => 'vender_social_section',
  	      'settings' => 'vender_rss',
  	      'priority'    => 112,
  	    ) ) );


		}



		/**
		 * Add CSS in <head> for styles handled by the theme customizer
		 * If the Customizer is active pull in the raw css. Otherwise pull in the prepared theme_mods.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function add_customizer_css() {
    $vender_accent_color 					= get_theme_mod( 'storefront_accent_color' );
		$vender_header_top_background_color 	= get_theme_mod( 'vender_header_top_background_color' );
		$vender_header_top_text_color 			= get_theme_mod( 'vender_header_top_text_color' );
		$vender_header_background_color 		= get_theme_mod( 'storefront_header_background_color' );
		$vender_header_link_color 				= get_theme_mod( 'storefront_header_link_color' );
		$vender_header_text_color 				= get_theme_mod( 'storefront_header_text_color' );
    $vender_header_nav_bg             = get_theme_mod( 'vender_header_nav_bg_color' );
    
    $vender_slider_text_color         = get_theme_mod( 'vender_slider_text_color' );
    $vender_slider_bg         = get_theme_mod( 'vender_slider_bg_color' );
    $vender_slider_item_bg         = get_theme_mod( 'vender_slider_item_bg_color' );
    
    $vender_sidebar_background_color         = get_theme_mod( 'vender_sidebar_background_color' );
    $vender_sidebar_h_background_color         = get_theme_mod( 'vender_sidebar_heading_background_color' );

		$vender_footer_background_color 		= get_theme_mod( 'storefront_footer_background_color' );
		$vender_footer_link_color 				= get_theme_mod( 'storefront_footer_link_color' );
		$vender_footer_heading_color 			= get_theme_mod( 'storefront_footer_heading_color' );
		$vender_footer_text_color 				= get_theme_mod( 'storefront_footer_text_color' );
		$vender_credits_background_color 		= get_theme_mod( 'vender_footer_credits_background_color' );

		$vender_text_color 					= get_theme_mod( 'storefront_text_color' );
		$vender_heading_color 					= get_theme_mod( 'storefront_heading_color' );
		$vender_button_background_color 		= get_theme_mod( 'storefront_button_background_color' );
		$vender_button_text_color 				= get_theme_mod( 'storefront_button_text_color' );
		$vender_button_alt_background_color 	= get_theme_mod( 'storefront_button_alt_background_color' );
		$vender_button_alt_text_color 			= get_theme_mod( 'storefront_button_alt_text_color' );

		$vender_brighten_factor 				= 25;
		$vender_darken_factor 					= -40;
    $vender_darken_factor2          = -200;

		$style 							= '
    header .top-area{
			background-color: ' . $vender_header_top_background_color . ';
			color: ' . $vender_header_top_text_color . ';
		}
		.site-branding p.site-title a{
			color: ' . $vender_header_text_color . ';
		}
		header .social-media .social-tw{
			color: ' . $vender_header_top_text_color . ';
		}
		button.menu-toggle:hover:before,
		button.menu-toggle:hover:after,
		button.menu-toggle:hover span:before,
		button.menu-toggle:focus:before,
		button.menu-toggle:focus:after,
		button.menu-toggle:focus span:before{
			background-color: ' . $vender_text_color . '!important;
		}
		
		#banner-area .product-slider .banner-product-details .price,
		.title-holder .inner-title h1,
		.cart-collaterals h2,
		header .second-nav ul li a:hover,
		header .second-nav ul li a:focus,
		header .social-media .social-tw:hover,
		header .social-media .social-tw:focus{
			color: ' . $vender_accent_color . '!important;
		}
		#banner-area .flex-control-paging li a.flex-active,
		ul.products li.product .vender,
		.woocommerce-info, 
		.woocommerce-noreviews, 
		p.no-comments,
		.woocommerce-error, 
		.woocommerce-info, 
		.woocommerce-message, 
		.woocommerce-noreviews, 
		p.no-comments,
		.flex-control-paging li a.flex-active{
			background-color: ' . $vender_accent_color . '!important;
		}

		#banner-area #carousel{
			background-color: ' . $vender_slider_bg . ';
		}
		.flex-active-slide .banner-product-details{
			background-color: ' . $vender_slider_item_bg . ';
		}
		.banner-product-details{
			border-bottom: 1px solid ' . $vender_slider_item_bg . ';
		}
		#banner-area .product-slider .banner-product-details h3{
			color: ' . $vender_slider_text_color . ';
		}
	
		.widget-area .widget{
			background-color: ' . $vender_sidebar_background_color . ';
		}
		.widget h2.widget-title{
			background-color: ' . $vender_sidebar_h_background_color . ';
		}
		
		.site-footer .credits-area{
			background-color: ' . $vender_credits_background_color . ';
		}

		.main-nav,
		.main-navigation ul.menu ul li, .main-navigation ul.nav-menu ul li{
			background-color: ' . $vender_header_nav_bg . ';
		}

		.main-navigation ul li a:hover,
		.main-navigation ul li a:hover, .main-navigation ul li:hover > a, .site-title a:hover,
		.site-title a:hover {
			color: ' . $vender_header_link_color . '!important;
		}

		.site-header,
		.main-navigation ul ul,
		.secondary-navigation ul ul,
		.main-navigation ul.menu > li.menu-item-has-children:after,
		.secondary-navigation ul.menu ul,
		.main-navigation ul.menu ul,
		.main-navigation ul.nav-menu ul {
			background-color: ' . $vender_header_background_color . ';
		}
		h1, h2, h3, h4, h5, h6 {
			color: ' . $vender_heading_color . ';
		}

		.hentry .entry-header {
			border-color: ' . $vender_heading_color . ';
		}

		.widget h1 {
			border-bottom-color: ' . $vender_heading_color . ';
		}

		body,
		.secondary-navigation a,
		.widget-area .widget a,
		#comments .comment-list .reply a,
		.pagination .page-numbers li .page-numbers:not(.current), .woocommerce-pagination .page-numbers li .page-numbers:not(.current),
		.storefront-product-section .section-title {
			color: ' . $vender_text_color . ';
		}

		a ,
		a:focus,
		ul.products li.product .price{
			color: ' . $vender_heading_color . ';
		}

		.title-holder .breadcrumbs-area nav a,
		.button:focus,
		.button.alt:focus,
		.button.added_to_cart:focus,
		.button.wc-forward:focus,
		button:focus,
		input[type="button"]:focus,
		input[type="reset"]:focus,
		input[type="submit"]:focus,
		article .post-content-area .more-link:focus {
			outline-color: ' . $vender_accent_color . ';
		}

		article .post-content-area .more-link,.site-header-cart .cart-contents,button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart, .widget-area .widget a.button, .site-header-cart .widget_shopping_cart a.button {
			background-color: ' . $vender_button_background_color . ';
			border-color: ' . $vender_button_background_color . ';
			color: ' . $vender_button_text_color . ';
		}
		.site-header-cart .cart-contents{
			background-color: ' . $vender_button_background_color . '!important;
			border-color: ' . $vender_button_background_color . ';
			color: ' . $vender_button_text_color . '!important;
		}
		.navigation-area #searchform input[type="text"]:focus{
			border: 4px solid ' . $vender_button_background_color . '!important;
		}
		.navigation-area #searchform button:focus{
			background-color: ' . $vender_button_background_color . '!important;
		}

		article .post-content-area .more-link:hover,.site-header-cart .cart-contents:hover,button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .button:hover, .added_to_cart:hover, .widget-area .widget a.button:hover, .site-header-cart .widget_shopping_cart a.button:hover,
		article .post-content-area .more-link:focus,.site-header-cart .cart-contents:focus,button:focus, input[type="button"]:focus, input[type="reset"]:focus, input[type="submit"]:focus, .button:focus, .added_to_cart:focus, .widget-area .widget a.button:focus, .site-header-cart .widget_shopping_cart a.button:focus {
			background-color: ' . storefront_adjust_color_brightness( $vender_button_background_color, $vender_brighten_factor ) . '!important;
			border-color: ' . storefront_adjust_color_brightness( $vender_button_background_color, $vender_brighten_factor ) . ';
			color: ' . $vender_button_text_color . '!important;
		}

		button.alt, input[type="button"].alt, input[type="reset"].alt, input[type="submit"].alt, .button.alt, .added_to_cart.alt, .widget-area .widget a.button.alt, .added_to_cart, .pagination .page-numbers li .page-numbers.current, .woocommerce-pagination .page-numbers li .page-numbers.current {
			background-color: ' . $vender_button_alt_background_color . ';
			border-color: ' . $vender_button_alt_background_color . ';
			color: ' . $vender_button_alt_text_color . ';
		}

		button.alt:hover, input[type="button"].alt:hover, input[type="reset"].alt:hover, input[type="submit"].alt:hover, .button.alt:hover, .added_to_cart.alt:hover, .widget-area .widget a.button.alt:hover, .added_to_cart:hover {
			background-color: ' . storefront_adjust_color_brightness( $vender_button_alt_background_color, $vender_darken_factor ) . ';
			border-color: ' . storefront_adjust_color_brightness( $vender_button_alt_background_color, $vender_darken_factor ) . ';
			color: ' . storefront_adjust_color_brightness( $vender_button_alt_text_color, $vender_darken_factor2 ) . '!important;
		}

		.site-footer {
			background-color: ' . $vender_footer_background_color . ';
			color: ' . $vender_footer_text_color . ';
		}

		.site-footer a:not(.button) {
			color: ' . $vender_footer_link_color . ';
		}

		.site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6 {
			color: ' . $vender_footer_heading_color . ';
		}
		.woocommerce-error a, .woocommerce-info a, .woocommerce-message a, .woocommerce-noreviews a, p.no-comments a{
			color: ' . storefront_adjust_color_brightness( $vender_button_text_color, $vender_darken_factor2 ) . '!important;
		}

		@media screen and ( min-width: 768px ) {
			.main-navigation ul.menu > li > ul {
				border-top-color: ' . $vender_header_background_color . '}
			}

			.secondary-navigation ul.menu a:hover {
				color: ' . storefront_adjust_color_brightness( $vender_header_text_color, $vender_brighten_factor ) . ';
			}

			.main-navigation ul.menu ul {
				background-color: ' . $vender_header_background_color . ';
			}

			.secondary-navigation ul.menu a {
				color: ' . $vender_header_text_color . ';
			}
		}';

		$vender_woocommerce_style 							= '
		a.cart-contents,
		.site-header-cart .widget_shopping_cart a {
			color: ' . $vender_header_link_color . ';
		}

		a.cart-contents:hover,
		.site-header-cart .widget_shopping_cart a:hover {
			color: ' . storefront_adjust_color_brightness( $vender_header_link_color, $vender_darken_factor ) . ';
		}

		.site-header-cart .widget_shopping_cart {
			background-color: ' . $vender_header_background_color . ';
		}

		.widget-area .widget a:hover,
		.product_list_widget a:hover,
		.quantity .plus, .quantity .minus,
		p.stars a:hover:after,
		p.stars a:after
		 {
			color: ' . $vender_accent_color . ';
		}

		.widget_price_filter .ui-slider .ui-slider-range,
		.widget_price_filter .ui-slider .ui-slider-handle,
		.vender {
			background-color: ' . $vender_accent_color . ';
		}

		#order_review_heading, #order_review {
			border-color: ' . $vender_accent_color . ';
		}

		@media screen and ( min-width: 768px ) {
			.site-header-cart .widget_shopping_cart,
			.site-header .product_list_widget li .quantity {
				color: ' . $vender_header_text_color . ';
			}
		}

		';
    
    wp_add_inline_style( 'storefront-child-style', $style );
    wp_add_inline_style( 'storefront-woocommerce-style', $vender_woocommerce_style );
		}

		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 *
		 * @since  1.0.0
		 */
		public function customize_preview_js() {
			wp_enqueue_script( 'vender-customizer', get_stylesheet_directory_uri() . '/inc/customizer/js/customizer.min.js', array( 'customize-preview' ), '1.16', true );
		}

	}

endif;

return new Vender_Customizer();