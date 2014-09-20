<?php namespace Acme\Validators;

class AuthorisedHostValidator extends Validator
{

	protected static $rules = [

		'ipaddress' => 'required|ip|unique:authorised_host',
		'subnet' => 'required|integer|between:1,32',
		'description' => 'required'

	];

	protected static $messages = [

		'unique' => 'The :attribute specified is already in the database.'

	];

}