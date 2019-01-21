<?php

use ComponentProjectManager\classes\Eonet_PM_Project;
use Eonet\Core\EonetMetaboxes;

/**
 * We add custom fields to the frontend form
 * It's only for the frontend component though
 * @param $fields array the current fields
 * @param $id int the id of the post
 * @return $fields
 */
function eopm_custom_frontend_fields($fields, $id) {

	$post = get_post( $id );

	if($post->post_type != Eonet_PM_Project::POST_TYPE) {
		return $fields;
	}

	$settings = array();

	$path = dirname(__DIR__).'/metaboxes.php';

	if(file_exists($path)) {
		include($path);
	}

	$custom_fields = EonetMetaboxes::setDefaultValues($id, $settings['options']);

	$fields_merge = array_merge($fields, $custom_fields);

	return $fields_merge;

}
add_filter('eonet_front_custom_fields', 'eopm_custom_frontend_fields', 10, 2);

/**
 * Saving the custom options
 * We are using the metabox class as it's using the same properties and it guarantee
 * the data matching between frontend and backend sides
 * @param int $post_id Post ID
 * @return integer|void
 */
function eopm_custom_frontend_save($post_id) {

	if(get_post_type($post_id) != 'eonet_project') {
		return;
	}

	$_POST['eonet_metabox_nonce'] = wp_create_nonce( 'eonet_metabox_nonce' );

	EonetMetaboxes::$type = Eonet_PM_Project::POST_TYPE;
	EonetMetaboxes::save($post_id);

}
add_action( 'eonet_frontend_custom_process', 'eopm_custom_frontend_save', 10 );

/**
 * Remove the edit button from the frontend editor from its default location
 * @param $post_types array
 * @return array
 */
function eopm_remove_edit_frontend($post_types) {

	$post_types[] = Eonet_PM_Project::POST_TYPE;

	return $post_types;

}
add_filter('eonet_front_edit_btn_deactivated', 'eopm_remove_edit_frontend');

/**
 * We display our own button to edit the post at the end of the project content
 */
function eopm_add_custom_edit_frontend_btn() {

	if(!function_exists('eonet_component_init_frontend_publisher')) {
		return;
	}

	// Buttons class :
	$btn_classes = apply_filters('eonet_front_btn_classes', 'eo_btn eo_btn_default');

	// We build the markup :
	$btn_html = '<div id="eo_manage_btns">';
	$btn_html .= '<hr>';
	$btn_html .= '<a href="javascript:void(0);" data-eo-post-id="'.get_the_ID().'" id="eo_edit_btn" class="'.$btn_classes.'">';
	$btn_html .= '<i class="ion-ios-compose-outline"></i>'. __('Edit', 'eonet-project-manager') . ' ' . get_the_title();
	$btn_html .= '</a>';
	$btn_html .= '</div>';

	echo $btn_html;

}
add_action( 'eopm_single_project_content', 'eopm_add_custom_edit_frontend_btn', 20 );