<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Cauth extends Controller_Template {

	public $template = "vbasic";

	public function action_activation()
	{
		$data = array();
		if (isset($_GET['id']) && isset($_GET['hash']))
		{
			$id = Arr::get($_GET, 'id', '');
			$hash = Arr::get($_GET, 'hash', '');
			$activation = new Model_Mactivation();
			if ($activation->activation($id, $hash))
			{
				$data["activation_on"] = "";
			}
			else
			{
				$data["errors"] = "";
			}
		}
		$this->template->rightsidebar = View::factory('vregform', $data);
		$this->template->content = View::factory('vcontent');
	}


}
