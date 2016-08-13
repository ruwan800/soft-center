<?php

class Application_Model_Addteamuser
{

	protected $team;
	
	public function __construct()
	{
		$this->db = Zend_Db_Table::getDefaultAdapter();
		$tempData = new Zend_Session_Namespace('tempData');
		$this->team = $tempData->team;
	}

	public function searchUser($user)
	{
		$select = $this->db->select()
						   ->from('users',array('name','job_type'))
						   ->where('name LIKE ?', "%{$user}%")
						   ->limit(1000);

		$stmt = $select->query();
		$result = $stmt->fetchAll();
		return $result;
	
	}

	public function addTeamUser($user)
	{
		$this->db->insert('team_members', array("team_name" => $this->team, "user_name" => $user));
	}


}

