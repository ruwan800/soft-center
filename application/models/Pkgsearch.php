<?php

class Application_Model_Pkgsearch
{

	public function getResult($package)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$select = $db->select()
					 ->from('software',array('package','description'))
					 ->where('package LIKE ?',"%{$package}%")
					 ->limit(1000);
		
		$stmt 	= $select->query();
		$result = $stmt->fetchAll();
		return $result;
	
	}

}

