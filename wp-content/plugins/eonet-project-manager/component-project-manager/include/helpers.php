<?php

use ComponentProjectManager\classes\Eonet_PM_Project;

/**
 * Return option name as an array
 *
 * @name string $name Option's name
 * @param int $id Post's ID
 * @return string
 */
function eopm_get_task_option($name, $id) {
    return 'tasks_assigned['.$id.']['.$name.']';
}

/**
 * Return the id of the page selected in the settings as projects loop page
 *
 * @return int
 */
function eopm_get_loop_page_id(){

	$page_id = eonet_get_option('pm_projects_page_id');
	$page_id = (empty($page_id)) ? 0 : $page_id;

	return apply_filters( 'eopm_get_loop_page_id', (int)$page_id );
	
}

/**
 * Return the title of the projects loop page
 *
 * @return string
 */
function eopm_get_loop_page_title(){

	$page_id = eopm_get_loop_page_id();

	$page_title = ($page_id) ? get_the_title( $page_id ) : esc_html__( 'Projects', 'eonet');
	
	return apply_filters( 'eopm_get_loop_page_title', $page_title );

}

/**
 * Returns the inline CSS for a project having a thumbnail image
 * @param $post_id int
 * @return string
 */
function eopm_get_featured_image_style($post_id){

    $style = '';

    if(has_post_thumbnail($post_id)) {

        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
        $style = 'style="background-image: url('. $image[0] .')"';

    }

    return apply_filters('eopm_get_featured_image_style', $style, $post_id);

}

/**
 * Return the class to assign the the project article, depending on if it has or hans't a featured image set
 *
 * @param int $post_id
 *
 * @return string
 */
function eopm_get_featured_image_css_class( $post_id ) {
	return (has_post_thumbnail($post_id)) ? 'has-featured' : 'no-featured';
}

/**
 * Get a standardized format to print the dates
 *
 * @param string $type
 *
 * @return mixed|void
 * @throws Exception
 */
function eopm_get_date_format( $type = '' ) {

	if(empty($type))
		$type = 'display';

	switch ( $type ) {
		case 'display':
			return apply_filters( 'eopm_date_format_display', get_option( 'date_format' ) );
		case 'datepicker':
			return apply_filters( 'eopm_date_format_datepicker', 'Y-m-d' );
		default:
			throw new Exception( 'Impossible to return a valid date format: Unknown type provided.' );
	}
}

/**
 * Check if the current page is a single project
 *
 * @return bool
 */
function eopm_is_single_project() {
	return apply_filters( 'eopm_is_single_project',  is_singular( Eonet_PM_Project::POST_TYPE ) );
}

/**
 * Check if the current page is a projects page in the frontend (loop, single, archive, category)
 *
 * @return bool
 */
function eopm_is_projects_page() {

	return apply_filters( 'eopm_is_projects_page', ( is_singular( Eonet_PM_Project::POST_TYPE )
		|| is_page(eopm_get_loop_page_id())
		|| is_post_type_archive( Eonet_PM_Project::POST_TYPE )
		|| is_category( Eonet_PM_Project::CATEGORY_SLUG )
	));

}

/**
 * Get project's progress percentage as a value
 * @param $type : date | tasks
 * @return int
 */
function eopm_get_project_progress_percentage($type) {

	/** @var $project Eonet_PM_Project */
	global $project;

	$percentage = 0;

	if($type == 'tasks') {
		// If we track the progress by tasks

		$tasks = $project->getTasksFromDB();

		if(!empty($tasks)) {

			$tasks_count = 0;
			$tasks_done = 0;

			foreach ($tasks as $post_id => $task) {

				$tasks_count++;
				$tasks_done = ($task->getIsDone()) ? $tasks_done + 1 : $tasks_done;

			}

			$percentage = (($tasks_done / $tasks_count) * 100);

		}

	} else {
		// If we track the progress by time

		$now = strtotime("now");
		$begin = strtotime($project->getStartingDateToString());
		$end = strtotime($project->getEndingDateToString());

		$percentage = ($end-$begin > 0) ? (($now-$begin) / ($end-$begin)) * 100 : 0;

	}

	/**
	 * We do some extra work on the percentage val
	 * So it looks nice
	 */
	if ($percentage < 0) {
		$percentage = 0;
	} elseif ($percentage > 100) {
		$percentage = 100;
	}

	return apply_filters( 'eopm_get_project_progress_percentage', floor($percentage), $type);

}

/**
 * Return an array containing the items (so the pages) of a single project nav
 *
 * @param Eonet_PM_Project $project
 *
 * @return array
 */
function eopm_project_nav_items( Eonet_PM_Project $project ) {

	return apply_filters( 'eopm_project_nav_items', array(
		'description' => !empty($project->post->post_content),
		'tasks' => $project->getTasksEnabled(),
		'comments' => comments_open($project->post->ID),
		'info' => apply_filters('eopm_single_project_show_section_info', false)
	));

}