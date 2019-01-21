<?php

use ComponentProjectManager\classes\Eonet_PM_Project;

/**
 * Set a global variable $project, wich already contains all the project meta values,
 * it's useful to avoid doubled queries to get the details of the project items
 *
 * @param $post
 *
 * @return Eonet_PM_Project|void
 */
function eopm_setup_project_data( $post ) {
    unset( $GLOBALS['project'] );

    $project = new Eonet_PM_Project($post);

    if ( empty( $project->post->post_type ) || $project->post->post_type != Eonet_PM_Project::POST_TYPE )
        return;

    $project->loadAllMetaValues();

    $GLOBALS['project'] = $project;

}
add_action( 'the_post', 'eopm_setup_project_data' );

/**
 * AJAX handler for project member autocomplete requests.
 *
 */
function eonet_project_admin_member_autocomplete() {

	// Bail if user user shouldn't be here, or is a large network.
	if ( ! current_user_can( 'manage_options' ) || ( is_multisite() && wp_is_large_network( 'users' ) ) ) {
		wp_die( - 1 );
	}

	$term = isset( $_GET['term'] ) ? sanitize_text_field( $_GET['term'] ) : '';

	if ( ! $term ) {
		wp_die( - 1 );
	}

	//TODO remove users already added?
	$users       = new \WP_User_Query( array(
		'search'         => '*' . esc_attr( $term ) . '*',
		'search_columns' => array(
			'user_login',
			'user_nicename',
			'user_email',
			'user_url',
		),
	) );
	$users_found = $users->get_results();

	$matches = array();

	if ( $users_found && ! is_wp_error( $users_found ) ) {
		foreach ( $users_found as $user ) {

			$matches[] = array(
				// Translators: 1: user_login, 2: user_email.
				'label' => sprintf( __( '%1$s (%2$s)', 'eonet-project-manager' ), $user->user_nicename, $user->user_login ),
				'value' => $user->ID,
			);
		}
	}

	wp_die( json_encode( $matches ) );
}
add_action( 'wp_ajax_eonet_project_admin_member_autocomplete', 'eonet_project_admin_member_autocomplete'  );