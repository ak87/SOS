<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Signin extends Controller_Main_Cfuncauth {

	public $template = "vsignin";

	public function action_index()
	{
		$data = array();
		$data["email"] = "";
		$data["remember_me"] = "";

		//submit_signin
		if (isset($_POST['submit_signin']))
		{
			$email = Arr::get($_POST, 'email', '');
			$password = Arr::get($_POST, 'password', '');
			$remember_me = Arr::get($_POST, 'remember_me', '');

			$msignin = new Model_Msignin();
			if ($msignin->signin($email, $password, $remember_me))
			{
				//Авторизовались
				//Выясняем на какую страницу изначально пришел пользователь
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
				//Неавторизирован
				$data["errors"] = $msignin->errors;
				$data["email"] = $email;
				if ($remember_me == "TRUE")	{$remember_me = "checked";} else {$remember_me = "";}
				$data["remember_me"] = $remember_me;

			}
		}

		$this->template->vhead = View::factory('vhead');
		$this->template->vheader_logo = View::factory('vheader_logo');
		$this->template->vsignin_header_menu = View::factory('vsignin_header_menu');
		$this->template->vsignin_content = View::factory('vsignin_content', $data);
 		$this->template->vlatest_news = View::factory('vlatest_news');
		$this->template->vfooter = View::factory('vfooter');
	}


	public function action_activation()
	{
		$data = array();
		$data["email"] = "";
		$data["remember_me"] = "";

		if (isset($_GET['id']) && isset($_GET['token']))
		{
			$id = Arr::get($_GET, 'id', '');
			$token = Arr::get($_GET, 'token', '');
			$activation = new Model_Mactivation();
			if ($activation->activation($id, $token))
			{
				$data["activation_on"] = "";
			}
			else
			{
				$data["activation_error"] = "";
			}
		}
		else
		{
			$data["activation_error"] = "";
		}

		$this->template->vhead = View::factory('vhead');
		$this->template->vheader_logo = View::factory('vheader_logo');
		$this->template->vsignin_header_menu = View::factory('vsignin_header_menu');
		$this->template->vsignin_content = View::factory('vsignin_content', $data);
		$this->template->vlatest_news = View::factory('vlatest_news');
		$this->template->vfooter = View::factory('vfooter');
	}


	public function action_repeatactivation()
	{
		$data = array();
		$data["email"] = "";
		$data["remember_me"] = "";

		if (isset($_GET['email']))
		{
			$email = Arr::get($_GET, 'email', '');
				
			$activation = new Model_Mactivation();
			if ($activation->repeatactivation($email))
			{
				$data["repeatactivation_on"] = "";
				$data["email"] = $email;
			}
			else
			{
				$data["repeatactivation_error"] = "";
			}
		}
		else
		{
			$data["repeatactivation_error"] = "";
		}


		$this->template->vhead = View::factory('vhead');
		$this->template->vheader_logo = View::factory('vheader_logo');
		$this->template->vsignin_header_menu = View::factory('vsignin_header_menu');
		$this->template->vsignin_content = View::factory('vsignin_content', $data);
		$this->template->vlatest_news = View::factory('vlatest_news');
		$this->template->vfooter = View::factory('vfooter');
	}

}
