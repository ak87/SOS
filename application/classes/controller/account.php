<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Account extends Controller_Main_Cneedauth {

	public $template = "vaccount";

	public function action_index()
	{
		$this->template->vhead = View::factory('vhead');
		$this->template->vlogo = View::factory('vlogo');
		$this->template->vaccount_menu = View::factory('vaccount_menu');
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
