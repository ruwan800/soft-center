<?php
namespace application\controller;

class login extends controllerIncludes{

	function handle(){
			
		global $result;
		if (isset( $_GET["user"]) && isset( $_GET["pass"]) ) {
			$user=$_GET["user"];
			$user=self::filterInput($user);
			$pass=$_GET["pass"];
			$pass=self::filterInput($pass);
			if(\application\models\loginValidate::doIt($user,$pass)){
				//TODO last requested page;
			}
			else{
				$result="Invalid username or password";
				\application\views\notify::view();
			}
		}
		else{
			\application\views\loginPage::view();
		}

	}

}


?>
