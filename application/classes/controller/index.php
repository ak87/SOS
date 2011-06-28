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
			if (isset($_POST['submit_signin']))
			{
				$email = Arr::get($_POST, 'email', '');
				$password = Arr::get($_POST, 'password', '');
				$remember_me = Arr::get($_POST, 'remember_me', '');
				if ($remember_me == "TRUE")	{$remember_me = TRUE;} else {$remember_me = "";}

				if ($auth->login($email, $password, $remember_me))
				{
					//Значение сессии на редирект пользователя
					$session = Session::instance();
					$auth_redirect = $session->get('auth_redirect', '');
					$session->delete('auth_redirect');

					//Пользователь авторизован
					Request::initial()->redirect($auth_redirect);
				}
				else
				{
					//Сделать редирект на сраницу авторизации
					$data['error'] = '';
				}
			}

		}

		$this->template->vhead = View::factory('vhead');
		$this->template->vlogo = View::factory('vlogo');
		$this->template->vsignin = View::factory('vsignin');
		$this->template->vindex_content = View::factory('vindex_content');
		$this->template->vsignup = View::factory('vsignup');
		$this->template->vlatest_news = View::factory('vlatest_news');
		$this->template->vfooter = View::factory('vfooter');
	}


}
