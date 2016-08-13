<?php
namespace application\views;

class loginPage extends viewsIncludes{

	public static function createXML(){

		$result="here we go.....!!!</br>please login";
		global $document;
		$xml = $document->documentElement;
		$login = $document->createElement('login');
		$content = $document->createCDATASection($result);
		$login->appendChild($content);
		$xml->appendChild($login);

	}
}


?>
