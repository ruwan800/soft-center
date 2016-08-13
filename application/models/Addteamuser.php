<?php

class Application_Model_Addteamuser
{

	protected $_user;
	
	public function __construct($user,$team = Null)
	{
		$this->_user = $user;
		$this->_team = $team;
	}

	public function searchUser()
	{

		$db = Zend_Db_Table::getDefaultAdapter();
		
		$select = $db->select()
					 ->from('user_settings',array('usr_e_mail'))
					 ->where('usr_e_mail LIKE ?', "%{$this->_user}%")
					 ->limit(1000);


		$stmt = $select->query();
		$result = $stmt->fetchAll();
		return $result;
	
	}

	public function addTeamUser()
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->insert('users_in_groups', array("usr_group_id" => $this->_user, "usr_id" => $this->_team));
	}


}

