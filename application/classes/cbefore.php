<?php defined('SYSPATH') or die('No direct script access.');

class Cbefore extends Controller_Template {

	public function before()
	{
		//Запись в сессию на какую страницу пользователь перешел, для дальнейшего редиректа
		$session = Session::instance();
		$session->set('auth_redirect', $_SERVER['REQUEST_URI']);

		//Проверка на авторизацию пользователя
		$auth = Auth::instance();
		if ($auth->logged_in() == 0) Request::initial()->redirect('cauth');
		return parent::before();
	}

}
