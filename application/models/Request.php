<?php

class Application_Model_Request
{
	public function __construct()
	{
		$this->db = Zend_Db_Table::getDefaultAdapter();
	}

	public function getAll($data)
	{
		$select =   $this->db->select()
						 ->from('request_management',array(	'id'		=> 'id',
						 									'software'	=> 'software_name',
						 									'user'		=> 'user_name',
						 									'info'		=> 'remarks',
						 									'teamuse'	=> 'request_is_for'))
						 ->where("priority_level NOT ?",0)
						 ->limit(100);
		$stmt 	= $select->query();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function allow($request)
	{
		$user = $this->getUser($request);
		$package = $this->getPackage($request);
		$select =   $this->db->select()
						 ->from('software_for_user',array(	'id' => 'id'))
						 ->where("user_name = ?",$user)
						 ->where("software = ?",$package)
						 ->limit(1);
		$stmt 	= $select->query();
		$result = $stmt->fetch();
		if($result){
			throw new App_Exception("Software already allowed.");
			return;
		}
		
		$data = array(
			'user_name'	=> $user,
			'software' 	=> $package
		);
		$this->db->insert('software_for_user',$data);
		$this-update($request);
	}

	public function allowAll($request)
	{
      	$this->nsteam = new Zend_Session_Namespace('team');
      	$this->nsteam->team = $this->getTeam($request);
		$model = new Application_Model_Team();
		$model->addPackage($this->getPackage($request));
		Zend_Session::namespaceUnset('team');
		$this->update($request);
	}

	public function deny($request)
	{
		$this->update($request);
	}

	public function getTeam($request)
	{
		return getInfo($request,'team');
	}

	public function getPackage($request)
	{
		return getInfo($request,'software_name');
	}

	public function getUser($request)
	{
		return getInfo($request,'user_name');
	}

	public function getInfo($request,$value)
	{
		$select =   $this->db->select()
						 ->from('request_management',array($value))
						 ->where("id = ?",$request);
		$stmt 	= $select->query();
		$result = $stmt->fetch();
		return $result[$value];
	}

	public function update($request)
	{		
		$this->db->update('request_management',array('priority_level'=> 0),"id = {$request}");
	}
}

