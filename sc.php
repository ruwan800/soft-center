<?php

namespace application;

//TODO add xml header
/*
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
*/

//echo $_SERVER['REQUEST_URI'].'<br />';


/*** class Loader ***/
class classLoader {

	public static function autoLoad($class){
		$class = str_replace('\\','/',$class);
		$filename = strtolower($class).'.php';

		$file =$filename;

		
		if (file_exists($file)){
			include $file;
		}
		else {
			echo "</br>file not found:".__DIR__."/".$file;
		}
	}
}
spl_autoload_register('application\classLoader::autoLoad');



global $action;
if(isset($_GET["action"])){
	$action = $_GET["action"];
	$request = getPage($action);
}
else{
	$request='linkError';
}
$request="application\\controller\\{$request}";
$request::handle();



function getPage($key){

	$pageArray = array(
		"ps" => "packageSearch"
	);
	if(array_key_exists($key,$pageArray)){
		$value = $pageArray[$key];
	}
	else{
		$value='linkError';
	}
	return $value;
}



?>
