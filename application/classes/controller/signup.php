<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Signup extends Controller_Main_Cfuncauth {

	public $template = "vsignup";

	public function action_index()
	{
		$data = array();
		$data["first_name"] = "";
		$data["last_name"] = "";
		$data["email"] = "";

		//submit_signup
		if (isset($_POST['submit_signup']))
		{
			$first_name = Arr::get($_POST, 'first_name', '');
			$last_name = Arr::get($_POST, 'last_name', '');
			$email = Arr::get($_POST, 'email', '');
			$password = Arr::get($_POST, 'password', '');
							
			$msignup = new Model_Msignup();
			if ($msignup->signup($first_name, $last_name, $email, $password, 1))
			{
				$data["signup_ok"] = "";
			}
			else
			{
				$data["errors"] = $msignup->errors;
				$data["first_name"] = $first_name;
				$data["last_name"] = $last_name;
				$data["email"] = $email;
			}
		}

		$this->template->vhead = View::factory('vhead');
		$this->template->vheader_logo = View::factory('vheader_logo');
		$this->template->vheader_signin = View::factory('vheader_signin');
		$this->template->vsignup_content = View::factory('vsignup_content', $data);
 		$this->template->vlatest_news = View::factory('vlatest_news');
		$this->template->vfooter = View::factory('vfooter');
	}

}