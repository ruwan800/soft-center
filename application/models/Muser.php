<?php

class Application_Model_Muser
{
	public function __construct()
	{
		$this->db = Zend_Db_Table::getDefaultAdapter();
	}

	public function addUser($data)
	{
		$this->db->insert('users', $data);
	}

	public function editUser($data)
	{
		$select =   $this->db->select()
						 ->from('users',array(	'name'				=> 'name',
			 									'email'				=> 'email',
			 									'priviledge_type'	=> 'priviledge_type',
			 									'job_type'			=> 'job_type'))
						 ->where("name = ?",$data);
		$stmt 	= $select->query();
		$result = $stmt->fetch();
		return $result;
	}

	public function updateUser($data)
	{
		$this->db->update('users', $data ,array('name'=> $data['name']));
	}

	public function deleteUser($data)
	{
		$this->db->delete('users', "name = '{$data}'");
	}
	
	
}

