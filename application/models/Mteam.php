<?php

class Application_Model_Mteam
{
	
	public function __construct()
	{
		$this->db     = Zend_Db_Table::getDefaultAdapter();
	}



	public function createTeam($data){

			$this->db->insert('teams', $data);

	}

	public function deleteTeam($data){

			#$this->db->insert('teams', $data);

	}

}

