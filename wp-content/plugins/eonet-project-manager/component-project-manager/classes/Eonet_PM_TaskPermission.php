<?php

namespace ComponentProjectManager\classes;

if ( ! defined('ABSPATH') ) die('Forbidden');

/**
 * Class Eonet_PM_ProjectPermission
 *
 * Handle the permissions checks of the task instances
 *
 * @package ComponentProjectManager\classes
 */
class Eonet_PM_TaskPermission implements Eonet_PM_PermissionInterface{

	/**
	 * @var Eonet_PM_Task
	 */
	protected $task;

	/**
	 * @var Eonet_PM_Project
	 */
	protected $project;

	/**
	 * @var int
	 */
	protected $user_id;

	/**
	 * Eonet_PM_TaskPermission constructor.
	 *
	 * @param Eonet_PM_Task $task
	 * @param Eonet_PM_Project $project
	 */
	public function __construct( Eonet_PM_Task $task, Eonet_PM_Project $project) {
		$this->task = $task;
		$this->project = $project;

		$this->user_id = get_current_user_id();
	}

	/**
	 * Check if the user (passed by parameter or the current one) is allowed to create a new task for this project
	 *
	 * @param null $user_id
	 * @param Eonet_PM_Project $project
	 *
	 * @return bool
	 */
	public static function userCanCreate( $user_id = null, Eonet_PM_Project $project ){
		
		$user_id = (is_null($user_id)) ? get_current_user_id() : $user_id;

		if(user_can($user_id, 'manage_options'))
			return true;

		$task_creation_permission = eonet_get_option('pm_general_create_tasks_permissions', 'author');

		if($task_creation_permission == 'everyone' )
			return true;

		if($task_creation_permission == 'project-members' && in_array($user_id, $project->getMembersIDs()) )
			return true;

		if($task_creation_permission == 'author' && $user_id == $project->post->post_author )
			return true;

		return false;
		
	}

	public function userCanDisplay( $user_id = null ){
		return true;
	}
	
	/**
	 * It check if the user (passed by parameter orthe current one) is allowed to edit the task
	 *
	 * @param null|int $user_id If null, the current user_id will be used
	 *
	 * @return bool
	 */
	public function userCanEdit( $user_id = null ) {

		$user_id = (is_null($user_id)) ? $this->user_id : $user_id;

		//Check if the user is an admin or is the author
		return (user_can($user_id, 'manage_options') || $user_id == $this->task->post->post_author);

	}

	/**
	 * Check if the user (passed by parameter or the current one) is allowed to delete the task
	 *
	 * @param null $user_id
	 *
	 * @return bool
	 */
	public function userCanDelete( $user_id = null ) {

		$user_id = (is_null($user_id)) ? $this->user_id : $user_id;

		//Check if the user is an admin or is the author
		return (user_can($user_id, 'manage_options') || $user_id == $this->task->post->post_author);

	}

	/**
	 * Check if the user (passed by parameter orthe current one) is allowed to edit the instance of the project
	 *
	 * @param null|int $user_id If null, the current user_id will be used
	 *
	 * @return bool
	 */
	public function userCanCheck( $user_id = null ) {

		$user_id = (is_null($user_id)) ? $this->user_id : $user_id;

		if(user_can($user_id, 'manage_options'))
			return true;


		$task_check_permission = eonet_get_option('pm_general_check_tasks_permissions', 'author');


		//Assume that the visibility permissions are only "Everyone" and "Members"
		if( $task_check_permission == 'everyone')
			return true;

		//If tasks can be checked by task members, but there ae not memebrs for this task, then all members of the project can check it
		if($task_check_permission == 'task-members') {
			if(in_array($user_id, $this->task->getMembersAssigned()))
				return true;

			if(!$this->task->getMembersAssigned() && in_array($user_id, $this->project->getMembersIDs()))
				return true;
		}

		if($task_check_permission == 'project-members' && in_array($user_id, $this->project->getMembersIDs()) )
			return true;

		if($task_check_permission == 'author' && $user_id == $this->task->post->post_author )
			return true;

		return false;

	}
}