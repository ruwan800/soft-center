<?php
namespace application\controller;

class linkError extends controllerIncludes{

	function handle(){
		
		if(self::validUser()){
		\application\views\errorPage::view();
		}
	}
}


?>
