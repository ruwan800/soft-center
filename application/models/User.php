<?php

class Application_Model_User
{
	
	public function __construct()
	{
		$this->userns	= new Zend_Session_Namespace('members');
	}

	public function setUser()
	{
		if( ! isset($this->userns->userName)){
			$this->userns->userName = 'default';
		}
		$db = Zend_Db_Table::getDefaultAdapter();
		$select = $db->select()
				 ->from('users','priviledge_type')
				 ->where('name = ?',$this->userns->userName);
		$stmt = $select->query();
		$result = $stmt->fetch();
		$result['priviledge_type'] == 'admin' ? $type = 'admin' : $type = 'default';
		$type == 'admin' ? $this->userns->admin = True : $this->userns->admin = False ;
		
		$select = $db->select()
					 ->from('teams','id')
					 ->where('team_owner = ?',$this->userns->userName)
					 ->limit(1);
		$stmt = $select->query();
		$result = $stmt->fetch();
		if($result){
			$type .= 'TO';
		}
		$result ? $this->userns->teamOwner = True : $this->userns->teamOwner = False ;
		$this->userns->userType = $type;
		
		$select = $db->select()
					 ->from('users','job_type')
					 ->where('name = ?',$this->userns->userName);
		$stmt = $select->query();
		$result = $stmt->fetch();
		$this->userns->jobType = $result['job_type'];
	}


	public function getUserType()
	{
		if ( ! isset($this->userns->userType)){
			$this->setUser();
		}
		return $this->userns->userType;
	}

	public function getJobType()
	{
		if ( ! isset($this->userns->userType)){
			$this->setUser();
		}
		return $this->userns->userType;

	}

	public function isAdmin()
	{
		if ( ! isset($this->userns->admin)){
			$this->setUser();
		}
		return $this->userns->admin;
	}
			
	public function isTeamOwner()
	{
		if ( ! isset($this->userns->teamOwner)){
			$this->setUser();
		}
		return $this->userns->teamOwner;
	}

}

