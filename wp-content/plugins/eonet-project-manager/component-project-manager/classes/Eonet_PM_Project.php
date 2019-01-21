<?php

namespace ComponentProjectManager\classes;

use ComponentProjectManager\classes\Eonet_PM_TasksCollection;

if ( ! defined('ABSPATH') ) die('Forbidden');

class Eonet_PM_Project {

	/**
	 * @var \WP_Post The Custom Post type item
	 */
	public $post;

	/**
	 * @var Eonet_PM_ProjectPermission
	 */
	protected $permissions_instance = null;

	/**
	 * @var Eonet_PM_MembersCollection The array of the members of the project
	 */
	public $membersCollection;

	/**
	 * @var Eonet_PM_TasksCollection The array of the tasks of the project
	 */
	public $tasksCollection;

	/**
	 * @var \DateTime
	 */
	protected $starting_date = null;

	/**
	 * @var \DateTime
	 */
	protected $ending_date = null;

	/**
	 * @var string
	 */
	protected $progress_type = null;

	/**
	 * @var bool
	 */
	protected $tasks_enabled = null;

	/**
	 * @var string
	 */
	protected $visibility_permissions = null;

	/**
	 * @var string
	 */
	protected $editing_permissions = null;

	/**
	 * The name of the custom post type
	 */
	const POST_TYPE = 'eonet_project';
	
	const CATEGORY_SLUG = 'eonet_project_category';

	/**
	 * Eonet_PM_Project constructor.
	 *
	 * @param int|\WP_Post|null $post Optional. Post ID or post object. Defaults to global $post.
	 *
	 * @throws \Exception
	 */
	public function __construct($post = null) {

		$post = get_post($post);

		if(!$post instanceof \WP_Post)
			throw new \Exception('Impossible to create a new Project: post format is not valid');

		$this->post = $post;
		
		$this->membersCollection = new Eonet_PM_MembersCollection();
		$this->tasksCollection = new Eonet_PM_TasksCollection();

	}

	/**
	 * Return an instance of class Eonet_PM_ProjectPermission which handles the permissions check of the project instances
	 * 
	 * @return Eonet_PM_ProjectPermission
	 */
	public function permissions() {
		if(is_null($this->permissions_instance))
			$this->permissions_instance = new Eonet_PM_ProjectPermission( $this );

		return $this->permissions_instance;
	}

	/**
	 * @return array IDs of the members assigned to the project
	 */
	public function getMembersIDs() {
		return array_keys($this->getMembersFromDB());
	}
	
	/**
	 * Get the members of the project from the db and save them in the current object, so the quey will be executed only one time.
	 * This function have to be called before handled the members of the Project object, otherwise the object will not contains the members information
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function getMembersFromDB() {

		if( !$this->membersCollection->all() )
			$this->membersCollection->setMembers(get_post_meta( $this->post->ID , 'eonet-project-members', true ) );

		return $this->membersCollection->all();
		
	}

	/**
	 * Save the members value for the current project into the db, this will override the previous members informations
	 * into the db. If any members has been saved yet, it will be saved now.
	 * 
	 * @param null $members
	 *
	 * @return bool|int
	 */
	public function updateMembersIntoDB( $members = null ) {
		if(!is_null($members))
			$this->membersCollection->setMembers($members);

		$this->membersCollection->remove( $this->post->post_author);

		return update_post_meta( $this->post->ID, 'eonet-project-members', $this->membersCollection->all() );
	}

	/**
	 * Return the tasks assigned to this project
	 *
	 * @return Eonet_PM_Task[]
	 */
	public function getTasksFromDB() {

		$task_belongs_to_project = new Eonet_PM_TaskBelongsToProject(null, $this);

		$this->tasksCollection = new Eonet_PM_TasksCollection($task_belongs_to_project->getTasks());

		$this->tasksCollection->sortTasksByOrder();

		return $this->tasksCollection->all();
	}

	/**
	 * Return an array containing the ids of the tasks attached to this project
	 * 
	 * @return array
	 * @throws \Exception
	 */
	public function getTasksIDs() {
		$task_belongs_to_project = new Eonet_PM_TaskBelongsToProject(null, $this);

		return $task_belongs_to_project->getTasksID();
	}
	
	/**
	 * Save the information for the current project into the db, this will override the previous tasks information
	 * into the db. If any task has been saved yet, it will be saved now.
	 *
	 * @return bool|int
	 * @throws \Exception
	 * @internal param null $members
	 *
	 */
//	public function updateTasksIntoDB( ) {
//		foreach( $this->tasksCollection->all() as $task) {
//			$task_belongs_to_project = new Eonet_PM_TaskBelongsToProject($this, $task );
//
//			$task_belongs_to_project->saveRelationIntoDB();
//		}
//
//		return update_post_meta( $this->post->ID, 'eonet-project-members', $this->membersCollection->all() );
//	}

