<?php

class Application_Model_Delteamuser
{

	public function __construct()
	{
		$this->db = Zend_Db_Table::getDefaultAdapter();
		$tempData = new Zend_Session_Namespace('tempData');
		$this->team = $tempData->team;
	}

	public function searchUser($user)
	{
		
		$select = 	$this->db->select()
						 ->from('team_members',array('user_name'))
						 ->where('user_name LIKE ?', "%{$user}%")
						 ->limit(1000);

		$stmt = $select->query();
		$result = $stmt->fetchAll();
		return $result;
	
	}

	public function addTeamUser($user)
	{
		$this->db->delete('team_members', "user_name = {$user} AND team_name = {$this->team}");
	}



}

