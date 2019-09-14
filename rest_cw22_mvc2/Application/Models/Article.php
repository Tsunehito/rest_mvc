<?php

namespace Application\Models;

use \Library\Model;

class Article extends Model{
	protected $table 		= "article";
	protected $primary 		= "id";
	protected $structure	= [
		"id" => [
			"type" => "int",
			"min"  => 1
		],
		"title" => [
			"type" => "string",
			"minLength" => 2,
			"maxLength" => 50
		], 
		"content" => [
			"type" => "string",
			"minLength" => 10,
			"maxLength" => 500
		]
	];

	public function __construct($pdoObject){
		parent::__construct($pdoObject);
	}
}