	/**
	 * @return \DateTime
	 */
	public function getStartingDate() {
		return $this->getDate('starting');
	}

	/**
	 * @param string $format
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function getStartingDateToString( $format = '') {
		return $this->getDateToString('starting', $format );
	}

	/**
	 * @param string|\DateTime $starting_date
	 * @param string $format
	 */
	public function setStartingDate( $starting_date, $format = '' ) {

		$this->setDate('starting', $starting_date, $format);
	}

	/**
	 * @param string|\DateTime $starting_date
	 * @param string $format
	 *
	 * @return bool|int
	 */
	public function updateStartingDateIntoDB( $starting_date, $format = '' ) {

		return $this->updateDateIntoDB('starting', $starting_date, $format);
	}

	/**
	 * @return \DateTime
	 */
	public function getEndingDate() {
		return $this->getDate('ending');
	}

	/**
	 * @param string $format
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function getEndingDateToString( $format = '' ) {
		return $this->getDateToString( 'ending', $format);
	}

	/**
	 * @param string|\DateTime $starting_date
	 * @param string $format
	 */
	public function setEndingDate( $starting_date, $format = '' ) {

		$this->setDate('ending', $starting_date, $format);
	}

	/**
	 * @param string|\DateTime $starting_date
	 * @param string $format
	 *
	 * @return bool|int
	 */
	public function updateEndingDateIntoDB( $starting_date, $format = '' ) {

		return $this->updateDateIntoDB('ending', $starting_date);
	}

	/**
	 * @return string
	 */
	public function getProgressType() {
		if( is_null( $this->progress_type ))
			$this->progress_type = get_post_meta( $this->post->ID , 'eo_pm_progress_type', true );

		return $this->progress_type;
	}

	/**
	 * @param $progress_type
	 *
	 * @throws \Exception
	 * @internal param bool $is_done
	 */
	public function setProgressType( $progress_type ) {

		if(!in_array($progress_type, array('nothing', 'date', 'tasks')))
			throw new \Exception("Impossible to set this progress type value: Progress type not valid");

		$this->progress_type = $progress_type;
	}

	/**
	 * @param null $progress_type
	 *
	 * @return bool|int
	 * @throws \Exception
	 */
	public function updateProgressTypeIntoDB( $progress_type = null ) {
		if(!is_null($progress_type))
			$this->setProgressType($progress_type);

		$value = $this->progress_type;

		return update_post_meta( $this->post->ID, 'eo_pm_progress_type', $value );
	}

	/**
	 * @return bool
	 */
	public function getTasksEnabled() {
		if( is_null( $this->tasks_enabled ))
			$this->tasks_enabled = get_post_meta( $this->post->ID , 'eo_pm_tasks_enabled', true );

		return $this->tasks_enabled;
	}

	/**
	 * @param $tasks_enabled
	 */
	public function setTasksEnabled( $tasks_enabled ) {
		$this->tasks_enabled = (bool)$tasks_enabled;
	}

	/**
	 * @param null|bool $tasks_enabled
	 *
	 * @return bool|int
	 */
	public function updateTasksEnabledIntoDB( $tasks_enabled = null ) {
		if(!is_null($tasks_enabled))
			$this->setTasksEnabled($tasks_enabled);

		$value = $this->tasks_enabled;

		return update_post_meta( $this->post->ID, 'eo_pm_tasks_enabled', $value );
	}

	/**
	 * @param bool $specific If true, it returns the specific values saved for this project, not the real permission
	 *
	 * @return string
	 */
	public function getVisibilityPermissions( $specific = false) {
		if( is_null( $this->visibility_permissions ))
			$this->visibility_permissions = get_post_meta( $this->post->ID , 'eo_pm_visibility_permissions', true );

		if(!$specific && (empty($this->visibility_permissions) || $this->visibility_permissions == 'default') ) {
			return eonet_get_option('pm_general_visibility_permissions', 'project-members');
		}

		return $this->visibility_permissions;
	}

	/**
	 * @param string $permissions
	 *
	 * @throws \Exception
	 */
	public function setVisibilityPermissions( $permissions ) {

		if(!in_array($permissions, array('default', 'project-members', 'everyone')))
			throw new \Exception("Impossible to set this visibility permission value: permission type is not valid");

		$this->visibility_permissions = $permissions;
	}

