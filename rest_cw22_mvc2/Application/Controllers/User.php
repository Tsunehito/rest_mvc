<?php

namespace Application\Controllers;

use \Library\Controller;
use \Library\Database;
use \Application\Models\User as UserModel;

class User extends Controller {
	public function getAction($data){
		$id = $data["id"] ?? 0;

		$user = new UserModel(Database::get());

		$result = ($id===0)?$user->findAll(): $user->findByPrimary($id);

		$this->setResponseBody($result, empty($result)?404:200);
	}

	public function postAction($data){
		$user = new UserModel(Database::get());

		$error = $user->validationData($data);

		if(empty($error)){
			$result = $user->insert($data);
			$this->setResponseBody($result, 201);
		}else{
			$this->setResponseBody([], 422, $error);
		}	

		//$this->setResponseBody("nok", 422);
	}

	public function putAction($data){
		$user = new UserModel(Database::get());
		$error = $user->validationData($data);
		if(empty($error)){
			$result = $user->updateByPrimary($data);
			$this->setResponseBody($result, 200);
		}else{
			$this->setResponseBody([], 422, $error);
		}
	}

	public function deleteAction($data){
		$id 		= $data['id'] ?? 0;
		$user 	= new UserModel(Database::get());
		$user->deleteByPrimary($id);
		$this->setResponseBody("", 204);
	}

}