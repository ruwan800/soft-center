<?php

class Application_Model_Pkgdetails
{

	protected $_package;
	
	public function __construct($package)
	{
		$this->_package = $package;
	}

	public function getDetail()
	{

		$db = Zend_Db_Table::getDefaultAdapter();
		
		$select = $db->select()
					 ->from('software')
					 ->where('package = ?',$this->_package);

		$stmt = $select->query();
		$result = $stmt->fetch();

		return $result;
	
	}


}

