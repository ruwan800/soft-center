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
		try {
			$db = Zend_Db_Table::getDefaultAdapter();
			$db->insert('user_groups', $this->_data);
		} catch (Zend_Db_Adapter_Exception $e) {
			#echo $e->getCode();
			$this->view->error = $e->getCode();
		}

	
	
#		$db = Zend_Db_Table::getDefaultAdapter();
#		$db->insert('user_groups', $this->_data);
	}

}

