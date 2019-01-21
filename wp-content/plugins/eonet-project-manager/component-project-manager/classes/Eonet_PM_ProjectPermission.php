<?php

namespace ComponentProjectManager\classes;


if ( ! defined('ABSPATH') ) die('Forbidden');

/**
 * Class Eonet_PM_ProjectPermission
 *
 * Handle the permissions checks of the project instances
 *
 * @package ComponentProjectManager\classes
 */
class Eonet_PM_ProjectPermission implements Eonet_PM_PermissionInterface{

	/**
	 * @var Eonet_PM_Project
	 */
	protected $project = null;

	/**
	 * @var int
	 */
	protected $user_id;
	//TODO Save the values in a cache variable before return them
	/**
	 * @var bool
	 */
	//protected $is_visible = null;

	/**
	 * @var bool
	 */
	//protected $is_editable = null;

	/**
	 * @var bool
	 */
	//protected $tasks_chekable = null;

	/**
	 * Eonet_PM_ProjectPermission constructor.
	 *
	 * @param Eonet_PM_Project $project
	 */
	public function __construct( Eonet_PM_Project $project) {
		$this->project = $project;

		$this->user_id = get_current_user_id();
	}

	/**
	 * Check if the user (passed by parameter or the current one) is allowed to create a new project
	 *
	 * @param null $user_id
	 *
	 * @return bool
	 */
	public static function userCanCreate( $user_id = null ) {
		
		$user_id = (is_null($user_id)) ? get_current_user_id() : $user_id;

		//By default, authors or editors can create new projects
		return (user_can($user_id, 'publish_posts'));

	}
	
	/**
	 * Check if the user (passed by parameter or the current one) is allowed to see the instance of the project
	 *
	 * @param null|int $user_id If null, the current user_id will be used
	 *
	 * @return bool
	 */
	public function userCanDisplay( $user_id = null ) {

		$user_id = (is_null($user_id)) ? $this->user_id : $user_id;

		$permission = false;

		if(user_can($user_id, 'manage_options'))
			$permission = true;

		//Assume that the visibility permissions are only "Everyone" and "Members"
		else if( $this->project->getVisibilityPermissions() == 'everyone' || in_array($user_id, $this->project->getMembersIDs()) )
			$permission = true;

		return $permission;

	}

	/**
	 * Check if the user (passed by parameter or the current one) is allowed to edit the instance of the project
	 *
	 * @param null|int $user_id If null, the current user_id will be used
	 *
	 * @return bool
	 */
	public function userCanEdit( $user_id = null ) {

		$user_id = (is_null($user_id)) ? $this->user_id : $user_id;

		if(user_can($user_id, 'manage_options'))
			return true;

		if( $this->project->getEditingPermissions() == 'everyone')
			return true;

		if($this->project->getEditingPermissions() == 'project-members' && in_array($user_id, $this->project->getMembersIDs()) )
			return true;

		if($this->project->getEditingPermissions() == 'author' && $user_id == $this->project->post->post_author )
			return true;

		return false;

	}

	/**
	 * Check if the user (passed by parameter or the current one) is allowed to delete the project
	 *
	 * @param null $user_id
	 *
	 * @return bool
	 */
	public function userCanDelete( $user_id = null ) {

		$user_id = (is_null($user_id)) ? $this->user_id : $user_id;

		//Check if the user is an admin or is the author
		return (user_can($user_id, 'manage_options') || $user_id == $this->project->post->post_author);

	}

	/**
	 * Check if the user (passed by parameter or the current one) is allowed to create new tasks
	 *
	 * @param null $user_id
	 *
	 * @return bool
	 */
	public function userCanCreateTask( $user_id = null ) {

		$user_id = (is_null($user_id)) ? $this->user_id : $user_id;

		return Eonet_PM_TaskPermission::userCanCreate($user_id, $this->project);
	}
	
}