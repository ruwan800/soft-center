<?php

class Application_Model_Search
{

	public function __construct()
	{
		$this->nssearch	= new Zend_Session_Namespace('search');
		$this->params = array(	'team'	=> array(	'adduser'		=> array('users','name','job_type'),
													'deluser'		=> array('users','name','job_type'),
													'addpackage'	=> array('software','package','description'),
													'delpackage'	=> array('software_for_team','software','team_name')
								),
								'muser'	=> array(	'adduser'		=> array(),
													'deluser'		=> array('users','name','job_type'),
													'edituser'		=> array('users','name','job_type'),
								),
								'mteam'	=> array(	'createteam'	=> array(),
													'delteam'		=> array('teams','team_name','team_description'),
													'editteam'		=> array('teams','team_name','team_description'),
								),
								'mpackage'=> array(	'addbyteam'		=> array('software','package','description'),
													'delbyteam'		=> array('software_for_team_type',
																			 'software','team_type'),
													'addbyjob'		=> array('software','package','description'),
													'delbyjob'		=> array('software_for_job_type',
																			 'software','job_type'),
													'package'		=> array('software','package','description'),
								),
							 );
	} 

	public function search()
	{
		$param = $this->getParams();
		$db = Zend_Db_Table::getDefaultAdapter();
		if($this->nssearch->action == ('delbyteam'|'delbyjob'|'delpackage')){
			$select = $db->select()
					 ->from($param[0],array('name' => $param[1],'info' => ''))
					 ->where("{$param[2]} = ?", $this->nssearch->type)
					 ->where("{$param[1]} LIKE ?","%{$this->nssearch->text}%")
					 ->limit(100);
		}
		else{
			$select = $db->select()
						 ->from($param[0],array('name' => $param[1],'info' => $param[2]))
						 ->where("{$param[1]} LIKE ?","%{$this->nssearch->text}%")
						 ->limit(1000);
		}

		$stmt 	= $select->query();
		$result = $stmt->fetchAll();
		return $result;
	}

	public function getParams()
	{
		return $this->params[$this->nssearch->controller][$this->nssearch->action];
	}

}

