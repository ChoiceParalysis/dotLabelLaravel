<?php namespace Acme\Validators;

class AuthorisedHostValidator extends Validator
{

	/**
	 * Array containing error messages
	 * @var array
	 */
	protected static $messages = [

		'unique' => 'The :attribute specified is already in the database.'

	];

	/**
	 * Array containing host validation rules
	 * @param  int $id Host ID used during updating
	 * @return array 
	 */
	protected function rules($id = null) {
		return [

			'ipaddress' => 'required|ip|unique:authorised_host,ipaddress' . ($id ? ",$id" : ''),
			'subnet' => 'required|integer|between:1,32',
			'description' => 'required'
		];
	}



}