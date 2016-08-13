<?php

class Application_Model_Pkgstatus
{
	public function isAllowed($package){

		$dependancies[] = $package;
		
		$db = Zend_Db_Table::getDefaultAdapter();

		$usersNs = new Zend_Session_Namespace('members');
		$userName =	$usersNs->userName;
		$jobType  = $usersNs->jobType;

		//get dependant software list 
		$select = $db->select()
					 ->from('dependancies','dependant')
					 ->where('dependancy = ?',$package);
		$stmt 	= $select->query();
		$result = $stmt->fetchAll();
		if($result){
			foreach ($result as $item){
				$dependancies[] = $item;
			}
		}
		
		foreach($dependancies as $package){

			//select software by job type
			$select = $db->select()
						 ->from('software_for_job_type','software')
						 ->where('job_type = ?',$jobType)
						 ->where('software = ?',$package)
						 ->limit(1);
			$stmt 	= $select->query();
			$result = $stmt->fetch();
			if($result){
				return True;
			}
		
			//select software allowed to user
			$select = $db->select()
						 ->from('software_for_user','software')
						 ->where('user_name = ?',$userName)
						 ->where('software = ?',$package)
						 ->limit(1);
			$stmt 	= $select->query();
			$result = $stmt->fetch();		
			if($result){
				return True;
			}
			
			//get team list of current user 
			$select = $db->select()
						 ->from('teams',array('team_name','team_type'))
						 ->where('team_owner = ?',$userName);
			$stmt 	= $select->query();
			$result = $stmt->fetchAll();
			if($result){
#				$teams[] 	 = ;
#				$teamTypes[] = ;
				foreach ($result as $result){
					$teams[] = $result['team_name'];
					$teamTypes[] = $result['team_type'];
				}
			}
			else{
				return False;
			}
			
			
			//select software by team types
			foreach ( $teamTypes as $teamType ){
				$select = $db->select()
							 ->from('software_for_team_type','software')
							 ->where('team_type = ?',$teamType)
							 ->where('software = ?',$package)
							 ->limit(1);
				$stmt 	= $select->query();
				$result = $stmt->fetch();
				if($result){
					return True;
				}
			}

			//select software from teams
			foreach ( $teams as $team ){
				$select = $db->select()
							 ->from('software_for_team','software')
							 ->where('team_name = ?',$team)
							 ->where('software = ?',$package)
							 ->limit(1);
				$stmt 	= $select->query();
				$result = $stmt->fetch();
				if($result){
					return True;
				}
			}
		}
		return False;
	}
}

