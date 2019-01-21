<?php 
/*
* Plugin Name: WooEnhancer - Improve and customize WooCommerce
* Plugin URI: http://alborotado.com
* Description: Extends Woocommerce capabilities and lets you customize the design...
* Version: 1.10
* Author: Miguras
* Author URI: http://alborotado.com
* License: GPLv2 or later
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
*/
if ( ! defined( 'ABSPATH' ) ) {
exit; // Exit if accessed directly
}
define("MIGWOOPATH", plugin_dir_url( __FILE__ ));
		
		//========================= Variables ===================================
	
	
		/*======================== FUNCTIONS ==============================*/
		
		if ( file_exists( dirname( __FILE__ ) . '/inc/functions.php' ) ) {
			require_once( dirname( __FILE__ ) . '/inc/functions.php' );
		}
		
		
		
		// ========================== REDUX FRAMEWORK =========================================
		if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/admin/redux-framework/framework.php' ) ) {
			require_once( dirname( __FILE__ ) . '/admin/redux-framework/framework.php' );
		}
		if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/admin/wooenhancer-options.php' ) ) {
			require_once( dirname( __FILE__ ) . '/admin/wooenhancer-options.php' );
		}
		
		/*====================== TGM =========================*/
		if ( file_exists( dirname( __FILE__ ) . '/inc/plugins/plugin-activation.php' ) ) {
			require_once( dirname( __FILE__ ) . '/inc/plugins/plugin-activation.php' );
		}
		
		
		/*=========================== METABOXES ===================*/
		if ( file_exists( dirname( __FILE__ ) . '/metaboxes/plugin-metaboxes.php' ) ) {
			require_once( dirname( __FILE__ ) . '/metaboxes/plugin-metaboxes.php' );
		}
	

		
		/*=========================== DYNAMIC CSS ===================*/
		if ( file_exists( dirname( __FILE__ ) . '/assets/css/dynamic-styles.php' ) ) {
			require_once( dirname( __FILE__ ) . '/assets/css/dynamic-styles.php' );
		}
		
		if(!is_admin() && function_exists('wp_register_script')){
					add_action('wp_head', 'migwoo_enhancer_dynamic_styles');
		};
		
		//===================== STYLES AND SCRIPTS ===========================
		add_action( 'wp_enqueue_scripts', 'mig_wooenhancer_front_styles' );
		function mig_wooenhancer_front_styles(){
			wp_enqueue_script( 'jquery');
			wp_enqueue_style( 'basic-wooenhancer', plugin_dir_url( __FILE__ ) . 'assets/css/front-styles.css', rand(0, 100));
		};
		
		function wooenhancer_admin_script(){
			wp_enqueue_script( 'wooenhancer-admin', plugin_dir_url( __FILE__ ) . 'assets/js/wooenhancer-admin.js');
		}
		
		
			add_action( 'admin_enqueue_scripts', 'wooenhancer_admin_script' );

	
	
	/*======================= Admin Notices ========================*/
	
	function prefix_deprecated_hook_admin_notice() {
		 
				// Check if it's been dismissed...
				if ( ! get_option('dismissed-wooenhancer-dismissed-1-10', FALSE ) ) { 
						// Added the class "notice-my-class" so jQuery pick it up and pass via AJAX,
						// and added "data-notice" attribute in order to track multiple / different notices
						// multiple dismissible notice states ?>
						<div class="notice notice-info notice-my-class is-dismissible" data-notice="wooenhancer-dismissed-1-10">
							<p><?php _e( 'Get WooEnhancer PRO for FREE. Just follow me at CreativeMarket here <a href="https://creativemarket.com/miguras?u=miguras" target="_blank">CreativeMarket Miguras Profile</a> and send me a message requesting the plugin. I will send you as fast as possible.', 'migwooenhancer' ); ?></p>
						</div>
				<?php }
		
	}

add_action( 'admin_notices', 'prefix_deprecated_hook_admin_notice' );

add_action( 'wp_ajax_dismissed_notice_handler', 'ajax_notice_handler' );

/**
 * AJAX handler to store the state of dismissible notices.
 */
function ajax_notice_handler() {
    // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
   	global $post;
    $type = $_POST['type'];
    // Store it in the options table
    update_option( 'dismissed-' . $type, TRUE );
}



?>
