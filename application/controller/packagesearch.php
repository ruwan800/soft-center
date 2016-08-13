<?php
namespace application\controller;

class packageSearch extends controllerIncludes{

	function handle(){
//		if(self::validUser()){
			if (isset( $_GET["pkg"]) ) {
				$pkg=$_GET["pkg"];
				$pkg=self::filterInput($pkg);
			}
			else{
				$pkg='anna';
			}
			if (isset( $_GET["lm"]) ) {
				$lm=$_GET["lm"];
				$lm=self::filterInput($lm);
			}
			else{
				$lm=0;
			}
			\application\models\packageSearch::doIt($pkg,$lm);
			\application\views\packageView::view();

					/* get input values securely
					** call model
					** hear what model says
					** let views to do the rest
					*/
		}
//	}
}


?>
