<?php

class Application_Model_Pkgdetails
{

	public function getDetail($package)
	{

		$db = Zend_Db_Table::getDefaultAdapter();
		
		$select = $db->select()
					 ->from('software')
					 ->where('package = ?',$package);

		$stmt = $select->query();
		$result = $stmt->fetch();

		return $result;
	
	}


}

