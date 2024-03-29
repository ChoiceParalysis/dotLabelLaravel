<?php namespace Acme\Validators;

use Exception;

class HostValidationException extends Exception
{

	protected $errors;

	public function __construct($message, $errors, $code = 0, Exception $previous = null)
	{
		$this->errors = $errors;
		parent::__construct($message, $code, $previous);
	}

	/**
	 * Array of errors
	 * @return array
	 */
	public function getErrors()
	{
		return $this->errors;
	}	

}