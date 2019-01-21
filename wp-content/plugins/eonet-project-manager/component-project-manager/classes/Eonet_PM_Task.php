<?php

namespace ComponentProjectManager\classes;


if ( ! defined('ABSPATH') ) die('Forbidden');

/**
 * Class Eonet_PM_Task
 *
 * The Task object, it represents an instance of a task (which is a post, so a way to extend it)
 *
 * @package ComponentProjectManager\classes
 */
class Eonet_PM_Task {

	/**
	 * @var \WP_Post|array The real post task saved into the db
	 *
	 */
	public $post;

	/**
	 * @var Eonet_PM_TaskPermission
	 */
	protected $permission_instance = null;

	/**
	 * @var bool The task is completed or not
	 */
	protected $is_done = null;

	/**
	 * @var bool The task is an urgent task or not
	 */
	protected $is_urgent = null;

	/**
	 * @var \DateTime due date of the task
	 */
	protected $expiration = null;

	/**
	 * @var int[] array containing the ids of the members who the task is assigned
	 */
	protected $members_assigned;

	/**
	 * @var int The sorted order of the task into the project
	 */
	protected $order = 0;

	/**
	 * The name of the custom post type
	 */
	const POST_TYPE = 'eopm_task';

	/**
	 * Create a task instance (basically it extends a post object).
	 *
	 * @param \WP_Post|int The post object or the post id of a post (task) already created
	 *
	 * @throws \Exception
	 */
	public function __construct( $post = null ) {

		$post = get_post($post);

		if(!$post instanceof \WP_Post)
			throw new \Exception('Impossible to create a new Task: post format is not valid');

		$this->post = $post;

	}

	/**
	 * Return an instance of class Eonet_PM_ProjectPermission wich handle the permissions check of the project instances
	 *
	 * @return Eonet_PM_TaskPermission
	 */
	public function permissions() {
		if(is_null($this->permission_instance))
			$this->permission_instance = new Eonet_PM_TaskPermission( $this, $this->getProject() );

		return $this->permission_instance;
	}

	/**
	 *Return the ID fo the project connected to the task
	 *
	 * @return int
	 * @throws \Exception
	 */
	public function getProjectID() {
		$task_belongs_to_project = new Eonet_PM_TaskBelongsToProject($this);
		
		return $task_belongs_to_project->getProjectID();
	}

	/**
	 * Return an instance of the project connected to the task
	 *
	 * @return Eonet_PM_Project
	 * @throws \Exception
	 */
	public function getProject() {
		$projec_id = $this->getProjectID();

		return new Eonet_PM_Project($projec_id);
	}

	/**
	 * @return \DateTime
	 */
	public function getExpiration() {

		if( is_null( $this->expiration )) {
			$saved_data = get_post_meta( $this->post->ID , 'eonet-task-expiration', true );
			if(!empty($saved_data))
				$this->expiration = new \DateTime($saved_data);
		}


		return $this->expiration;
	}

	/**
	 * The formatted and printable due date
	 *
	 * @return string
	 */
	public function getExpirationToString( $format = ''){
		$expiration = $this->getExpiration();

		if(is_null($this->expiration))
			return '';

		return $expiration->format( eopm_get_date_format($format) );
	}

	/**
	 * @param string $expiration
	 */
	public function setExpiration(  $expiration = '', $format = '') {

		if(!($expiration instanceof \DateTime) && !empty($expiration)) {
			$format = (empty($format)) ? 'datepicker' : $format;
			$expiration = \DateTime::createFromFormat( eopm_get_date_format( $format ), $expiration );
		}


		$this->expiration = $expiration;
	}

	/**
	 * @param null $expiration
	 *
	 * @return bool|int
	 */
	public function updateExpirationIntoDB( $expiration = null, $format = '' ) {

		if(!is_null($expiration))
			$this->setExpiration($expiration, $format);

		$value = ($this->expiration instanceof \DateTime) ? $this->expiration->getTimestamp() : '';

		return update_post_meta( $this->post->ID, 'eonet-task-expiration', $value );
	}

