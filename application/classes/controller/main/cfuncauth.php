<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main_Cfuncauth extends Controller_Template {

	public function before()
	{
		//Запись в сессию на какую страницу пользователь перешел, для дальнейшего редиректа
		$session = Session::instance();
		$session->set('auth_redirect', $_SERVER['REQUEST_URI']);

		//Проверка на авторизацию пользователя
		$auth = Auth::instance();
		if ($auth->logged_in() != 0) //Пользователь авторизован, редирект в пользовательский интрефейс
			Request::initial()->redirect('account');
		return parent::before();
	}

}
