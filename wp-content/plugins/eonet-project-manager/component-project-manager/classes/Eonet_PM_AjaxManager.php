<?php

namespace ComponentProjectManager\classes;


if ( ! defined('ABSPATH') ) die('Forbidden');

class Eonet_PM_AjaxManager {

	public function __construct() {
		add_action('wp_ajax_eo_create_new_task_by_frontend', array($this, 'create_new_task_by_frontend'));
		add_action('wp_ajax_nopriv_eo_create_new_task_by_frontend', array($this, 'create_new_task_by_frontend'));

		add_action('wp_ajax_eo_edit_task_by_frontend', array($this, 'edit_task_by_frontend'));
		add_action('wp_ajax_nopriv_eo_edit_task_by_frontend', array($this, 'edit_task_by_frontend'));

		add_action('wp_ajax_eo_delete_task_by_frontend', array($this, 'delete_task_by_frontend'));
		add_action('wp_ajax_nopriv_eo_delete_task_by_frontend', array($this, 'delete_task_by_frontend'));

		add_action('wp_ajax_eo_change_task_status_by_frontend', array($this, 'change_task_status_by_frontend'));
		add_action('wp_ajax_nopriv_eo_change_task_status_by_frontend', array($this, 'change_task_status_by_frontend'));

		add_action('wp_ajax_eo_sort_tasks_by_frontend', array($this, 'sort_tasks_by_frontend'));
		add_action('wp_ajax_nopriv_eo_sort_tasks_by_frontend', array($this, 'sort_tasks_by_frontend'));
	}

	/**
	 * @throws \Exception
	 */
	public function create_new_task_by_frontend(){

		$project = $this->validateProject();

		$defaults = array(
			'task_title' => '',
			'task_description' => '',
			'task_done' => false,
			'task_urgent' => false,
			'task_expiration' => '',
			'task_members' => '[]'
		);
		$task_data = wp_parse_args( $_POST, $defaults );


		if(empty($task_data['task_title'])) {
			echo - 2;
			wp_die();
		}


		$new_post = array(
			'post_title' => sanitize_text_field($task_data['task_title']),
			'post_content' => sanitize_text_field($task_data['task_description'])
		);

		$new_task = Eonet_PM_Task::createNewTask($new_post, $project );

		$meta_values = array(
			'members' => $task_data['task_members'],
			'is_done' => ($task_data['task_done'] == 'true'),
			'is_urgent' => ($task_data['task_urgent'] == 'true'),
			'expiration' => $task_data['task_expiration'],
			'order' => count($project->getTasksIDs())
		);

		$new_task->updateAllMetaIntoDB( $meta_values );

		$task_layout = new Eonet_PM_TaskRendering($new_task);
		
		echo json_encode(array(
			'task_id' => $new_task->post->ID,
			'task_template' => $task_layout->getFrontendLayout()

		));

		wp_die();

	}

	/**
	 * @throws \Exception
	 */
	public function edit_task_by_frontend(){

		$defaults = array(
			'task_id' => 0,
			'task_title' => '',
			'task_description' => '',
			'task_done' => false,
			'task_urgent' => false,
			'task_expiration' => '',
			'task_members' => '[]',
		);
		$task_data = wp_parse_args( $_POST, $defaults );

		if(empty($task_data['task_id'])) {
			echo -2;
			wp_die();
		}

		if(empty($task_data['task_title'])) {
			echo -3;
			wp_die();
		}

		$post_task_data = array(
			'ID' => $task_data['task_id'],
			'post_title' => sanitize_text_field($task_data['task_title']),
			'post_content' => sanitize_text_field($task_data['task_description'])
		);

		wp_update_post($post_task_data);
		

		$meta_values = array(
			'members' => $task_data['task_members'],
			'is_done' => ($task_data['task_done'] == 'true'),
			'is_urgent' => ($task_data['task_urgent'] == 'true'),
			'expiration' => $task_data['task_expiration'],
		);

		$task = new Eonet_PM_Task( get_post( $task_data['task_id'] ) );
		$task->updateAllMetaIntoDB( $meta_values );

		$task_layout = new Eonet_PM_TaskRendering($task);

		echo json_encode(array(
			'task_id' => $task->post->ID,
			'task_template' => $task_layout->getFrontendLayout()

		));

		wp_die();

	}

	/**
	 * @throws \Exception
	 */
	public function change_task_status_by_frontend(){

		$defaults = array(
			'task_id' => 0,
			'completed' => null,
		);
		$task_data = wp_parse_args( $_POST, $defaults );

		if(empty($task_data['task_id'])) {
			echo -2;
			wp_die();
		}

		if(is_null($task_data['completed'])) {
			echo -3;
			wp_die();
		}

		$task = new Eonet_PM_Task( get_post( $task_data['task_id'] ) );

		$task->updateIsDoneIntoDB($task_data['completed']);

		$task_layout = new Eonet_PM_TaskRendering($task);

		echo json_encode(array(
			'task_id' => $task->post->ID,
			'task_template' => $task_layout->getFrontendLayout()

		));

		wp_die();

	}

	/**
	 * @throws \Exception
	 */
	public function delete_task_by_frontend(){
		
		$defaults = array(
			'task_id' => 0,
		);
		$task_data = wp_parse_args( $_POST, $defaults );

		if(empty($task_data['task_id'])) {
			echo -2;
			wp_die();
		}
		
		$task = new Eonet_PM_Task( get_post($task_data['task_id']) );
		
		$task->deletefromDB();

		echo json_encode(array(
			'success' => true,
		));

		wp_die();

	}
	
	/**
	 * Update the order of the task into the databse once the tasks have been sorted on frontend
	 */
	public function sort_tasks_by_frontend() {

		$this->validateProject();

		if ( ! isset( $_POST['tasks'] ) || ! is_array( $_POST['tasks'] ) ) {
			echo -2;

			wp_die();
		}

		foreach( $_POST['tasks'] as $task_data ) {

			$task = new Eonet_PM_Task(get_post($task_data['task_id']));
			$task->updateOrderIntoDB($task_data['new_position']);
		}

		wp_die();
	}

	/**
	 * Validate the project id present in $_POST['project_id'].
	 *
	 * return 0 if itsn't set or it's empty
	 * return -1 if the id doesn't belong to a project post type
	 *
	 * @return Eonet_PM_Project
	 */
	protected function validateProject( ) {
		if ( ! isset( $_POST['project_id'] ) || ! is_numeric( $_POST['project_id'] ) ) {
			echo 0;

			wp_die();
		}

		$post = get_post( $_POST['project_id'] );

		if ( $post->post_type != Eonet_PM_Project::POST_TYPE ) {
			echo - 1;

			wp_die();
		}

		return new Eonet_PM_Project($post);
	}
}

new Eonet_PM_AjaxManager();
