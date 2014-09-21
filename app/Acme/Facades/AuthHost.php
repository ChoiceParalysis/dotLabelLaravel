<?php namespace Acme\Facades;

use Illuminate\Support\Facades\Facade;

class AuthHost extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'AuthHost';
	}

}