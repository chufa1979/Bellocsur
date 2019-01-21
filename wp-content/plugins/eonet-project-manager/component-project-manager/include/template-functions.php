<?php

use ComponentProjectManager\classes\Eonet_PM_Project;
use ComponentProjectManager\classes\Eonet_PM_TaskRendering;

/**
 * Output the start of the projects loop
 */
function eopm_projects_loop_start( ) {
	eonet_project_manager()->getTemplatePart( 'loop/loop-start.php' );
}
add_action( 'eopm_before_projects_loop', 'eopm_projects_loop_start', 10);

/**
 * Output the end of the projects loop
 */
function eopm_projects_loop_end( ) {
	eonet_project_manager()->getTemplatePart( 'loop/loop-end.php' );
}
add_action( 'eopm_after_projects_loop', 'eopm_projects_loop_end', 10);

/**
 * Render the list of administrators
 */
function eopm_render_administrators_list() {

	if( apply_filters( 'eopm_hide_administrators_list', false ) )
		return;

	global $project;
	$members_ids = array($project->post->post_author);
	$title = _n( 'Project Administrator', 'Project Administrators', count($members_ids), 'eonet-project-manager' );

	echo eopm_project_members_list( $members_ids, $title);

}
add_action( 'eopm_project_header_right', 'eopm_render_administrators_list', 10);

/**
 * Render the list of basic members
 */
function eopm_render_members_list() {

	echo eopm_project_members_list();

}
add_action( 'eopm_project_header_right', 'eopm_render_members_list', 20);

/**
 * Print the dates of the current project
 */
function eopm_project_dates() {

	global $project;

	if(!($project instanceof Eonet_PM_Project))
		return;

	$starting_date = $project->getStartingDateToString();
	$ending_date = $project->getEndingDateToString();
	if( empty($starting_date) && empty($ending_date) )
		return;
	?>

	<div class="eo_single_project_dates_wrapper eo_single_project_header_section">
		<h4 class="eo_single_project_dates_title"><?php echo esc_html_x('Dates', 'Title of the section in the header of the single project', 'eonet-project-manager'); ?></h4>

		<?php
		if(!empty($starting_date))
			echo '<div class="eo_single_project_date"><span class="label">'.esc_html__('Starting date:', 'eonet-project-manager').'</span> ' . $starting_date . '</div>';

		if(!empty($ending_date))
			echo '<div class="eo_single_project_date"><span class="label">'.esc_html__('Ending date:', 'eonet-project-manager').'</span> ' . $ending_date . '</div>';

		?>


	</div>

	<?php
}
add_action( 'eopm_project_header_left', 'eopm_project_dates', 10);

/**
 * Outputs the project's progress bar
 * See eopm_get_project_progress
 */
function eopm_project_progress_bar() {

    echo eopm_get_project_progress();

}
add_action( 'eopm_project_header_left', 'eopm_project_progress_bar', 20);

// TODO switch this using an helper function that render only the bar
/**
* Returns the project's progress bar
*
* @return string
*/
function eopm_get_project_progress() {

    global $project;

    $html = '';

    $progress_type = $project->getProgressType();

    if ( $progress_type == 'date' && ( empty($project->getStartingDate()) || empty($project->getEndingDate() ) ) )
		return $html;

    if($progress_type != 'nothing') {

        $progress_val = eopm_get_project_progress_percentage($progress_type);

        $html .= '<div class="eo-project-progress-wrapper eo_single_project_header_section">';

            $progress_icon = ($progress_type == 'tasks') ? 'ion-ios-checkmark' : 'ion-ios-clock';

            $html .= '<h4 class="eo-project-progress-title">';
            //$html .= __('Project Progress', 'eonet-project-manager') . ' <i class="' . $progress_icon . '"></i>';
            $html .= __('Project Progress', 'eonet-project-manager');
            $html .= '</h4>';

            $html .= '<div class="eo-project-progress">';
                $html .= '<div class="eo-progress-bar" role="progressbar" aria-valuenow="'.$progress_val.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress_val.'%">';
                    $html .= '<span class="eo-progress-current">';
                        $html .= $progress_val.' %';
                    $html .= '</span>';
                $html .= '</div>';
            $html .= '</div>';

        $html .= '</div>';

    }

    return $html;

}

/**
 * Outputs the project's navigation
 * See eopm_get_project_nav
 *
 * @param array $args
 */
function eopm_render_project_nav( $args = array() ) {

    echo eopm_get_project_nav( $args );

}
add_action( 'eopm_sigle_project_nav', 'eopm_render_project_nav', 10);

/**
 * Returns the project's navigation
 *
 * @param array $buttons
 *
 * @return string
 */
