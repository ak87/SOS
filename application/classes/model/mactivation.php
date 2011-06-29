<?php defined('SYSPATH') or die('No direct script access.');

class Model_Mactivation
{
	public function activation($id, $token)
	{
		$usertemp = ORM::factory('db_mdbactivation', array('user_id'=>$id,'activ_token'=>$token,'active_on'=>0));
	    if(!$usertemp->loaded())
		{
			return FALSE;
		}

		$usertemp->active_on = 1;
		$usertemp->save();

		return TRUE;

	}

}
