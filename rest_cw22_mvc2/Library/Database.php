<?php 

namespace Library;

class Database{

	protected static $config = [];
	protected static $db = null;

	public static function connect(Array $config){	
		self::$db = new \PDO("mysql:host={$config['host']};dbname={$config['name']}", $config['user'], $config['pass']);
		self::$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
		self::$db->exec("SET CHARACTER SET {$config['charset']}");
	}

	public static function get(){
		return self::$db;
	}


}