<?php defined('SYSPATH') or die('No direct script access.');

class Model_Db_Mdbuser extends ORM
{
	protected $_table_name = 'users';

	public function rules()
	{
			return array
			(
				'email' => array
				(
					array('not_empty'),
					array('email'),
					array(array($this, 'email_unique')),
				),
			);
	}

	public function email_unique($email)
	{
            $db = Database::instance();

            if ($this->id)
            {
                $query =
                    'SELECT id
                    FROM users
                    WHERE id != '.$this->id.' AND email = '.$db->escape($email);
            }
            else
            {
                $query =
                    'SELECT id
                    FROM users
                    WHERE email = '.$db->escape($email);
            }

            $result = $db->query(Database::SELECT, $query, FALSE)->as_array();
            if (count($result) > 0)
            {
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }
	}

}
