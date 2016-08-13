<?php

namespace application;

//TODO add xml header

header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';

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
			$pos = strrpos($class, "/");
			$rc = substr($class,($pos+1));
			$namesp = substr($class,0,$pos);
			$namesp = str_replace('/','\\',$namesp);
			$pos = strrpos($namesp, "/");
			$rd = substr($namesp,($pos+1));
			$filename = __DIR__."/".$file;
			echo "</br>file not found:".$filename." and created";	//TODO remove below
			$text = "<?php\nnamespace {$namesp};\n\nclass {$rc} extends {$rd}Includes";
			$text .="{\n\n\tfunction handle(){\n\n\t\t\n\n\t}\n\n}\n\n?>";
			$handle = fopen($filename, "w");
			fwrite($handle, $text);
			fclose($handle);
			chmod($filename, 0777);
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
		"ps" => "packageSearch",
		"login" => "login"
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
