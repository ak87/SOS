<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Cauth extends Controller_Template {

	public $template = "vbasic";

	public function action_index()
	{
		$auth = Auth::instance();
		$data = array();

		if ($auth->logged_in() != 0)
		{
			//Пользователь авторизован, редирект в корень
			Request::initial()->redirect('');
		}
		else
		{
			//Пользователь неавторизован
			if (isset($_POST['btnsubmit']))
			{
				$email = Arr::get($_POST, 'email', '');
				$password = Arr::get($_POST, 'password', '');

				if ($auth->login($email, $password, TRUE))
				{
					//Значение сессии на редирект пользователя
					$session = Session::instance();
					$auth_redirect = $session->get('auth_redirect', '');
					$session->delete('auth_redirect');

					//Пользователь авторизован
					Request::initial()->redirect($auth_redirect);
				}
				else
				{
					$data['error'] = '';
				}
			}
		}
		$this->template->rightsidebar = View::factory('vauthform', $data);
		$this->template->content = View::factory('vcontent');
	}


	public function action_activation()
	{
		$data = array();
		if (isset($_GET['id']) && isset($_GET['hash']))
		{
			$id = Arr::get($_GET, 'id', '');
			$hash = Arr::get($_GET, 'hash', '');
			$activation = new Model_Mactivation();
			if ($activation->activation($id, $hash))
			{
				$data["activation_on"] = "";
			}
			else
			{
				$data["errors"] = "";
			}
		}
		$this->template->rightsidebar = View::factory('vregform', $data);
		$this->template->content = View::factory('vcontent');
	}

	public function action_reg()
	{
		$data = array();
		if (isset($_POST['btnsubmit']))
		{
			$email = Arr::get($_POST, 'email', '');
			$password = Arr::get($_POST, 'password', '');

			$register = new Model_Mregister();
			if ($register->reg($email, $password, 1))
			{
				$data["regok"] = "";
			}
			else
			{
				$data["errors"] = $register->errors;
			}
		}
		$this->template->rightsidebar = View::factory('vregform', $data);
		$this->template->content = View::factory('vcontent');
	}


	public function action_resendpassword()
	{
		$data = array();

		if(isset($_POST['btnsubmit']))
		{

			$email = Arr::get($_POST, 'email', '');

			$register = new Model_Mregister();

			if($register->resendpassword($email))
			{
				$data["ok"] = "";
			}
			else
			{
				$data["error"] = "";
			}
		}
		$this->template->rightsidebar =  View::factory('vresendpassword', $data);
		$this->template->content = View::factory('vcontent');
	}


	public function action_passwordreset()
	{
		$data = array();
		if (isset($_GET['id']) && isset($_GET['token']))
		{
			$id = Arr::get($_GET, 'id', '');
			$token = Arr::get($_GET, 'token', '');
			$register = new Model_Mregister();
			if($register->checktoken($id,$token))
			{
				$data["oktoken"] = "";
			}
			else
			{
				$data["error"] = "";
			}

			if(isset($_POST['btnsubmit']))
			{
				$password = Arr::get($_POST, 'password', '');
				$password_confirm = Arr::get($_POST, 'password_confirm', '');
				if($register->passwordupdate($id,$token,$password,$password_confirm))
				{
					$data["ok"] = "";
				}
				else
				{
					$data["error"] = "";
				}
			}
		}
		$this->template->rightsidebar =  View::factory('vpasswordreset', $data);
		$this->template->content = View::factory('vcontent');
	 }


	public function action_logout()
	{
		$data['error'] = '';
		$auth = Auth::instance();
		$auth->logout();
		$this->template->rightsidebar = View::factory('vauthform', $data);
		$this->template->content = View::factory('vcontent');
	}
}
