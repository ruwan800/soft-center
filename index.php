<?php
namespace application;
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
			echo ":P";
		}
	}
}
namespace views;
spl_autoload_register('application'.'\classLoader::autoLoad');

namespace models;
spl_autoload_register('application'.'\classLoader::autoLoad');

namespace controller;
spl_autoload_register('application'.'\classLoader::autoLoad');

namespace views;
new hell;

hell::helloi();

namespace Foobar;
new hello;

hello::helloi();




?>

