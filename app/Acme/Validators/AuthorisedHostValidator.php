<?php namespace Acme\Validators;

class AuthorisedHostValidator extends Validator
{

	protected static $messages = [

		'unique' => 'The :attribute specified is already in the database.'

	];

	protected function rules($id = null) {
		return [

			'ipaddress' => 'required|ip|unique:authorised_host,ipaddress' . ($id ? ",$id" : ''),
			'subnet' => 'required|integer|between:1,32',
			'description' => 'required'
		];
	}



}