function eopm_get_project_nav( $buttons = array() ) {

    $defaults = array(
	    'description' => false,
	    'tasks' => false,
	    'comments' => false,
	    'info' => false
    );
    $buttons = wp_parse_args( $buttons, $defaults );


    $html = '';

    $html .= '<ul>';

    if($buttons['description']) {
        $html .= eopm_get_project_nav_button(array(
            'slug' => 'description',
            'title' => __('Description', 'eonet-project-manager'),
            'icon' => 'ion-ios-paper-outline'
        ));
    }

    if($buttons['tasks']) {
        $html .= eopm_get_project_nav_button(array(
            'slug' => 'tasks',
            'title' => __('Tasks', 'eonet-project-manager'),
            'icon' => 'ion-ios-list-outline'
        ));
    }

    if($buttons['comments']) {
        $html .= eopm_get_project_nav_button(array(
            'slug' => 'comments',
            'title' => __('Comments', 'eonet-project-manager'),
            'icon' => 'ion-ios-chatboxes-outline'
        ));
    }

    if($buttons['info']) {
        $html .= eopm_get_project_nav_button(array(
            'slug' => 'info',
            'title' => __('Info', 'eonet-project-manager'),
            'icon' => 'ion-ios-information-outline'
        ));
    }

    $html .= '</ul>';

    return $html;

}

/**
 * Display the tabs content in the single project page
 *
 * @param $tabs
 */
function eopm_single_project_sections_wrapper( $tabs ) {

	$defaults = array(
		'description' => false,
		'tasks' => false,
		'comments' => false,
		'info' => false
	);
	$tabs = wp_parse_args( $tabs, $defaults );

    if($tabs['description']) {
        eopm_render_single_project_section('description');
    }

	if($tabs['tasks']) {
		eopm_render_single_project_section('tasks');
	}

	if($tabs['comments']) {
		eopm_render_single_project_section('comments');
	}

	if($tabs['info']) {
		eopm_render_single_project_section('info');
	}

}
add_action( 'eopm_single_project_content', 'eopm_single_project_sections_wrapper', 10 );

/**
 * Override the comments template for the eonet_project posts
 *
 * @param $comment_template
 *
 * @return string|void
 * @throws Exception
 */
function eopm_override_comment_template( $comment_template ) {
	global $post;

	if(is_singular() && $post->post_type == Eonet_PM_Project::POST_TYPE){
		return eonet_project_manager()->getTemplatePartPath('single-project/comments-template.php');
	}

	return $comment_template;
}
add_filter( "comments_template", "eopm_override_comment_template" );

/**
 * Get the template for the sidebar
 */
function eopm_main_content_wrapper_start() {
	eonet_project_manager()->getTemplatePart( 'global/wrapper-start.php' );
}
add_action('eopm_before_main_content', 'eopm_main_content_wrapper_start', 10);

/**
 * Get the template for the sidebar
 */
function eopm_main_content_wrapper_end() {
	eonet_project_manager()->getTemplatePart( 'global/wrapper-end.php' );
}
add_action('eopm_after_main_content', 'eopm_main_content_wrapper_end', 10);

/**
 * Get the template for the sidebar
 */
function eopm_render_sidebar() {
	eonet_project_manager()->getTemplatePart( 'global/sidebar.php' );
}
add_action('eopm_sidebar', 'eopm_render_sidebar', 10);

/**
 * The theme TwentySeventeen needs an additional div closed in order to preserve alignment
 *
 * @param $classes
 */
function eopm_close_twentyseventeen_wrap( $classes ) {

	$template = get_option( 'template' );

	if( $template == 'twentyseventeen' ) {

		echo '</div><!-- .wrap -->';
	}

}
add_action( 'eopm_sidebar', 'eopm_close_twentyseventeen_wrap', 30);

/*
 * The functions below have been temporary removed in order to simplify the structure of the template files
 */

/**
 * Output the title of the item in the projects loop
 */
//function eopm_projects_loop_item_title( ) {
//	echo '<h2 class="eo_project_item_title">' . get_the_title() . '</h2>';
//}
//add_action ('eopm_projects_loop_item_header', 'eopm_projects_loop_item_title', 10);

/**
 * Output the title of the item in the projects single
 */
//function eopm_single_project_title( ) {
//	echo '<h1 class="eo-project-title">' . get_the_title() . '</h1>';
//}
//add_action( 'eopm_single_project_title', 'eopm_single_project_title' );

/**
 * Output the content of the item in the projects loop
 */
//function eopm_projects_loop_item_content( ) {
//
//	echo '<div class="">';
//	the_content();
//	echo '</div>';
//
//}
//add_action( 'eopm_projects_loop_item_content', 'eopm_projects_loop_item_content');

/**
 * Output the "Open Project" button of the item in the projects loop
 */
//function eopm_projects_loop_item_open_project_button( ) {
//	eonet_project_manager()->getTemplatePart( 'loop/open-project-button.php' );
//}
//add_action('eopm_projects_loop_item_content', 'eopm_projects_loop_item_open_project_button', 30);