<?php defined('SYSPATH') or die('No direct access allowed.');

return array(

	'driver'       => 'ORM',
	'hash_method'  => 'sha256',
	'hash_key'     => "3, 7, 10, 11, 15, 19, 23, 25, 32, 36",
	'lifetime'     => 1209600,
	'session_key'  => 'auth_user',

	// Username/password combinations for the Auth File driver
	'users' => array(),

);
