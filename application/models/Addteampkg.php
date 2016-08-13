<?php

class Application_Model_Addteampkg
{

	protected $team;
	
	public function __construct()
	{
		$tempData = new Zend_Session_Namespace('tempData');
		$this->_team = $tempData->team;
		$this->db = Zend_Db_Table::getDefaultAdapter();
	}

	public function searchPackage($package)
	{

		
		$select =  $this->db->select()
					 	->from('software',array('package', 'description'))
					 	->where('package LIKE ?', "%{$package}%")
					 	->limit(1000);

		$stmt = $select->query();
		$result = $stmt->fetchAll();
		return $result;
	
	}

	public function addTeamPkg($package)
	{
		$this->db->insert('software_for_team', array("team_name" => $this->_team, "software" => $package));
	}

}

