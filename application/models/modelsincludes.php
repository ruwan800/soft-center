<?php
namespace application\models;

class modelsIncludes{

	function doIt($pkg){
		echo "not implemented";
	}
	
	function DBConnect(){
	
		/* Connect to an ODBC database using driver invocation */
		$dsn = 'mysql:dbname=soft_center;host=127.0.0.1';
		$user = 'root';
		$password = '1';

		try {
			$dbh = new \PDO($dsn, $user, $password);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}
		return $dbh;
	}
}

?>
