<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main_Cfuncauth extends Controller_Template {

	public function before()
	{
		//Проверка на авторизацию пользователя
		$auth = Auth::instance();
		if ($auth->logged_in() != 0) //Пользователь авторизован, редирект в пользовательский интрефейс
			Request::initial()->redirect('account');
		return parent::before();
	}

}