	/**
	 * @param null $permissions
	 *
	 * @return bool|int
	 * @throws \Exception
	 */
	public function updateVisibilityPermissionsIntoDB( $permissions = null ) {
		if(!is_null($permissions))
			$this->setVisibilityPermissions($permissions);

		$value = $this->visibility_permissions;

		return update_post_meta( $this->post->ID, 'eo_pm_visibility_permissions', $value );
	}

	/**
	 * @param bool $specific If true, it returns the specific values saved for this project, not the real permission
	 *
	 * @return string
	 */
	public function getEditingPermissions( $specific = false) {
		if( is_null( $this->editing_permissions ))
			$this->editing_permissions = get_post_meta( $this->post->ID , 'eo_pm_editing_permissions', true );

		if(!$specific && (empty($this->editing_permissions) || $this->editing_permissions == 'default')) {
			return eonet_get_option('pm_general_editing_permissions', 'author');
		}

		return $this->editing_permissions;
	}

	/**
	 * @param string $permissions
	 *
	 * @throws \Exception
	 */
	public function setEditingPermissions( $permissions ) {

		if(!in_array($permissions, array('default', 'author', 'project-members', 'everyone')))
			throw new \Exception("Impossible to set this editing permission value: permission type is not valid");

		$this->editing_permissions = $permissions;
	}

	/**
	 * @param null $permissions
	 *
	 * @return bool|int
	 * @throws \Exception
	 */
	public function updateEditingPermissionsIntoDB( $permissions = null ) {
		if(!is_null($permissions))
			$this->setEditingPermissions($permissions);

		$value = $this->editing_permissions;

		return update_post_meta( $this->post->ID, 'eo_pm_editing_permissions', $value );
	}

	/**
	 * Load all meta informations form the DB and set the fields of the current object
	 */
	public function loadAllMetaValues() {
		$meta = get_post_meta( $this->post->ID );

		$this->starting_date = ( isset( $meta['eo_pm_starting_date'] ) && !empty($meta['eo_pm_starting_date'][0]) ) ? new \DateTime($meta['eo_pm_starting_date'][0]) : null;
		$this->ending_date = ( isset( $meta['eo_pm_ending_date'] ) && !empty($meta['eo_pm_ending_date'][0]) ) ? new \DateTime($meta['eo_pm_ending_date'][0]) : null;
		$this->progress_type = ( isset( $meta['eo_pm_progress_type'] ) ) ? $meta['eo_pm_progress_type'][0] : null;
		$this->tasks_enabled = ( isset( $meta['eo_pm_tasks_enabled'] ) ) ? (bool)$meta['eo_pm_tasks_enabled'][0] : null;
		$this->visibility_permissions = ( isset( $meta['eo_pm_visibility_permissions'] ) ) ? $meta['eo_pm_visibility_permissions'][0] : null;
		$this->editing_permissions = ( isset( $meta['eo_pm_editing_permissions'] ) ) ? $meta['eo_pm_editing_permissions'][0] : null;
	}

	/**
	 * @param string $what accepted: "starting" or "ending"
	 *
	 * @return \DateTime
	 */
	protected function getDate($what) {
		$what .= '_date';

		if( is_null( $this->$what )) {
			$saved_data = get_post_meta( $this->post->ID , 'eo_pm_'.$what, true );
			if(!empty($saved_data))
				$this->$what = new \DateTime($saved_data);
		}

		return $this->$what;
	}

	/**
	 * @param $what
	 * @param string $format
	 *
	 * @return string
	 * @throws \Exception
	 */
	protected function getDateToString( $what, $format = '') {
		$date = $this->getDate($what);

		$field = $what . '_date';
		if(is_null($this->$field))
			return '';

		return $date->format( eopm_get_date_format($format) );
	}

	/**
	 * @param string $what accepted: "starting" or "ending"
	 * @param $date
	 * @param string $format
	 *
	 * @throws \Exception
	 * @internal param \DateTime|string $starting_date
	 */
	protected function setDate( $what, $date, $format = '' ) {

		$what .= '_date';

		if(!($date instanceof \DateTime) && !empty($date)) {
			$format = (empty($format)) ? 'datepicker' : $format;
			$date = \DateTime::createFromFormat( eopm_get_date_format( $format ), $date );
		}

		$this->$what = $date;
	}

	/**
	 * @param string $what accepted: "starting" or "ending"
	 * @param $date
	 * @param string $format
	 *
	 * @return bool|int
	 * @internal param \DateTime|string $starting_date
	 */
	protected function updateDateIntoDB( $what, $date, $format = '' ) {

		if(!is_null($date)) {
			$this->setDate($what, $date, $format);
		}

		$what .= '_date';

		$value = $this->$what->getTimestamp();

		return update_post_meta( $this->post->ID, 'eo_pm_'.$what, $value );
	}

}