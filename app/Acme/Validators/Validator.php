<?php namespace Acme\Validators;

use Validator as V;

abstract class Validator 
{

	protected $errors = [];

	/**
	 * Check if supplied attributes pass the validation
	 * @param  array  $attributes 
	 * @param  int  $id ID of host if the host is being updated
	 * @return boolean
	 */
	public function isValid($attributes, $id = null)
	{
		$v = V::make($attributes, $this->rules($id), static::$messages);

		if ($v->fails())
		{
			$this->errors = $v->messages();
			return false;
		}

		return true;
	}
	
	/**
	 * Get validation errors
	 * @return array 
	 */
	public function getErrors()
	{
		return $this->errors;
	}

}