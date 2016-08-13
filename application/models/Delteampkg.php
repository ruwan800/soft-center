<?php

class Application_Model_Delteampkg
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
					 ->from('softwares_in_groups',array('soft_id'))
					 ->where('soft_id LIKE ?', "%{$this->_package}%")
					 ->limit(1000);

		$stmt = $select->query();
		$result = $stmt->fetchAll();
		return $result;
	
	}

	public function addTeamPkg()
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->delete('softwares_in_groups', "soft_id = {$this->_package} AND sw_group_id = {$this->_team}");
#		$db->insert('softwares_in_groups', array("usr_group_id" => $this->_package, "usr_id" => $this->_team));
	}


}
