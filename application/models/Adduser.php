<?php

class Application_Model_Adduser
{
	public function addUser($data)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->insert('users', $data);
	}
}

