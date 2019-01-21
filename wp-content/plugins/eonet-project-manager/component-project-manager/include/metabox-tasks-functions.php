<?php

use ComponentProjectManager\classes\Eonet_PM_Project;
use ComponentProjectManager\classes\Eonet_PM_Task;
use ComponentProjectManager\classes\Eonet_PM_TaskBelongsToProject;
use ComponentProjectManager\classes\Eonet_PM_TaskRendering;

use Eonet\Core\EonetOptions;

/**
 * Add the metaboxes that handle the tasks
 */
function eopm_add_metaboxes_tasks() {
	add_meta_box(
        'eonet_project_tasks',
        _x( 'Manage Tasks', 'project admin edit screen', 'eonet-project-manager' ),
        'eopm_render_tasks_metabox',
        'eonet_project',
        'normal',
        'core'
    );
}
add_action( 'add_meta_boxes', 'eopm_add_metaboxes_tasks' );

/**
 * @param $post
 *
 * @throws Exception
 */
function eopm_render_tasks_metabox($post) {

		$project = new Eonet_PM_Project($post);

		$tasks_assigned = $project->getTasksFromDB();

		?>
		
		<div id="eopm-tasks-metabox">

			<?php foreach ($tasks_assigned as $task) :  ?>

                <?php
                /**
                 * We render the layout of each task
                 */
                $task->loadAllMetaValues();
                $new_task = new Eonet_PM_TaskRendering($task);
                echo $new_task->getBackendLayout();
                //echo $new_task->getFrontendLayout();
                ?>

            <?php endforeach; ?>

		</div>

		<button id="submit-new-task" name="submit-new-task" class="eo_btn eo_btn_default">
            <i class="ion-ios-plus-outline"></i>
            <?php esc_html_e('Add Task', 'eonet-project-manager'); ?>
        </button>

		<?php
	}

/**
 * Handle the action on members already present in the project
 *
 * @param int $post_id
 *
 * @throws Exception
 */
function eonet_project_manager_update_tasks_assigned( $post_id ) {

	//TODO: add nounce
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );

	if ( $is_autosave || $is_revision ) {
		return;
	}

    // Checks for input and sanitizes/saves if needed
	//if( !isset( $_POST[ 'eonet-project-new-members-ids' ] ) || !is_string($_POST[ 'eonet-project-new-members-ids' ]) ) {
	if ( ! isset( $_POST['eo_field_tasks_assigned'] ) ) {
		return;
	}

	$tasks_assigned = $_POST['eo_field_tasks_assigned'];

	$current_project = new Eonet_PM_Project(get_post($post_id));

	$tasks_existing = array();
	$order = 0;
	foreach ($tasks_assigned as $task_id => $task) {

        /**
         * Do we create a new one or do we update it?
         */
		if(isset($task['id']) && is_numeric($task_id) ) {

			$new_task = new Eonet_PM_Task( get_post($task_id) );

			//$new_task->post->post_title = sanitize_title($task['title']);
			//$new_task->post->post_content = sanitize_text_field($task['content']);

			$new_post = array(
				'ID' => $new_task->post->ID,
				'post_title' => sanitize_text_field($task['title']),
				'post_content' => sanitize_text_field($task['content'])
			);

			$post_update_result = wp_update_post($new_post);

			if($post_update_result instanceof WP_Error) {
				//var_dump($post_update_result);
				throw new Exception('Impossible to update the task information: unknown error');
			}


		} else {

			//save the id into an array
			if(empty($task['title']))
				continue;

			$new_post = array(
				'post_title' => sanitize_text_field($task['title']),
				'post_content' => sanitize_text_field($task['content'])
			);

			$new_task = Eonet_PM_Task::createNewTask($new_post, $current_project );

		}

		$meta_values = array(
			'members' => $task['members'],
			'is_done' => ($task['done'] == '1' || $task['done'] == 'true'),
			'is_urgent' => ($task['urgent'] == '1'),
			'expiration' => $task['expiration'],
			'order' => $order++
		);

		$new_task->updateAllMetaIntoDB( $meta_values );

		//$task_layout = new Eonet_PM_TaskRendering($new_task);

		array_push($tasks_existing, $new_task->post->ID);

	}

	//Check if there is some id missing respect the old array, in that case remove the task

	$task_belong_to_project = new Eonet_PM_TaskBelongsToProject(null, $current_project);
	$tasks_to_remove = array_diff($task_belong_to_project->getTasksID(), $tasks_existing);

	foreach($tasks_to_remove as $task_id) {

		$task = new Eonet_PM_Task(get_post($task_id));
		$task->deletefromDB();
	}


}
add_action( 'save_post_'.Eonet_PM_Project::POST_TYPE, 'eonet_project_manager_update_tasks_assigned' );