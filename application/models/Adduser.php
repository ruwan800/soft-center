<?php

class Application_Model_Adduser
{
	protected $_data;
	
	public function __construct($data)
	{
		$this->_data = $data;
	}

	public function addUser()
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->insert('user_settings', $this->_data);
	}
}

