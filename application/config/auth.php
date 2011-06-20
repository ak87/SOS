<?php defined('SYSPATH') or die('No direct access allowed.');

return array(

	'driver'       => 'ORM',
	'hash_method'  => 'sha256',
	'hash_key'     => "23, 34, 43, 654, 8452, 234, 269, 638, 23",
	'lifetime'     => 1209600,
	'session_key'  => 'auth_user',

	// Username/password combinations for the Auth File driver
	'users' => array(
		// 'kfc@rol.ru' => '18dd304b3014c0c89af1449d06916c79d0d64414ee91adb80a961be2ef8df6d4',
	),

);
