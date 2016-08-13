<?php

class Application_Model_Addteampkg
{

	protected $_package;
	
	public function __construct($package,$team = Null)
	{
		$this->_package = $package;
		$this->_team = $team;
	}

	public function searchPackage()
	{

		$db = Zend_Db_Table::getDefaultAdapter();
		
		$select = $db->select()
					 ->from('software',array('package', 'description'))
					 ->where('package LIKE ?', "%{$this->_package}%")
					 ->limit(1000);

		$stmt = $select->query();
		$result = $stmt->fetchAll();
		return $result;
	
	}

	public function addTeamPkg()
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->insert('softwares_in_groups', array("sw_group_id" => $this->_package, "soft_id" => $this->_team));
	}

}

