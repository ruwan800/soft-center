<?php

class Application_Model_Team
{
	protected $_data;
	
	public function __construct($data)
	{
		$this->_data = $data;
	}

	public function createTeam()
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->insert('user_groups', $this->_data);
	}

}

