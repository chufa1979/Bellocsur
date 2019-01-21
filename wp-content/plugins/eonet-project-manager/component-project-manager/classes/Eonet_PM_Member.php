<?php

namespace ComponentProjectManager\classes;


if ( ! defined('ABSPATH') ) die('Forbidden');

class Eonet_PM_Member {

	/**
	 * @var int The id of the memebr
	 *
	 */
	public $id = 0;

	/**
	 * @var
	 */
	protected $role;

	/**
	 * The label for administrator status
	 */
	const ROLE_ADMIN_ID = 'admin';

	/**
	 * The label for editor status
	 */
	//const EDITOR = 'editor';

	/**
	 * The label for simple member status
	 */
	const ROLE_MEMBER_ID = 'member';

	/**
	 * Eonet_PM_MembersCollection constructor.
	 *
	 * @param null $members
	 */
	public function __construct($id, $role = null ) {
		if(is_null($role))
			$role = static::ROLE_MEMBER_ID;

		$this->id = $id;
		$this->setRole($role);
	}


	/**
	 * @return mixed
	 */
	public function role() {
		return $this->role;
	}

	/**
	 * @param mixed $role
	 */
	public function setRole( $new_role ) {

		if(!in_array($new_role, Eonet_PM_Member::getMemberRolesAvailables()))
			throw new \Exception('Impossible to edit member role: role not allowed');
		
		$this->role = $new_role;
	}

	/**
	 * Return an aray of all member statuses available for projects
	 *
	 * @return array
	 */
	public static function getMemberRolesAvailables() {
		return array(
			static::ROLE_ADMIN_ID,
			static::ROLE_MEMBER_ID
		);
	}
}