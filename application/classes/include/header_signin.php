<?php defined('SYSPATH') or die('No direct script access.');
			if (isset($_POST['submit_signin']))
			{
				$auth = Auth::instance();
				$email = Arr::get($_POST, 'email', '');
				$password = Arr::get($_POST, 'password', '');
				$remember_me = Arr::get($_POST, 'remember_me', '');
				if ($remember_me == "TRUE")	{$remember_me = TRUE;} else {$remember_me = "";}

				//Проверка активации пользователя
				$usertemp = ORM::factory('db_mdbusers', array('email'=>$email));
				//Проверка на сущестовавание юзера с таким e-mail
				if(!$usertemp->loaded())
				{
					Request::initial()->redirect("signin?m=1&email=$email");
				}
				$adduserid = $usertemp->id;

				//Активация
				$usertemp = ORM::factory('db_mdbactivation', array('user_id'=>$adduserid,'active_on'=>1));
				if(!$usertemp->loaded())
				{
					Request::initial()->redirect("signin?m=2&email=$email");
				}

				//Пытаемся залогиниться
				if ($auth->login($email, $password, $remember_me))
				{
					//Значение сессии на редирект пользователя
					$session = Session::instance();
					if ($session->get('auth_redirect', '') != '')
					{
						$auth_redirect = $session->get('auth_redirect', '');
						$session->delete('auth_redirect');
						Request::initial()->redirect($auth_redirect);
					}
					else
					{
						Request::initial()->redirect('account');
					}

				}
				else
				{
					Request::initial()->redirect("signin?m=1&email=$email");
				}
			}
