<?php

class Application_Model_Mteam
{
	
	public function __construct()
	{
		$this->db = Zend_Db_Table::getDefaultAdapter();
	}



	public function createTeam($data){

		$this->db->insert('teams', $data);

	}

	public function editTeam($data)
	{
		$select =   $this->db->select()
						 ->from('teams',array(	'team_name'			=> 'team_name',
			 									'team_owner'		=> 'team_owner',
			 									'team_type'			=> 'team_type',
			 									'team_description'	=> 'team_description'))
						 ->where("team_name = ?",$data);
		$stmt 	= $select->query();
		$result = $stmt->fetch();
		return $result;

	}
	
	public function updateTeam($data)
	{
		$this->db->update('team', $data ,array('team_name'=> $data['team_name']));
	}
	
	public function deleteTeam($data)
	{
		$this->db->delete('teams', array('team_name'=> $data));
	}

}

