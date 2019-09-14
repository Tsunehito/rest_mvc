<?php 

namespace Library;

class Settings{

	protected static $settings;

	public static function start(){
		$DS = DIRECTORY_SEPARATOR;
		$path = __DIR__."{$DS}..{$DS}Application{$DS}Settings.json";
		self::$settings = json_decode(file_get_contents($path), true);
	}

	public static function get(String $key){
		$keys = explode('.', $key);
		return array_reduce($keys, function($carry, $item){
			return $carry[$item];
		}, self::$settings);
		/**
		 * récursive
		 * si "db:name" => passe d'abord dans le tableau db puis trouve name dedans
		 */
	}
}