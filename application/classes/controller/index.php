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

		$this->template->vhead = View::factory('vhead');
		$this->template->vheader_logo = View::factory('vheader_logo');
		$this->template->vheader_signin = View::factory('vheader_signin');
		$this->template->vindex_content = View::factory('vindex_content');
		$this->template->vcontent_signup = View::factory('vcontent_signup');
		$this->template->vlatest_news = View::factory('vlatest_news');
		$this->template->vfooter = View::factory('vfooter');
	}


}
