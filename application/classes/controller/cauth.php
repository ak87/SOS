<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Cauth extends Controller_Template {

	public $template = "vbasic";

	public function action_index()
	{
		$auth = Auth::instance();
		$data = array();

		if ($auth->logged_in() != 0)
		{
			//Пользователь авторизован
			Request::initial()->redirect('');
		}
		else
		{
			//Пользователь неавторизован
			if (isset($_POST['btnsubmit']))
			{
				$email = Arr::get($_POST, 'email', '');
				$password = Arr::get($_POST, 'password', '');

				if ($auth->login($email, $password))
				{
					//Значение сессии на редиректа пользователя
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


	public function action_reg()
	{
		$data = array();
		if (isset($_POST['btnsubmit']))
		{
			$email = Arr::get($_POST, 'email', '');
			$password = Arr::get($_POST, 'password', '');

			$register = new Model_Register();
			if ($register->reg($email,$password))
			{
				$data["regok"] = "";
			}
			else
			{
				$data["error"] = "";
			}
		}
		$this->template->rightsidebar = View::factory('vregform', $data);
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
