<?php

class Application_Model_Delteamuser
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
					 ->from('users_in_groups',array('usr_id'))
					 ->where('usr_id LIKE ?', "%{$this->_user}%")
					 ->limit(1000);

		$stmt = $select->query();
		$result = $stmt->fetchAll();
		return $result;
	
	}

	public function addTeamUser()
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->delete('users_in_groups', "usr_id = {$this->_user} AND usr_group_id = {$this->_team}");
#		$db->insert('users_in_groups', array("usr_group_id" => $this->_user, "usr_id" => $this->_team));
	}



}

