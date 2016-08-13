<?php
namespace application\views;

class packageview extends viewsIncludes{

	function createXML(){
		global $result;
		global $document;
		$xml = $document->documentElement;
		foreach ($result as $row){
			$package = $document->createElement('package');
			$name = $document->createElement('name');
			$description = $document->createElement('description');
			$nameText = $document->createTextNode($row[0]);
			$descriptionText = $document->createTextNode($row[1]);
			$package->appendChild($name);
			$package->appendChild($description);
			$name->appendChild($nameText);
			$description->appendChild($descriptionText);
			$xml->appendChild($package);
		}
	}
	
	function createHTML(){

		global $result;
		$resultSet = "";
		foreach ($result as $row){
			$resultSet .= "{$row[0]}</br>{$row[1]}</br>";
		}
		return $resultSet;
	}
}
?>
