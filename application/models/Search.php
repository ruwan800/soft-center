<?php

class Application_Model_Search
{

	public function search($action,$text)
	{
#		throw new App_Exception("PPP".$text."QQQ");
		$db = Zend_Db_Table::getDefaultAdapter();
		$select = $db->select()
					 ->from('software',array('name' => 'package','info' => 'description'))
					 ->where('package LIKE ?',"%{$text}%")
					 ->limit(1000);
		
		$stmt 	= $select->query();
		$result = $stmt->fetchAll();
		return $result;
	}
}

