<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Template {
	public $template = "vindex";

	public function action_index()
	{
		$auth = Auth::instance();
		$data = array();

		if ($auth->logged_in() != 0)
		{
			//Пользователь авторизован, редирект в пользовательский интрефейс
			Request::initial()->redirect('account');
		}
		else
		{

//Пользователь неавторизован
//submit_signin
			if ($path = Kohana::find_file('classes', 'include/header_signin'))
			{
				require $path;
			}

		}

//submit_signup
		if (isset($_POST['submit_signup']))
		{
			$first_name = Arr::get($_POST, 'first_name', '');
			$last_name = Arr::get($_POST, 'last_name', '');
			$email = Arr::get($_POST, 'email', '');
			$password = Arr::get($_POST, 'password', '');

			$signup = new Model_Msignup();
			if ($signup->signup($first_name, $last_name, $email, $password, 1))
			{
				$data["signup_ok"] = "";
			}
			else
			{
				$data["errors"] = $signup->errors;
			}
		}


		$this->template->vhead = View::factory('vhead');
		$this->template->vheader_logo = View::factory('vheader_logo');
		$this->template->vheader_signin = View::factory('vheader_signin');
		$this->template->vindex_content = View::factory('vindex_content');
		$this->template->vcontent_signup = View::factory('vcontent_signup', $data);
		$this->template->vlatest_news = View::factory('vlatest_news');
		$this->template->vfooter = View::factory('vfooter');
	}


}
