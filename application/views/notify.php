<?php
namespace application\views;

class notify extends viewsIncludes{

	function createXML(){
		global $result;
		global $document;
		$xml = $document->documentElement;
		$notice = $document->createElement('notice');
		$content = $document->createTextNode($result);
		$notice->appendChild($content);
		$xml->appendChild($notice);
	}
	
	function createHTML(){

		global $result;
		
		return $result;
	}
}


?>
