<?php

class Application_Model_Mpackage
{

	public function __construct()
	{
		$this->db = Zend_Db_Table::getDefaultAdapter();
	}


	public function addByJobType($type,$value)
	{
		$select =   $this->db->select()
						 ->from('software_for_job_type',array(	'id' => 'id'))
						 ->where("job_type = ?",$type)
						 ->where("software = ?",$value)
						 ->limit(1);
		$stmt 	= $select->query();
		$result = $stmt->fetch();
		if($result){
			throw new App_Exception("Software already allowed.");
			return;
		}

		$data = array(
			'job_type'	=> $type,
			'software'	=> $value
		);
		$this->db->insert('software_for_job_type',$data);
	}

	public function delByJobType($type,$value)
	{
		$data = array(
			'job_type'	=> $type,
			'software' => $value
		);
		$this->db->delete('software_for_job_type',  "job_type = '{$type}' AND software = '{$value}'");
	}

	public function addByTeamType($type,$value)
	{
		$select =   $this->db->select()
						 ->from('software_for_team_type',array(	'id' => 'id'))
						 ->where("team_type = ?",$type)
						 ->where("software = ?",$value)
						 ->limit(1);
		$stmt 	= $select->query();
		$result = $stmt->fetch();
		if($result){
			throw new App_Exception("Software already allowed.");
			return;
		}

		$data = array(
			'team_type'	=> $type,
			'software'	=> $value
		);
		$this->db->insert('software_for_team_type',$data);
	}

	public function delByTeamType($type,$value)
	{
		$data = array(
			'team_type'	=> $type,
			'software' => $value
		);
		$this->db->delete('software_for_team_type',  "team_type = '{$type}' AND software = '{$value}'");
	}

}

