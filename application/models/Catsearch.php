<?php

class Application_Model_Catsearch
{

	public function getResult($category)
	{
	
		$db = Zend_Db_Table::getDefaultAdapter();
		$select = $db->select()
					 ->from('software',array('package', 'description'))
					 ->where('section = ?',$category)
					 ->limit(1000);
		$stmt = $select->query();
		$result = $stmt->fetchAll();
		return $result;
	}


}

