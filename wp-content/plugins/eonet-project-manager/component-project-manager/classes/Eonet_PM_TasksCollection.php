<?php

namespace ComponentProjectManager\classes;


if ( ! defined('ABSPATH') ) die('Forbidden');

/**
 * Class Eonet_PM_TasksCollection
 * 
 * A collection of tasks, it contains an array of tasks in this format:
 * array('POST_ID_1' => 'TASK_OBJECT_1', ' POST_ID_2' => 'TASK_OBJECT_2');
 * 
 * And the methods to work on it.
 * 
 * @package ComponentProjectManager\classes
 */
class Eonet_PM_TasksCollection {

	/**
	 * @var Eonet_PM_Task[]
	 *
	 * Example: array('POST_ID_1' => 'TASK_OBJECT_1', ' POST_ID_2' => 'TASK_OBJECT_2');
	 */
	protected $tasks = array();

	/**
	 * Eonet_PM_TasksCollection constructor.
	 *
	 * @param array $tasks
	 */
	public function __construct($tasks = array()) {
		foreach($tasks as $task) {
			if($task instanceof Eonet_PM_Task)
				$this->tasks[$task->post->ID] = $task;
		}
	}

	/**
	 * Return the array of tasks
	 * 
	 * @return Eonet_PM_Task[]
	 */
	public function all( ) {
		return $this->tasks;
	}

	/**
	 * Add a task to the collection
	 * 
	 * @param Eonet_PM_Task $task
	 *
	 * @throws \Exception
	 */
	public function addTask(Eonet_PM_Task $task){

		if(array_key_exists($task->post->ID, $this->tasks))
			throw new \Exception('Impossible to add this task to the collection, the task already present');

		$this->updateTask($task);

	}

	/**
	 * Update a task object specified by the id of the task (post)
	 * 
	 * @param Eonet_PM_Task $task
	 */
	public function updateTask(Eonet_PM_Task $task){

		$this->tasks[$task->post->ID] = $task;
		 
	}

	/**
	 * Get a task by Task|Post id
	 * 
	 * @param $id
	 *
	 * @return Eonet_PM_Task
	 */
	public function getTask($id) {
		return $member = (isset($this->tasks[$id])) ? $this->tasks[$id] : null;
	}

	/**
	 * Remove a task from the collection, selected by task|post id
	 *
	 * @param $id
	 *
	 * @return array
	 */
	public function remove($id) {
		if(array_key_exists($id, $this->tasks))
			unset($this->tasks[$id]);
		
		return $this->tasks;
	}

	/**
	 * Sort the tasks of the collection by the order number 
	 */
	public function sortTasksByOrder() {
		$this->tasks;

		foreach($this->tasks as &$task) {
			$task->getOrder();
		}

		usort($this->tasks, array($this, "_compareOrder"));
	}

	/**
	 * @param Eonet_PM_Task $a
	 * @param Eonet_PM_Task $b
	 *
	 * @return bool
	 */
	private function _compareOrder($a, $b){
		return ($a->getOrder() > $b->getOrder());
	}
}