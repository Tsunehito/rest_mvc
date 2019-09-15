<?php

namespace Application\Controllers;

use \Library\Controller;
use \Library\Database;
use \Application\Models\Article as ArticleModel;

class Article extends Controller {
	public function getAction($data){
		$id = $data["id"] ?? 0;

		$article = new ArticleModel(Database::get());

		$result = ($id===0)?$article->findAll(): $article->findByPrimary($id);

		$this->setResponseBody($result, empty($result)?404:200);
	//	$this->setResponseBody("ok", 422);
	}

	public function postAction($data){
		$article = new ArticleModel(Database::get());

		$error = $article->validationData($data);

        if(empty($error)){
            $result = $article->insert($data);
            $this->setResponseBody($result, 201);
		}else{
			$this->setResponseBody([], 422, $error);
		}	

		//$this->setResponseBody("nok", 422);
	}

	public function putAction($data){
		$article = new ArticleModel(Database::get());
		$error = $article->validationData($data);
		if(empty($error)){
			$result = $article->updateByPrimary($data);
			$this->setResponseBody($result, 200);
		}else{
			$this->setResponseBody([], 422, $error);
		}
	}

	public function deleteAction($data){
		$id 		= $data['id'] ?? 0;
		$article 	= new ArticleModel(Database::get());
		$article->deleteByPrimary($id);
		$this->setResponseBody("", 204);
	}

}