<?php
use ComponentProjectManager\classes\Eonet_PM_Project;
use ComponentProjectManager\classes\Eonet_PM_TaskRendering;

/**
 * Render the project's members list
 *
 * @param null|array $members_ids If null: the basic members of the project
 * @param null|string $title If null: 'Project Members'
 *
 * @return string
 */
function eopm_project_members_list( $members_ids = null, $title = null) {

	if (is_null($members_ids)) {
		global $project;
		$members_ids = $project->getMembersIDs();
	}

	$html = '';
	if(empty($members_ids))
		return $html;

	if (is_null($title))
		$title = __('Project Members', 'eonet-project-manager');

	$html .= '<div class="eo-project-members-wrapper eo_single_project_header_section">';

	$html .= '<h4 class="eo-project-members-title">';
	$html .= $title;
	$html .= '</h4>';

	$html .= '<ul class="eo-project-members-list">';

	$max_display = apply_filters( 'eopm_max_members_to_display', 8);
	$count = 0;
	$number_of_members = count($members_ids);

	foreach ($members_ids as $id) {

		$count++;

		/**
		 * We display a max of 8 thumbnails:
		 */
		if ($count < $max_display) {
			$user_link = (function_exists('bp_core_get_user_domain')) ? bp_core_get_user_domain($id) : get_author_posts_url($id);
			$user = get_userdata($id);
			$html .= '<li class="eo-project-member eo_tooltip"><span class="eo_tooltip_text">'.$user->display_name.'</span><a href="'.$user_link.'">' . get_avatar($id, 50) . '</a></li>';
		}

	}

	if($number_of_members > $max_display) {

		$html .= '<li class="eo-project-member eo-project-member-more">+ ' . ($number_of_members - $max_display) . '</li>';

	}

	$html .= '</ul>';

	$html .= '</div>';

	return $html;

}

/**
 * Returns the project's navigation
 * @param $args : array(slug, title, icon)
 * @return string
 */
function eopm_get_project_nav_button($args) {

	$html = '';

	$html .= '<li class="eo-tab-nav-item">';
	$html .= '<a href="javascript:void(0);" id="eo-nav-trigger-'.$args['slug'].'" data-eo-slug="'.$args['slug'].'">';
	$html .= '<i class="'.$args['icon'].'"></i>' . $args['title'];
	$html .= '</a>';
	$html .= '</li>';

	return $html;

}

/**
 * Outputs the project's tasks as a list
 * @param $project \ComponentProjectManager\classes\Eonet_PM_Task
 */
function eopm_render_project_tasks_list($project = null) {

	echo eopm_get_html_project_tasks_list($project);

}

/**
 * Returns the project's tasks as a list
 *
 * @param null|Eonet_PM_Project $project
 * @return string
 */
function eopm_get_html_project_tasks_list($project = null) {

	if(is_null($project))
		global $project;

	//The "sortable" class is added only if the current user has the right permissions
	$sortable_class = ($project->permissions()->userCanEdit()) ? 'sortable' : '';

	echo '<div class="eopm-tasks-list ' . $sortable_class . '">';

	$tasks = $project->getTasksFromDB();

	foreach ($tasks as $post_id => $task):

		$task_layout = new Eonet_PM_TaskRendering($task);
		echo $task_layout->getFrontendLayout();

	endforeach;

	echo '</div>';

	return apply_filters( 'eopm_get_html_project_tasks_list', ob_get_clean(), $project);

}

/**
 * @param null|Eonet_PM_Project $project
 */
function eopm_render_new_task_button( $project = null ){

	if(is_null($project))
		global $project;

	if($project->permissions()->userCanCreateTask()) {

		echo Eonet_PM_TaskRendering::getCreatingLayout();

	}
}

/**
 * Output the content of the item in the projects single
 *
 * @param null|string $action
 */
function eopm_render_single_project_section( $action = null ) {

//		if(is_null($action))
//			$action = (isset($_GET['action'])) ? sanitize_text_field($_GET['action']) : '' ;

	switch($action) {

		default:
		case 'description':
			$path = 'single-project/description.php';
			break;
		case 'comments':
			$path = 'single-project/comments.php';
			break;
		case 'tasks':
			$path = 'single-project/tasks.php';
			break;
		case 'info':
			$path = 'single-project/info.php';
			break;

	}

	apply_filters( 'eopm_project_content_path', $path, $action);

	eonet_project_manager()->getTemplatePart( $path );

}