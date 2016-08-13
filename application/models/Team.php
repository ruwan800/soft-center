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

	public function addUser($user)
	{
		$team = $this->nsteam->team;
		$select = $this->db->select()
					 ->from('team_members',array(	'id' => 'id'))
					 ->where("user_name = ?",$user)
					 ->where("team_name = ?",$team)
					 ->limit(1);
		$stmt 	= $select->query();
		$result = $stmt->fetch();
		if($result){
			throw new App_Exception("User already a member of this team.");
			return;
		}

		$data = array(
			'user_name'	=> $user,
			'team_name' => $team
		);
		$this->db->insert('team_members',$data);
	}

	public function delUser($user)
	{
		$team = $this->nsteam->team;
		$data = array(
			'user_name'	=> $user,
			'team_name' => $team
		);
		$this->db->delete('team_members', $data);
	}

	public function addPackage($pkg)
	{
		$team = $this->nsteam->team;
		$select =   $this->db->select()
						 ->from('software_for_team',array(	'id' => 'id'))
						 ->where("software = ?",$pkg)
						 ->where("team_name = ?",$team)
						 ->limit(1);
		$stmt 	= $select->query();
		$result = $stmt->fetch();
		if($result){
			throw new App_Exception("Software already allowed.");
			return;
		}
		
		$data = array(
			'team_name'	=> $team,
			'software' 	=> $pkg
		);
		$this->db->insert('software_for_team',$data);
	}

	public function delPackage($pkg)
	{
		$team = $this->nsteam->team;
		$data = array(
			'team_name'	=> $team,
			'software' 	=> $pkg
		);
		$this->db->delete('software_for_team', $data);
	}

}

