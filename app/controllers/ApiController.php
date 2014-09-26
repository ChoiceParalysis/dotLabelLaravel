<?php

class ApiController extends BaseController
{

	protected $statusCode = 200;
	protected $apiStatusCode = 215;
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


	public function setApiStatusCode($code)
	{
		$this->apiStatusCode = $code;

		return $this;
	}


	public function getApiStatusCode()
	{
		return $this->apiStatusCode;
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


	public function respondCreated($data, $message = 'Created successfully.')
	{
		return $this->respond([
			'data' => $data,
			'message' => $message
		]);
	}


	public function respondUpdated($data, $message = 'Updated successfully.')
	{
		return $this->respond([
			'data' => $data,
			'message' => $message
		]);
	}


	public function respondNotFound($message = 'Not found.')
	{
		return $this->setStatusCode(404)->respondWithErrors($message);
	}


	public function respondUnprocessableEntity($errors, $message = 'Unprocessable Entity.')
	{
		return $this->setStatusCode(422)->setErrors($errors)->respondWithErrors($message);
	}


	public function respondWithErrors($message)
	{
		return $this->respond([
			'errors' => $this->getErrors(),
			'message' => $message,
			'code' => $this->getApiStatusCode()
		]);
	}


	public function respond($data, $headers = [])
	{
		return Response::json($data, $this->getStatusCode(), $headers);
	}
	
}