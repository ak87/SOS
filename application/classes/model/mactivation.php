<?php defined('SYSPATH') or die('No direct script access.');

class Model_Mactivation
{

	public function activation($id, $hash)
	{
		$user = new Model_Db_Mdbactivation();
		$usertemp = ORM::factory('db_mdbactivation', array('user_id'=>$id,'activ_link'=>$hash,'active_on'=>0));
	    if(!$usertemp->loaded())
		{
			return FALSE;
		}

		$usertemp->active_on = 1;

		try
		{
			$usertemp->save();
		}
		catch(ORM_Validation_Exception $e)
		{
			$this->errors = $e->errors('activation');
			return FALSE;
		}
		return TRUE;

	}

}
