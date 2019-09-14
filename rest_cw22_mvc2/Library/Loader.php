<?php 

namespace Library;

class Loader{
	public static function startAutoload(){
		spl_autoload_register([__CLASS__, 'autoload']);
	}

	public static function getClassPath(String $className): String{
		$DS = DIRECTORY_SEPARATOR;
//		var_dump($className);
		return __DIR__."{$DS}..{$DS}".str_replace('\\', $DS, $className).".php";

	}

	private static function autoload($className){
		$path = self::getClassPath($className);
		//var_dump($path);
		if(!file_exists($path)){
			throw new \Exception("Error Autoloader: class '$path' not found");
		}
		require_once($path);

	}

}