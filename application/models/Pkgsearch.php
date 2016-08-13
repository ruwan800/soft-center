<?php

class Application_Model_Pkgsearch
{

	protected $_package;
	
	public function __construct($package)
	{
		$this->_package = $package;
	}

	public function fetchAll()
	{
		$sql = "SELECT package,description FROM software WHERE package LIKE '%{$this->_package}%' LIMIT 0,1000";
		$db = Zend_Db_Table::getDefaultAdapter();
		$result = $db->fetchAll($sql );
		return $result;
	
	}

}

