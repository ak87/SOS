<?php defined('SYSPATH') or die('No direct script access.');

class Model_Mresendpassword
{

	public function sendtoken($email)
	{
		$usertemp = ORM::factory('db_mdbusers', array('email'=>$email));

		//Проверка на сущестовавание юзера с таким e-mail
		if(!$usertemp->loaded())
		{
			return FALSE;
		}
		$useful = new Model_Museful();

		//Таблица resend_tokens
		$db_resendtokens = new Model_db_Mdbresendtokens();
		$userid = $usertemp->id;
		$userfirstname = $usertemp->first_name;

		//Проверка на существование id текущего пользователя в таблице resend_tokens и удаление его
		$resendtokenstemp = ORM::factory('db_mdbresendtokens', array('user_id'=>$userid));
		if($resendtokenstemp->loaded())
		{
			$resendtokenstemp->delete();
		}

		$token = $useful->genrandom(5);
		$token = $useful->genhash($token);
		$db_resendtokens->token = $token;
		$db_resendtokens->user_id = $userid;
		$db_resendtokens->save();

		//Отправляем на e-mail письмо для востановления пароля
		$from = Kohana::message('account', 'MAIL_RESENDPASS_FROM');
		$subject = Kohana::message('account', 'MAIL_RESENDPASS_SUBJECT');
		$data = array ('userid' => $userid, 'token' => $token, 'userfirstname' => $userfirstname);
		$message = View::factory('account/mail_resendpass', $data);
		$useful->sendemail($email, $from, $subject, $message);

		return TRUE;
	}


	public function passwordupdate($id,$token,$password,$password_confirm)
	{

		//Проверяем существование пользователя с таким id
		$usertemp = ORM::factory('db_mdbusers', array('id'=>$id));
		if(!$usertemp->loaded())
		{
			return FALSE;
		}

		if ($password == $password_confirm)
		{
			$useful = new Model_Museful();
			//Создание хеша пароля
			$hashpass = $useful->genhash($password);
			$usertemp->password = $hashpass;
			$usertemp->save();
			//Пароль изменен удаляем поле в таблице resend_tokens с текущим id, token
			$resendtokenstemp = ORM::factory('db_mdbresendtokens', array('user_id'=>$id, 'token'=>$token));
			$resendtokenstemp->delete();
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	public function checktoken($id,$token)
	{
		//Проверка сущестованиия id и token в таблице resend_tokens
		$resendtokenstemp = ORM::factory('db_mdbresendtokens', array('user_id'=>$id, 'token'=>$token));
		if(!$resendtokenstemp->loaded())
		{
			return FALSE;
		}

		//Проверка существаваниия пользователя с таким id в таблице users
		$usertemp = ORM::factory('db_mdbusers', array('id'=>$id));
		if(!$usertemp->loaded())
		{
			return FALSE;
		}

		return TRUE;
	}


}
