<?php namespace Acme\ServiceProviders;

use Illuminate\Support\ServiceProvider;

class AuthHostServiceProvider extends ServiceProvider 
{

	public function register()
	{
		$this->app->bind('AuthHost', 'Acme\Services\AuthHostService');
	}

}