	/**
	 * @return boolean
	 */
	public function getIsDone() {
		if( is_null( $this->is_done ))
			$this->is_done = get_post_meta( $this->post->ID , 'eonet-task-is-done', true );

		return $this->is_done;
	}

	/**
	 * @param boolean $is_done
	 */
	public function setIsDone( $is_done ) {
		//Prevent conflict with data retrived by js
		if($is_done == 'true')
			$is_done = true;
		else if($is_done == 'false')
			$is_done = false;

		$this->is_done = (bool) $is_done;
	}

	/**
	 * @param null|boolean $is_done
	 *
	 * @return bool|int
	 */
	public function updateIsDoneIntoDB( $is_done = null ) {
		if(!is_null($is_done))
			$this->setIsDone($is_done);

		$value = $this->is_done ? 1 : 0;

		return update_post_meta( $this->post->ID, 'eonet-task-is-done', $value );
	}

	/**
	 * @return boolean
	 */
	public function getIsUrgent() {
		if( is_null( $this->is_urgent ))
			$this->is_urgent = (bool) get_post_meta( $this->post->ID , 'eonet-task-is-urgent', true );

		return $this->is_urgent;
	}

	/**
	 * @param bool $is_urgent
	 */
	public function setIsUrgent( $is_urgent ) {
		$this->is_urgent = (bool)$is_urgent;
	}

	/**
	 * @param null|bool $is_urgent
	 *
	 * @return bool|int
	 */
	public function updateIsUrgentIntoDB( $is_urgent = null ) {
		if(!is_null($is_urgent))
			$this->setIsUrgent($is_urgent);

		$value = $this->is_urgent ? 1 : 0;

		return update_post_meta( $this->post->ID, 'eonet-task-is-urgent', $value );
	}

	//TODO Urgent change the name of this method
	/**
	 * Get the members of the task from the db and save them in the curent object, so the query will be executed only one time.
	 * This function have to be called before handled the members of the Task object, otherwise the object will not contains the members informations
	 *
	 * @return array
	 */
	public function getMembersAssigned() {
		if( empty( $this->members_assigned ))
			$this->members_assigned = get_post_meta( $this->post->ID , 'eonet-task-members-assigned', true );

		return $this->members_assigned;
	}

	/**
	 * @param array $members_assigned
	 *
	 * @throws \Exception
	 */
	public function setMembersAssigned( $members_assigned ) {
		if(!empty($members_assigned) && !array_filter($members_assigned, 'is_numeric'))
			throw new \Exception('Array of memeber IDs has a wrong format, the values are not all numeric');
		
		$this->members_assigned = $members_assigned;
	}

	/**
	 * @param null $members_assigned
	 *
	 * @return bool|int
	 * @throws \Exception
	 */
	public function updateMembersAssignedIntoDB( $members_assigned = null ) {
		if(!is_null($members_assigned))
			$this->setMembersAssigned($members_assigned);

		return update_post_meta( $this->post->ID, 'eonet-task-members-assigned', $this->members_assigned );
	}

	/**
	 * @return int
	 */
	public function getOrder() {
		if( empty( $this->order ))
			$this->order = get_post_meta( $this->post->ID , 'eonet-task-order', true );

		return $this->order;
	}

	/**
	 * @param int $order
	 */
	public function setOrder( $order ) {
		$this->order = (int)$order;
	}

	/**
	 * @param null|int $order
	 *
	 * @return bool|int
	 */
	public function updateOrderIntoDB( $order = null ) {
		if(!is_null($order))
			$this->setOrder($order);

		return update_post_meta( $this->post->ID, 'eonet-task-order', $this->order );
	}

