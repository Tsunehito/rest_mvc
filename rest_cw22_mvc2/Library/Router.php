<?php 

namespace Library;

class Router{

	private static function getActionName(){
		return strtolower($_SERVER['REQUEST_METHOD']) . "Action";
	} 

	private static function getControllerName(String $name) : String{
		return '\Application\Controllers\\' . ucfirst(strtolower($name));
	}

		private static function getControllerPath(String $name) : String{
				$DS = DIRECTORY_SEPARATOR;
		return __DIR__."{$DS}..{$DS}Application{$DS}Controllers{$DS}" . ucfirst(strtolower($name)) . ".php";
	}

	public static function dispatchPage(String $resource ){
		$controller = "";
		$method 	= "";
		$parameters	= [];

		if(file_exists(self::getControllerPath($resource)) && class_exists(self::getControllerName($resource))){
			$controller = self::getControllerName($resource);
			$controller = new $controller;
		} else {
			http_response_code(404);
			exit;
		}
		if(method_exists($controller, self::getActionName())){
			$action = self::getActionName();
			switch ($_SERVER['REQUEST_METHOD']) {
				case "GET" :
				case "DELETE" : 
					$parameters = $_GET;
					break;
				case "PATCH" :
				case "PUT" :
				case "POST" :
					parse_str(file_get_contents('php://input'), $parameters);
					break;
				default :
					http_response_code(400);
			}
		} else {
			http_response_code(404);
			exit;
		}

		$controller->$action($parameters);
	}
}