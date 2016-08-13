<?php

class Application_Model_Team
{
	
	protected $team = Null;
	
	public function __construct($team = Null){

		$this->team   = $team;
		$this->db     = Zend_Db_Table::getDefaultAdapter();
		$this->userns = new Zend_Session_Namespace('members');
      	$this->nsteam = new Zend_Session_Namespace('team');

	}


	public function myTeams()
	{
		$select =  $this->db->select()
					 	->from('teams',array('name' => 'team_name','info' => 'team_description'))
					 	->where('team_owner = ?', $this->userns->userName)
					 	->limit(100);
		$stmt 	= $select->query();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function addUser()
	{
		
	}

	public function delUser()
	{
		
	}

	public function addPackage()
	{
		
	}

	public function delPackage()
	{
		
	}

}

