<?php namespace Acme\AuthorisedHosts;

use Illuminate\Support\ServiceProvider;

class AuthorisedHostsServiceProvider extends ServiceProvider
{
	/**
	 * Register a new binding
	 */
	public function register()
	{
		$this->app->bind('authorisedhosts', 'Acme\AuthorisedHosts\AuthorisedHosts');
	}

}