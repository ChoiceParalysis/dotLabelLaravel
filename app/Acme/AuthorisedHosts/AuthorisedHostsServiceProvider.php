<?php namespace Acme\AuthorisedHosts;

use Illuminate\Support\ServiceProvider;

class AuthorisedHostsServiceProvider extends ServiceProvider
{

	public function register()
	{
		$this->app->bind('authorisedhosts', 'Acme\AuthorisedHosts\AuthorisedHosts');
	}

}