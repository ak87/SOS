<?php defined('SYSPATH') or die('No direct script access.');

class Model_Msignup
{

	public function signup($first_name, $last_name, $email, $password, $role)
	{
		$user = new Model_Db_Mdbusers();
		$useful = new Model_Museful();

		//Создание хеша пароля
		$hpass = $useful->genhash($password);
		$reg_time = getdate();
		//Создаем пользователя
		$user->first_name = $first_name;
		$user->last_name = $last_name;
		$user->username = $email;
		$user->email = $email;
		$user->password = $hpass;
		$user->reg_time = $reg_time[0];


		try
		{
			$user->save();

			//Узнаем id пользователя
			$usertemp = ORM::factory('db_mdbusers', array('email'=>$email));
			$user_id = $usertemp->id;

			//Сохранение роли
			$addrole = new Model_Db_Mdbrole();
			$addrole->user_id = $user_id;
			$addrole->role_id = $role;
			$addrole->save();

			//Создание активационного ключа
			$activation = new Model_Db_Mdbactivation();
			$activ_token = $useful->genrandom(5);
			$activ_token = $useful->genhash($activ_token);
			$activation->activ_token = $activ_token;
			$activation->user_id = $user_id;
			$activation->save();

			//Отправляем на e-mail письмо с подтвержением регистрации
			$from = Kohana::message('account', 'MAIL_AUTH_FROM');
			$subject = Kohana::message('account', 'MAIL_AUTH_SUBJECT');
			$data = array ('user_id' => $user_id, 'token' => $activ_token, 'first_name' => $first_name);
			$message = View::factory('account/mail_activation', $data);
			$useful->sendemail($email, $from, $subject, $message);

			return TRUE;
		}
		catch(ORM_Validation_Exception $e)
		{
			$this->errors = $e->errors('validation');
			return FALSE;
		}
	}

}