	/**
	 * Load all meta values of the current post form the DB. If many meta values are used in the same page/functions,
	 * call this method at the start allows to reduce the number of the requests done to the DB
	 */
	public function loadAllMetaValues() {
		$meta = get_post_meta( $this->post->ID );

		$this->members_assigned = ( isset( $meta['eonet-task-members-assigned'] ) ) ? unserialize($meta['eonet-task-members-assigned'][0]) : new Eonet_PM_MembersCollection();
		$this->is_done = ( isset( $meta['eonet-task-is-done'] ) ) ? (bool)$meta['eonet-task-is-done'][0] : false;
		$this->is_urgent = ( isset( $meta['eonet-task-is-urgent'] ) ) ? (bool)$meta['eonet-task-is-urgent'][0] : false;
		$this->expiration = ( isset( $meta['eonet-task-expiration']) && !empty($meta['eonet-task-expiration'][0])) ? new \DateTime(date('Y-m-d', $meta['eonet-task-expiration'][0])) : null;
		$this->order = ( isset( $meta['eonet-task-order'] ) ) ? (int)$meta['eonet-task-order'][0] : 0;

	}

	/**
	 * Receive all the new meta values for the task as an associative array and save them
	 *
	 * Keys of the array: [members, is_done, is_urgent, expiration, order]
	 *
	 * @param $values
	 *
	 * @throws \Exception
	 */
	public function updateAllMetaIntoDB( $values ) {
		
		if ( ! is_array($values))
			throw new \Exception('The passed parameter have to be an array');
		
		if(isset($values['members'])) {
			
			$members = $values['members'];
			
			if( is_string($values['members']) ) {
				$members = str_replace('[', '', $members);
				$members = str_replace(']', '', $members);
				$members = (empty($members)) ? array() : explode(',', $members);
			}

			$this->updateMembersAssignedIntoDB($members);
		}

		if(isset($values['is_done'])) {
			$this->updateIsDoneIntoDB($values['is_done']);
		}

		if(isset($values['is_urgent'])) {
			$this->updateIsUrgentIntoDB($values['is_urgent']);
		}

		if(isset($values['expiration'])) {
			$this->updateExpirationIntoDB($values['expiration']);
		}

		if(isset($values['order'])) {
			$this->updateOrderIntoDB($values['order']);
		}

	}

	/**
	 * Create a new task (so a new post) into the database and connect it to the given project
	 *
	 * @param array $args Valid args to create a new post https://developer.wordpress.org/reference/functions/wp_insert_post/
	 * @param Eonet_PM_Project $project The project connected to the task
	 *
	 * @return Eonet_PM_Task
	 * @throws \Exception
	 */
	public static function createNewTask($args, Eonet_PM_Project $project) {

		$args['ID'] = 0;
		$args['post_status'] = apply_filters('eopm_new_task_post_status','publish', $args, $project);
		$args['post_type'] = static::POST_TYPE;

		$new_id = wp_insert_post($args);

		if($new_id instanceof \WP_Error)
			throw new \Exception('Impossible to create this new task: the post arguments are not valid');
		
		$task = new Eonet_PM_Task(get_post($new_id));
		
		$task_belongs_to_project = new Eonet_PM_TaskBelongsToProject($task, $project);
		
		if($task_belongs_to_project->saveRelationIntoDB() == false){
			throw new \Exception('Impossible to save a relation between this task and this project');
		}

		do_action('eopm_new_task_created', $task->post->ID, $project->post->ID);

		return $task;

	}

	/**
	 * Delete the post of the current Task instance from the DB
	 *
	 * @throws \Exception
	 */
	public function deletefromDB() {
		$task_belong_to_project = new Eonet_PM_TaskBelongsToProject($this);

		$project_id = $task_belong_to_project->getProjectID();

		$task_to_remove = new Eonet_PM_TaskBelongsToProject($this, new Eonet_PM_Project(get_post($project_id)));
		$task_to_remove->removeRelationFromDB();

		return wp_delete_post($this->post->ID);
	}

}