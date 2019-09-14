<?php

namespace Application\Models;

use \Library\Model;

class User extends Model{
	protected $table 		= "user";
	protected $primary 		= "id";
	protected $structure	= [
		"id" => [
			"type" => "int",
			"min"  => 1
		],
		"username" => [
			"type" => "string",
			"minLength" => 2,
			"maxLength" => 50
		],		
		"email" => [
			"type" => "string",
			"minLength" => 10,
			"maxLength" => 500
		], 
		"password" => [
			"type" => "string",
			"minLength" => 2,
			"maxLength" => 50
		]
	];

	public function __construct($pdoObject){
		parent::__construct($pdoObject);
	}
}