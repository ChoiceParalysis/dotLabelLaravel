<?php namespace Acme\Facades;

use Illuminate\Support\Facades\Facade;

class AuthorisedHosts extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'authorisedhosts';
	}

}