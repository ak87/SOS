<?php defined('SYSPATH') or die('No direct script access.');

class Model_Msignin
{
	public function signin($email, $password, $remember_me)
	{
		
		$auth = Auth::instance();

		if ($remember_me == "TRUE")	{$remember_me = TRUE;} else {$remember_me = "";}

		$usertemp = ORM::factory('db_mdbusers', array('email'=>$email));
		//Проверка на сущестовавание юзера с таким e-mail
		if(!$usertemp->loaded())
		{
			$this->errors = "error_login_or_password";
			return FALSE;
		}
		$user_id = $usertemp->id;

		//Активация
		$usertemp = ORM::factory('db_mdbactivation', array('user_id'=>$user_id,'active_on'=>1));
		if(!$usertemp->loaded())
		{
			$this->errors = "error_activation_user";
			return FALSE;
		}

		//Пытаемся залогиниться
		if ($auth->login($email, $password, $remember_me))
		{
			return TRUE;
		}
		else
		{
			$this->errors = "error_login_or_password";
			return FALSE;
		}

	}

}
