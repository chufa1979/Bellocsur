<?php 

function migwoo_admin_styles(){
	global $migwoo_enhancer;
	
	wp_enqueue_style( 'migwoo-enhancer-admin-styles', MIGWOOPATH .'assets/css/admin-styles.css');
}

add_action('admin_enqueue_scripts', 'migwoo_admin_styles');

?>
