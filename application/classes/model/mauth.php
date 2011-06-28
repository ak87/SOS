<?php defined('SYSPATH') or die('No direct script access.');

class Model_Mauth
{





	public function reg($email, $password, $role)
	{
		$user = new Model_Db_Mdbuser();
		$useful = new Model_Museful();

		//Создание хеша пароля
		$hpass = $useful->genhash($password);

		//Создаем пользователя
		$user->username = $email;
		$user->email = $email;
		$user->password = $hpass;


		try
		{
			$user->save();

			//Узнаем id пользователя
			$usertemp = ORM::factory('db_mdbuser', array('email'=>$email));
			$adduserid = $usertemp->id;

			//Сохранение роли
			$addrole = new Model_Db_Mdbrole();
			$addrole->user_id = $adduserid;
			$addrole->role_id = $role;
			$addrole->save();

			//Создание активационного ключа
			$activation = new Model_Db_Mdbactivation();
			$activkey = $useful->genrandom(5);
			$activkey = $useful->genhash($activkey);
			$activation->activ_link = $activkey;
			$activation->user_id = $adduserid;
			$activation->save();

			//Отправляем на e-mail письмо с подтвержением пароля
			$from = Kohana::message('account', 'MAIL_AUTH_FROM');
			$subject = Kohana::message('account', 'MAIL_AUTH_SUBJECT');
			$message = Kohana::message('account', 'MAIL_AUTH_MESSAGE');
			$message .= "<a href='http://".$_SERVER['HTTP_HOST']."/cauth/activation?id=$adduserid&hash=$activkey'>http://".$_SERVER['HTTP_HOST']."/cauth/activation?id=$adduserid&hash=$activkey</a>";
			$useful->sendemail($email, $from, $subject, $message);

			return TRUE;
		}
		catch(ORM_Validation_Exception $e)
		{
			$this->errors = $e->errors('validation');
			return FALSE;
		}
	}

	public function resendpassword($email)
	{
		$usertemp = ORM::factory('db_mdbuser', array('email'=>$email));
		if(!$usertemp->loaded())
		{
			return FALSE;
		}
		$useful = new Model_Museful();

		$db_resendtokens = new Model_db_Mdbresendtokens();
		$userid = $usertemp->id;

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
		$message = Kohana::message('account', 'MAIL_RESENDPASS_MESSAGE');
		$data = array ('userid' => $userid, 'token' => $token);
		$message .= View::factory('account/mail_resendpass', $data);
		$useful->sendemail($email, $from, $subject, $message);

		return TRUE;
	}


	public function passwordupdate($id,$token,$password,$password_confirm)
	{

		$usertemp = ORM::factory('db_mdbuser', array('id'=>$id));
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
			$resendtokenstemp = ORM::factory('db_mdbresendtokens', array('user_id'=>$id, 'token'=>$token));
			$resendtokenstemp->delete();
		}
		else
		{
			return FALSE;
		}

		return TRUE;
	}


	public function checktoken($id,$token)
	{
		$resendtokenstemp = ORM::factory('db_mdbresendtokens', array('user_id'=>$id, 'token'=>$token));
		if(!$resendtokenstemp->loaded())
		{
			return FALSE;
		}

		$usertemp = ORM::factory('db_mdbuser', array('id'=>$id));
		if(!$usertemp->loaded())
		{
			return FALSE;
		}

		return TRUE;
	}


}
