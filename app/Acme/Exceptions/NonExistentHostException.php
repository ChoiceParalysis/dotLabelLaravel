<?php namespace Acme\Exceptions;

use Exception;

class NonExistentHostException extends Exception
{
	
	protected $errors;


	public function __construct($message, $errors, $code = 0, Exception $previous = NULL)
	{
		parent::__construct($message, $code, $previous);
		$this->errors = $errors;
	}

	/**
	 * Get errors from the exception
	 * @return array Array containing errors
	 */
	public function getErrors()
	{
		return $this->errors;
	}

}