<?php

class Application_Model_Search
{

	public function __construct()
	{
		$this->nssearch	= new Zend_Session_Namespace('search');
		$this->params = array(	'team'	=> array(	'adduser'		=> array('users','name','job_type'),
													'deluser'		=> array(),
													'addpackage'	=> array('software','package','description'),
													'delpackage'	=> array()
								),
								'muser'	=> array(	'adduser'		=> array(),
													'deluser'		=> array(),
													'edituser'		=> array(),
								),
								'mteam'	=> array(	'createteam'	=> array(),
													'delteam'		=> array(),
													'editteam'		=> array(),
								),
								'mpackage'=> array(	'addbyteam'		=> array(),
													'delbyteam'		=> array(),
													'addbyjob'		=> array(),
													'delbyjob'		=> array(),
													'package'		=> array('software','package','description'),
								),
							 );
	} 

	public function search()
	{
		$param = $this->getParams();
		$db = Zend_Db_Table::getDefaultAdapter();
		$select = $db->select()
					 ->from($param[0],array('name' => $param[1],'info' => $param[2]))
					 ->where("{$param[1]} LIKE ?","%{$this->nssearch->text}%")
					 ->limit(1000);
		
		$stmt 	= $select->query();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function getParams()
	{
		return $this->params[$this->nssearch->controller][$this->nssearch->action];
	}

}

