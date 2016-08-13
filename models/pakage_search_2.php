<?php


header('Content-Type: text/xml');									//let return result as XML
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';		//XML related info

require_once("../controller/includes/includes.php");
require_once("includes/mysql.php");


class packageSearch extends application {

	public static function vosApp($software){
		global $document;
		

		$xml = $document->documentElement;
		db_select(SOFT_CENTER);
		$query="SELECT soft_id,package,description FROM software WHERE package LIKE '%$software%' LIMIT 200;";
		$result = mysql_query($query) or notify(mysql_error());
		
		while($row=mysql_fetch_array( $result )){
			$package = $document->createElement('package');
			$name = $document->createElement('name');
			$description = $document->createElement('description');
			$soft_id = $document->createElement('soft_id');
			$nameText = $document->createTextNode($row[1]);
			$descriptionText = $document->createTextNode($row[2]);
			$soft_idText = $document->createTextNode($row[0]);
			$package->appendChild($name);
			$package->appendChild($description);
			$package->appendChild($soft_id);
			$name->appendChild($nameText);
			$description->appendChild($descriptionText);
			$soft_id->appendChild($soft_idText);
			$xml->appendChild($package);
		}
	}
}

class application {

	public static function getXML($input){
		
		global $document;
		
		$domQ = DOMImplementation::createDocumentType("xml","1.0","UTF-8");
		$document = DOMImplementation::createDocument(null, 'xml',$domQ );


		
		
		static::vosApp($input);

		$document = $document->saveXML();
		$posF = 1+strpos($document, '>');
		$posL = strrpos($document, '<');
		if ($posL===false){
			$document = substr( $document, $posF);
		}
		else{
			$document = substr( $document, $posF, $posL);
		}
		echo $document;

	}
}


packageSearch::getXML("anna")
?>
