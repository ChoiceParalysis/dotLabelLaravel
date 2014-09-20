<?php namespace Acme\Repositories\AllowedHostsRepository;

use Illuminate\Support\ServiceProvider;

class HostsRepositoryServiceProvider extends ServiceProvider
{

	public function register()
	{
		$this->app->bind(
			'Acme\Repositories\AllowedHostsRepository\HostsRepositoryInterface',
			'Acme\Repositories\AllowedHostsRepository\DbHostsRepository'
		);
	}

}