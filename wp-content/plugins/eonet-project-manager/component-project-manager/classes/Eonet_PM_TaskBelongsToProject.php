<?php

namespace ComponentProjectManager\classes;

if ( ! defined('ABSPATH') ) die('Forbidden');

/**
 * Class Eonet_PM_TaskBelongsToProject
 *
 * Handle the connection between Tasks and Projects into the database
 *
 * @package ComponentProjectManager\classes
 */
class Eonet_PM_TaskBelongsToProject {

	/**
	 * @var Eonet_PM_Task
	 */
	protected $task;

	/**
	 * @var Eonet_PM_Project
	 */
	protected $project;

	/**
	 * Eonet_PM_TaskBelongsToProject constructor.
	 *
	 * @param Eonet_PM_Task|null $task
	 * @param Eonet_PM_Project|null $project
	 */
	public function __construct(Eonet_PM_Task $task = null, Eonet_PM_Project $project = null) {
		$this->task = $task;
		$this->project = $project;
	}

	/**
	 * If both Project and task are given, it save the connection in the Database
	 *
	 * @return bool|int
	 * @throws \Exception
	 */
	public function saveRelationIntoDB(){

		if(empty($this->task))
			throw new \Exception("Impossible to create connection between Task and Project: Task didn't provided");

		if(empty($this->project))
			throw new \Exception("Impossible to create connection between Task and Project: Project didn't provided");

		return add_post_meta( $this->project->post->ID, 'eonet-project-tasks-id', $this->task->post->ID );
	}

	/**
	 * If both Project and Task are given, it remove the connection from the database
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function removeRelationFromDB(){

		if(empty($this->task))
			throw new \Exception("Impossible to remove connection between Task and Project: Task didn't provided");

		if(empty($this->project))
			throw new \Exception("Impossible to remove connection between Task and Project: Project didn't provided");

		return delete_post_meta( $this->project->post->ID, 'eonet-project-tasks-id', $this->task->post->ID );
	}

	/**
	 * If the instance contains a Task, it return the id of the project connected to the task
	 *
	 * @return int The project id connected to the task
	 * @throws \Exception
	 */
	public function getProjectID() {
		global $wpdb;

		if(is_null($this->task))
			throw new \Exception("Impossible to get projects of this task: Task didn't provided");

		$results = $wpdb->get_results( "select post_id, meta_key from $wpdb->postmeta where meta_key = 'eonet-project-tasks-id' AND meta_value = ".$this->task->post->ID, ARRAY_A );

		if(!isset($results[0]['post_id']))
			throw new \Exception('Impossible to get the project id of this task');

		return $results[0]['post_id'];
	}

	/**
	 * If  the instance contains a Project, it return an array containing the tasks assigned to the project
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function getTasks() {

		$tasks_ids = $this->getTasksID();

		if(empty($tasks_ids))
			return array();

		$tasks_collection = new Eonet_PM_TasksCollection();


		foreach($tasks_ids as $id) {
			$task_post = get_post($id);

			//This check has solved an unknown issue in past
			if(!$task_post instanceof \WP_Post)
				continue;

			$task = new Eonet_PM_Task( $task_post );

			if($task->post->post_status == 'publish')
				$tasks_collection->addTask($task);
		}

		$tasks_collection->sortTasksByOrder();

		return $tasks_collection->all();
	}

	/**
	 * @return array
	 * @throws \Exception
	 */
	public function getTasksID() {
		if(empty($this->project))
			throw new \Exception("Impossible to get Tasks IDs: Project didn't provided");

		return $tasks_ids = get_post_meta( $this->project->post->ID, 'eonet-project-tasks-id' );
	}
}