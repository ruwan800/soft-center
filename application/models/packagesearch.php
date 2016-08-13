<?php
namespace application\models;

class packageSearch extends appLogic{

	function doIt($pkg){
		global $result;
		$dbh = self::DBConnect();
		$sth = $dbh->prepare("SELECT package,description FROM software WHERE package LIKE '%$pkg%'");
		//$sth->bindParam(1, $pkg); TODO fix this; not critical
		$sth->execute();
		$result = $sth->fetchAll();
	}
}
?>

