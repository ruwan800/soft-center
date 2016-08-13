<?php
namespace application\views;

class viewsIncludes {

	public static function view(){
		self::goXML();		//TODO let it go with html;
	}


	public static function goXML(){
		
		global $document;
		
		$domQ = \DOMImplementation::createDocumentType("xml","1.0","UTF-8");
		$document = \DOMImplementation::createDocument(null, 'xml',$domQ );

		static::createXML();

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
	/*
	public static function goHTML(){
		
		global $document;
		
		echo "oeueoueouoe";
		$domQ = \DOMImplementation::createDocumentType("htuml","1.0","UTF-8");
		$document = \DOMImplementation::createDocument(null, 'htiml',$domQ );
		echo "oeueoueouoe";
		$xml = $document->documentElement;
		$head = $document->createElement('heiad');
		$body = $document->createElement('body');
		$headText = $document->createTextNode("hhhhhhhhhh");
		$bodyText = $document->createTextNode("BBBBBBBBBB");
		$head->appendChild($headText);
		$body->appendChild($bodyText);
		$xml->appendChild($head);
		$xml->appendChild($body);
		
		static::createHTML();
		
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
	*/
	
	public static function goHTML(){

		global $document;
		$head = "";
		$body = static::createHTML();
		$document = "<html><head>{$head}</head><body>{$body}</body></html>";
		echo $document;
	}
}
?>
