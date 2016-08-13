<?php
require_once("../controller/includes/includes.php");
require_once("includes/mysql.php");

$domQ = DOMImplementation::createDocumentType("xml","1.0","UTF-8");


$document = DOMImplementation::createDocument(null, 'xml',$domQ );

$document->formatOutput = true;

function search_error($error){
	
	$error = $document->createElement('error');
	$text = $document->createTextNode($error);
	$error->appendChild($text);
}




    if(isset($_GET["pkg"]))
        $software=$_GET["pkg"];
    else
	$software="anna";		//TODO remove this line
    db_select(SOFT_CENTER);

    $query="SELECT soft_id,package,description FROM software WHERE package LIKE '%$software%' LIMIT 200;";
    $result = mysql_query($query) or die(search_error(mysql_error()));
	
    while($row=mysql_fetch_array( $result )){
    		//echo $row[0]."</br>";###############################################
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
    }
if(!$document){
/*
	$error = $document->createElement('error');
	$text = $document->createTextNode("Nothing found related with \"".$software."\".");
	$error->appendChild($text);
*/
	echo "errr";
}
else{
	echo $document->saveXML();
	echo "none";
}

?>
