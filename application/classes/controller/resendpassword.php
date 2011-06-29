<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Resendpassword extends Controller_Main_Cfuncauth {

	public $template = "vresend_password";

	public function action_index()
	{
		$data = array();

//submit_signin
		if ($path = Kohana::find_file('classes', 'include/header_signin'))
		{
			require $path;
		}

//submit_resend_password
		if(isset($_POST['submit_resend_password']))
		{
			$email = Arr::get($_POST, 'email', '');
			$mresendpassword = new Model_Mresendpassword();

			if($mresendpassword->sendtoken($email))
			{
				$data["ok"] = "";
			}
			else
			{
				$data["error"] = "";
			}
		}

		$this->template->vhead = View::factory('vhead');
		$this->template->vheader_logo = View::factory('vheader_logo');
		$this->template->vheader_signin = View::factory('vheader_signin');
		$this->template->vresend_password_content = View::factory('vresend_password_content', $data);
		$this->template->vlatest_news = View::factory('vlatest_news');
		$this->template->vfooter = View::factory('vfooter');
	}


	public function action_reset()
	{

		$data = array();
		if (isset($_GET['id']) && isset($_GET['token']))
		{
			$id = Arr::get($_GET, 'id', '');
			$token = Arr::get($_GET, 'token', '');
			$mresendpassword = new Model_Mresendpassword();


			if($mresendpassword->checktoken($id,$token))
			{
				$usertemp = ORM::factory('db_mdbusers', array('id'=>$id));
				$data["user_email"] = $usertemp->email;
			}
			else
			{
				$data["token_error"] = "";
			}
//submit_reset_password
			if(isset($_POST['submit_reset_password']))
			{
				$password = Arr::get($_POST, 'password', '');
				$password_confirm = Arr::get($_POST, 'password_confirm', '');
				if($mresendpassword->passwordupdate($id,$token,$password,$password_confirm))
				{
					$data["update_ok"] = "";
				}
				else
				{
					$data["update_error"] = "";
				}
			}
		}

//submit_signin
		if ($path = Kohana::find_file('classes', 'include/header_signin'))
		{
			require $path;
		}


		$this->template->vhead = View::factory('vhead');
		$this->template->vheader_logo = View::factory('vheader_logo');
		$this->template->vheader_signin = View::factory('vheader_signin');
		$this->template->vresend_password_content = View::factory('vreset_password_content', $data);
		$this->template->vlatest_news = View::factory('vlatest_news');
		$this->template->vfooter = View::factory('vfooter');
	 }

}
