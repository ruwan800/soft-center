<?php

class Application_Model_Catsearch
{

	protected $_category;
	
	public function __construct($category)
	{
		$this->_category = $category;
	}

	public function getResult()
	{
	
		$db = Zend_Db_Table::getDefaultAdapter();
		
		$select = $db->select()
					 ->from('software',array('package', 'description'))
					 ->where('section = ?',$this->_category)
					 ->limit(1000);

		$stmt = $select->query();
		$result = $stmt->fetchAll();
		return $result;
	
	}


}

