<?php

namespace Library;

abstract class Controller{

	private $responseType = "application/json";
	private $responseCode = 200;
	private $responseBody = null;
	private $responseHeader= [];

	public function addResponseHeader(String $key, ?String $value) : void{
		$this->responseHeader[$key] = $value;

	} 

	public function clearAllResponseHeader(){
		$this->responseHeader = [];
	}

	public function clearOneResponseHeader(String $key): void{
		if(array_key_exists($key, $this->responseHeader))
			unset($this->responseHeader[$key]);

	}

	public function listResponseHeader(): Array{
		return $this->responseHeader;
	}



	public function setResponseType(String $type) : Void {
		$possibilities = [
			"json" 	=> "application/json",
			"xml" 	=> "application/xml",
			"txt" 	=>  "text/plain"
		];
		if(array_key_exists(strtolower($type), $possibilities)){
			$this->responseType = $possibilities[$type];
		}
	}

	public function getResponseType() : String {
		return $this->responseType;	
	}

	public function setReponseCode(int $code):void{
		$this->responseCode = $code;
	}

	public function getResponseCode(): Int{
		return $this->responseCode;
	}

	public function setResponseBody($message, $code, $errorMessage = "") : Void {

		if(is_numeric($code)){
			$this->responseCode= $code;
		}
		$this->responseBody = new \StdClass();
		$this->responseBody->message = $message;
		$this->responseBody->messageError = $errorMessage;
		$this->responseBody->error = !empty($errormessage);
	}

	public function getResponseBody() {
		return $this->responseBody;
	}

	public function __destruct(){
		header("Content-type: " . $this->getResponseType() . ",charset=utf-8");
		foreach ($this->listResponseHeader() as $key => $value) {
			header($key . ":" . $value);
		}

		http_response_code($this->getResponseCode());

			echo json_encode($this->getResponseBody(), JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
	}
}