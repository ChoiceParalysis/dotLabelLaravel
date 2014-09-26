<?php

class ApiController extends BaseController
{


	/**
	 * HTTP status code
	 * @var integer
	 */
	protected $statusCode = 200;

	/**
	 * API status code
	 * @var integer
	 */
	protected $apiStatusCode = 215;

	/**
	 * Array containing error messages
	 * @var array
	 */
	protected $errors = [];


	/**
	 * Set the HTTP status code for the response
	 * @param int $code HTTP status code
	 */
	public function setStatusCode($code)
	{
		$this->statusCode = $code;

		return $this;
	}

	/**
	 * Get the current HTTP status code
	 * @return int
	 */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * Set API status code
	 * @param int $code API Status code
	 */
	public function setApiStatusCode($code)
	{
		$this->apiStatusCode = $code;

		return $this;
	}

	/**
	 * Get API status code
	 * @return int
	 */
	public function getApiStatusCode()
	{
		return $this->apiStatusCode;
	}

	/**
	 * Set errors array value
	 * @param array $errors Array of errors
	 */
	public function setErrors($errors)
	{
		$this->errors = $errors;

		return $this;
	}

	/**
	 * Get errors array
	 * @return array 
	 */
	public function getErrors()
	{
		return $this->errors;
	}

	/**
	 * Response for a successfully created item
	 * @param  array $data    Array containing item's data
	 * @param  string $message Success message
	 * @return json object containing items data and a success message
	 */
	public function respondCreated($data, $message = 'Created successfully.')
	{
		return $this->setStatusCode(201)->respond([
			'data' => $data,
			'message' => $message
		]);
	}

	/**
	 * Response to successfully updated item
	 * @param  array $data     Array containing updated item's data
	 * @param  string $message Success messsage
	 * @return json object containing item's data and a success message
	 */
	public function respondUpdated($data, $message = 'Updated successfully.')
	{
		return $this->respond([
			'data' => $data,
			'message' => $message
		]);
	}

	/**
	 * Response to successfully deleted item
	 * @param  String $message Success message
	 * @return json object containing success message
	 */
	public function respondDeleted($message = 'Deleted successfully.')
	{
		return $this->setStatusCode(201)->respond([
			'message' => $message
		]);
	}

	/**
	 * Response to item not found
	 * @param  string $message
	 * @return json object containing descriptive message 
	 */
	public function respondNotFound($message = 'Not found.')
	{
		return $this->setStatusCode(404)->respondWithErrors($message);
	}

	/**
	 * Response to an unprocessable entity
	 * @param  array $errors  Array containing error messages
	 * @param  string $message 
	 * @return json object containing errors and a descriptive message of the error
	 */
	public function respondUnprocessableEntity($errors, $message = 'Unprocessable Entity.')
	{
		return $this->setStatusCode(422)->setErrors($errors)->respondWithErrors($message);
	}

	/**
	 * Response containing errors
	 * @param  string $message
	 * @return json object containing errors, descriptive error message and 
	 *         an API code
	 */
	public function respondWithErrors($message)
	{
		return $this->respond([
			'errors' => $this->getErrors(),
			'message' => $message,
			'code' => $this->getApiStatusCode()
		]);
	}

	/**
	 * Response containing data and optional headers
	 * @param  array $data    
	 * @param  array $headers
	 * @return json object containing objects data, API status code and headers
	 */
	public function respond($data, $headers = [])
	{
		return Response::json($data, $this->getStatusCode(), $headers);
	}
	
}