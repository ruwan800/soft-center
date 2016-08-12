<?php
require_once("../controller/includes/includes.php");
require_once("includes/mysql.php");

$domQ = DOMImplementation::createDocumentType("xml","1.0","UTF-8");


$document = DOMImplementation::createDocument(null, 'xml',$domQ );

$document->formatOutput = true;

function search_error($err,$document){
	
	$error = $document->createElement('error');
	$text = $document->createTextNode($error);
	$error->appendChild($text);
}

function getResult($document){

    $output=null;
    if(isset($_GET["pkg"]))
        $software=$_GET["pkg"];

    db_select(SOFT_CENTER);

    $query="SELECT soft_id FROM software WHERE package LIKE '%$software%' LIMIT 200;";
    $result = mysql_query($query) or die(search_error(mysql_error()));
    while($row=mysql_fetch_array( $result )){
        $document=$document->importNode(apt_link_DOM_xml($row[0],$document),true);
    }
if(!$document)
    search_error("Nothing found related with \"".$software."\".",$document);
}

getResult($document);
echo $document->saveXML();


?>
