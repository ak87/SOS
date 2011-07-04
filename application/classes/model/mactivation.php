<?php defined('SYSPATH') or die('No direct script access.');

class Model_Mactivation
{
	public function activation($id, $token)
	{
		$usertemp = ORM::factory('db_mdbactivation', array('user_id'=>$id,'activ_token'=>$token,'active_on'=>0));
	    if(!$usertemp->loaded())
		{
			return FALSE;
		}

		$usertemp->active_on = 1;
		$usertemp->save();

		return TRUE;

	}

	public function repeatactivation($email)
	{
		//Существует ли такой пользователь с таким email
		$usertemp = ORM::factory('db_mdbusers', array('email'=>$email));
		if(!$usertemp->loaded())
		{
			return FALSE;
		}
		$user_id = $usertemp->id;
		$first_name = $usertemp->first_name;
		//Существует ли в базе activation пользователь с таким id и активирован ли он
		$dbactivation = ORM::factory('db_mdbactivation', array('user_id'=>$user_id,'active_on'=>0));
	    if(!$dbactivation->loaded())
		{
			return FALSE;
		}

		$useful = new Model_Museful();
		//Генерируем активационное письмо
		//Создание активационного ключа
		$activ_token = $useful->genrandom(5);
		$activ_token = $useful->genhash($activ_token);
		$dbactivation->activ_token = $activ_token; 
		$dbactivation->save();


		//Отправляем на e-mail письмо с подтвержением регистрации
		$from = Kohana::message('account', 'MAIL_AUTH_FROM');
		$subject = Kohana::message('account', 'MAIL_AUTH_SUBJECT');
		$data = array ('user_id' => $user_id, 'token' => $activ_token, 'first_name' => $first_name);
		$message = View::factory('account/mail_activation', $data);
		$useful->sendemail($email, $from, $subject, $message);

		return TRUE;

	}




}
