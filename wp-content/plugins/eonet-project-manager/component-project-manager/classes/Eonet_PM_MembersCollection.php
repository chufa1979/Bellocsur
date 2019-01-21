<?php

namespace ComponentProjectManager\classes;


if ( ! defined('ABSPATH') ) die('Forbidden');

class Eonet_PM_MembersCollection {

	/**
	 * @var array Array of the members and them roles in the project
	 *
	 * Example: array('MEMBED_ID_1' => 'MEMBER_OBJECT', ' MEMBER_ID_2' => 'MEMBER_OBJECT');
	 */
	protected $members = array();

	/**
	 * Eonet_PM_MembersCollection constructor.
	 *
	 * @param null $members
	 */
	public function __construct($members = array()) {
		$this->setMembers($members);
	}

	/**
	 * Return all the members of the collection.
	 * 
	 * If the simplify flag is active, it will return a result like this:
	 * array('MEMBED_ID_1' => 'MEMBER_ROLE', ' MEMBER_ID_2' => 'MEMBER_ROLE');
	 *
	 * Otherwise like this:
	 * array('MEMBED_ID_1' => 'MEMBER_OBJECT', ' MEMBER_ID_2' => 'MEMBER_OBJECT');
	 *
	 * @param bool $simplify
	 *
	 * @return array
	 */
	public function all( $simplify = true) {

		$members = $this->members;

		if($simplify)
			foreach($this->members as $member)
				$members[$member->id] = $member->role();

		return $members;
	}

	/**
	 * Add a member to the collection
	 *
	 * @param $id
	 * @param null $role Optional. If it is not specified, it will be added as a standard member
	 *
	 * @throws \Exception
	 */
	public function addMember($id, $role = null){

		if(array_key_exists($id, $this->members))
			throw new \Exception('Impossible to add a member with this id to the collection, member aleady present');

		$this->updateMember($id, $role);

	}

	/**
	 * Update the role of a member specified by id, if the member doesn't exist, it wil be created.
	 *
	 * @param $id
	 * @param null $role Optional. If it is not specified, it will be added as a standard member
	 */
	public function updateMember($id, $role = null){

		$member = new Eonet_PM_Member($id, $role);

		$this->members[$id] = $member;

	}


	/**
	 * Get a member of the collection by User ID
	 *
	 * @param $id
	 *
	 * @return mixed|null
	 */
	public function getMember($id) {
		return $member = (isset($this->members[$id])) ? $this->members[$id] : null;
	}


	/**
	 * Remove a member from the collection by the id
	 *
	 * @param $id
	 */
	public function remove($id) {
		if(array_key_exists($id, $this->members))
			unset($this->members[$id]);
	}

	/**
	 * Update the whole collections
	 *
	 * @param array $members If is passed an empty array, the collection will be empty
	 *
	 * @throws \Exception
	 */
	public function setMembers( $members = array() ) {

		if(!is_array($members) && !empty($members))
			throw new \Exception('Members format not valid');

		$this->members = array();

		if(empty($members))
			return;

		foreach($members as $id => $role) {
			$this->addMember($id, $role);
		}
	}

}