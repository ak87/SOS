<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Cmain extends Cadmin {

	public $template = "vbasic";

	public function action_index()
	{
		$this->template->rightsidebar = View::factory('vrsidebar');
		$this->template->content = View::factory('vadmin');
	}

}
