<?php

class ApiController extends BaseController
{

	protected $statusCode = 200;
	protected $errors = [];


	public function setStatusCode($code)
	{
		$this->statusCode = $code;

		return $this;
	}


	public function getStatusCode()
	{
		return $this->statusCode;
	}


	public function setErrors($errors)
	{
		$this->errors = $errors;

		return $this;
	}


	public function getErrors()
	{
		return $this->errors;
	}	


	public function respondNotFound($message = 'Not found.')
	{
		return $this->setStatusCode(404)->respondWithErrors($message);
	}


	public function respondBadRequest($errors, $message = 'Bad request.')
	{
		return $this->setStatusCode(400)->setErrors($errors)->respondWithErrors($message);
	}


	public function respondWithErrors($message)
	{
		return $this->respond([
			'error' => [
				'message' => $message,
				'code' => $this->getApiCode(),
				'errors' => $this->getErrors()
			]
		]);
	}


	public function respond($data, $headers = [])
	{
		return Response::json($data, $this->getStatusCode(), $headers);
	}
	
}