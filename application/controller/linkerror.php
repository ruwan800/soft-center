<?php
namespace application\controller;

class linkError extends vosIncludes{

	function handle(){
		
		if(self::validUser()){
		\application\views\errorPage::view();
		}
	}
}


?>
