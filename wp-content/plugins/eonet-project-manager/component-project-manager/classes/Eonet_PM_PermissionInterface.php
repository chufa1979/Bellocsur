<?php

namespace ComponentProjectManager\classes;


if ( ! defined('ABSPATH') ) die('Forbidden');

interface Eonet_PM_PermissionInterface {

	//public static function userCanCreate( $user_id = null);

	public function userCanDisplay( $user_id = null);

	public function userCanEdit( $user_id = null);

	public function userCanDelete( $user_id = null);
}