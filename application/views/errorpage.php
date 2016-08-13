<?php
namespace application\views;

class errorPage{

	function view(){
		echo "Page not found.</br> :(";
	}

	function devError($err){
		echo "{$err}.</br> :(";
	}

}


?>
