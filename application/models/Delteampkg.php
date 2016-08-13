<?php

class Application_Model_Delteampkg
{
	
	public function __construct()
	{
		$this->db = Zend_Db_Table::getDefaultAdapter();
		$tempData = new Zend_Session_Namespace('tempData');
		$this->team = $tempData->team;
	}

	public function searchPackage($package)
	{

		$select =	$this->db->select()
						 ->from('software_for_team',array('software'))
						 ->where('software LIKE ?', "%{$package}%")
						 ->limit(1000);

		$stmt = $select->query();
		$result = $stmt->fetchAll();
		return $result;
	
	}

	public function addTeamPkg($package)
	{
		$this->db->delete('software_for_team', "software = {$package} AND team_name = {$this->team}");
	}


}

