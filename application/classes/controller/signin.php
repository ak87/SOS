<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Signin extends Controller_Main_Cfuncauth {

	public $template = "vsignin";

	public function action_index()
	{
		$data = array();
		$data["email"] = "";
		//Проверка Get параметров
		if (isset($_GET['m']) || isset($_GET['email']))
		{
			$m = Arr::get($_GET, 'm', '');
			$email = Arr::get($_GET, 'email', '');

			switch ($m)
			{
				case 1:
					$data["error_login_or_password"] = "";
					break;
				case 2:
					$data["error_activation_user"] = "";
					break;
			}

			if(trim($email) != '')
			{
				$data["email"] = $email;
			}
		}

//submit_signin
		if ($path = Kohana::find_file('classes', 'include/header_signin'))
		{
			require $path;
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

		$this->template->vhead = View::factory('vhead');
		$this->template->vheader_logo = View::factory('vheader_logo');
		$this->template->vsignin_header_menu = View::factory('vsignin_header_menu');
		$this->template->vsignin_content = View::factory('vsignin_content', $data);
		$this->template->vlatest_news = View::factory('vlatest_news');
		$this->template->vfooter = View::factory('vfooter');
	}

}
