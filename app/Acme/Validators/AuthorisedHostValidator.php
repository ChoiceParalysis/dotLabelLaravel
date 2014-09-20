<?php namespace Acme\Validators;

class AuthorisedHostValidator extends Validator
{

	protected static $rules = [

		'ipaddress' => 'required|ip',
		'subnet' => 'required|integer|between:1,32',
		'description' => 'required'

	];

}