<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Account2 extends Controller_Main_Cneedauth {

	public $template = "vaccount";

	public function action_index()
	{
		$this->template->vhead = View::factory('vhead');
		$this->template->vheader_logo = View::factory('vheader_logo');
		$this->template->vaccount_header_menu = View::factory('vaccount_header_menu');
		$this->template->vaccount_content = View::factory('vaccount_content');
		$this->template->vfooter = View::factory('vfooter');
	}

	public function action_logout()
	{
		$data['error'] = '';
		$auth = Auth::instance();
		$auth->logout();
		Request::initial()->redirect('account');
	}

}
