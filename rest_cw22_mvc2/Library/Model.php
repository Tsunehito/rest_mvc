<?php

namespace Library;

abstract class Model{

	protected $pdoObject;

	public function __construct($pdoObject){
		$this->pdoObject = $pdoObject;
	}

	public function findByPrimary($primary, String $fields = NULL){

        if($fields == NULL) {
            $fields = "*";
        }

        $stmt = $this->pdoObject->prepare("SELECT {$fields} FROM `{$this->table}` WHERE `{$this->primary}` = :primary");

		$stmt->execute(["primary"=>$primary]);

		return $stmt->fetchAll();
	}

	public function findAll(String $fields = NULL, String $where = NULL){

        if($fields == NULL) {
            $fields = "*";
        }

        if($where == NULL) {
            $where = "1";
        }

        $stmt = $this->pdoObject->prepare("SELECT {$fields} FROM `{$this->table}` WHERE {$where}");
		$stmt->execute();

		return $stmt->fetchAll();


	}

	public function insert(Array $data){
		$listField = implode(',', array_keys($data));
		$listValue = ':' . implode(',:', array_keys($data));
		$stmt = $this->pdoObject->prepare("INSERT INTO `{$this->table}` ({$listField}) VALUES ({$listValue})");
		$stmt->execute($data);

		$lastID = $this->pdoObject->lastInsertId();
		return $this->findByPrimary($lastID);
	}

	public function updateByPrimary(Array $data){
		$listData = "";

		foreach ($data as $field => $value) {
			if($field == $this->primary){
				continue;
			}
			$listData .= "`$field`=:$field,";
			
		}
		$listData = substr($listData,0,-1);
		//retire la dernière virgule.

		$stmt = $this->pdoObject->prepare("UPDATE `{$this->table}` SET {$listData}  WHERE `{$this->primary}` = :{$this->primary}");
		$stmt->execute($data);
		return $this->findByPrimary($data[$this->primary]);
		
	}

	public function deleteByPrimary($primary){
		$stmt = $this->pdoObject->prepare("DELETE FROM `{$this->table}` WHERE `{$this->primary}` = :primary");
		return $stmt->execute(["primary"=>$primary]);
	}

	public function validationData(Array $data): Array {
		$error = [];

		foreach ($data as $field => $value) {
			if(array_key_exists($field, $this->structure)){
				foreach ($this->structure[$field] as $rule => $constraint) {
					if($rule == 'type' && $constraint == 'string' && !is_string($value)){
						array_push($error, "Bad type in Field '$field'");
					}

					if($rule == 'type' && $constraint == 'int' && !is_numeric($value)){
						array_push($error, "Bad type in Field '$field'");
					}

					if($rule == 'type' && $constraint == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)){
						array_push($error, "Bad type in Field '$field'");
					}

					if($rule == 'min' && $value<$constraint){
						array_push($error, "Min value is '$constraint' in field '$field'"); 
					}

					if($rule == 'max' && $value>$constraint){
						array_push($error, "Max value is '$constraint' in field '$field'"); 
					}

					if($rule == 'minLength' && strlen($value)<$constraint){
						array_push($error, "minLength value is '$constraint' in field '$field'"); 
					}

					if($rule == 'maxLength' && strlen($value)>$constraint){
						array_push($error, "maxLength value is '$constraint' in field '$field'");  
					}

				}

				}else{
					array_push($error, "Field '$field' doesn't exist");
			}
		}
		return $error;
	}
}

