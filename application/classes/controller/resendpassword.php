<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Resendpassword extends Controller_Main_Cfuncauth {

	public $template = "vresend_password";

	public function action_index()
	{
		$data = array();




		if(isset($_POST['submit_resend_password']))
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

		$this->template->vhead = View::factory('vhead');
		$this->template->vlogo = View::factory('vlogo');
		$this->template->vsignin = View::factory('vsignin');
		$this->template->vresend_password_content = View::factory('vresend_password_content');
		$this->template->vfooter = View::factory('vfooter');
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

}
