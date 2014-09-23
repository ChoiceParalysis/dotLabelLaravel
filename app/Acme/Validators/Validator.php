<?php namespace Acme\Validators;

use Validator as V;

abstract class Validator 
{

	protected $errors = [];


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


	public function getErrors()
	{
		return $this->errors;
	}

}