<?php
namespace application\controller;

class vosIncludes{

#check user's validity
	function validUser(){

		$status=true;
		if (!isset($_SESSION['user'])) {	#check for valid user
			$status=false;
			static::tempLogin();
		}
		if (!static::recentUser()){					#deny if timedout
			$status=false;
			static::tempLogin();
		}
		if (!static::validToDo()){				#deny if not allowed to do the task
			$status=false;
			\application\views\errorPage::notify("You are not allowed to do that task");
		}
		return $status;						#return true or false
	}



#login valid user if yet not logged in else do the rest
	function tempLogin(){

		if (!isset($_SESSION)){
			session_start();
			$_SESSION['last_request']="site";  //TODO
			$_SESSION['time']=time();
			$_SESSION['login_attempt']=1;
			\application\views\loginPage::view();
		
		}
		else{
			if($_SESSION['login_attempt']>5){
				$timeGap=(time() - $_SESSION['time'])/60;
				if(4<$timeGap){
					notify("sorry, wait few minutes before try again");
				}
				else{		
					$_SESSION['time']=time();
					$_SESSION['login_attempt']=1;
					\application\views\loginPage::view();
				}
			}
			else{
				$_SESSION['login_attempt']++;
				\application\views\loginPage::view();
			}
		}
	}



#check for timedout users
	function recentUser(){
		$status=true;
		$timeGap=(time() - $_SESSION['time'])/60;
		if(24<$timeGap){
			$_SESSION['last_request']="site";
			$status=false;
			unset ( $_SESSION['user'] );
			unset ( $_SESSION['priv'] );
			$_SESSION['time']=time();
			$_SESSION['login_attempt']=0;
		}
		return $status;
	}


#check user's validity to do the task
	function validToDo(){
		global $action;
		$status=true;
		#TODO check validity for the task
		return $status;
	}

	function filterInput($value){
	
		//TODO
		return $value;
	
	}




	
		function handle(){

		\application\views\errorPage::devError("not implemented");
	}
	
	
	
}


?>
