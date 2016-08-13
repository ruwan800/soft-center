<?php
namespace application\models;

class packageSearch extends modelsIncludes{

	function doIt($pkg,$lm){
		global $result;
		$dbh = self::DBConnect();
		$sth = $dbh->prepare("SELECT package,description FROM software WHERE package LIKE '%$pkg%' LIMIT $lm,20");
		//$sth->bindParam(1, $pkg); TODO fix this; not critical
		$sth->execute();
		$result = $sth->fetchAll();
	}
}
?>

