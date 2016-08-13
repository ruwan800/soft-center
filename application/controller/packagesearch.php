<?php
namespace application\controller;

class packageSearch extends vosIncludes{

	function handle(){
//		if(self::validUser()){
			if (isset( $_GET["pkg"]) ) {
				$pkg=$_GET["pkg"];
				$pkg=self::filterInput($pkg);
			}
			else{
				$pkg='anna';
			}
			\application\models\packageSearch::doIt($pkg);
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
