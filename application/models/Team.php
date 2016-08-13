<?php

class Application_Model_Team
{
	
	protected $team = Null;
	
	public function __construct($team = Null){

		$this->team   = $team;
		$this->db     = Zend_Db_Table::getDefaultAdapter();
		$this->userns = new Zend_Session_Namespace('members');

	}


	public function createTeam($data){

			$this->db->insert('teams', $data);

	}
	
	public function myTeams(){

		$select =  $this->db->select()
					 	->from('teams',array('team_name','team_description'))
					 	->where('team_owner = ?', $this->userns->userName)
					 	->limit(100);
		$stmt 	= $select->query();
		$result = $stmt->fetchAll();
		return $result;

	}

}

