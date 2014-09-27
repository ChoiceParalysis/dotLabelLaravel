<?php namespace Acme\Repositories\HostsRepository;

use Illuminate\Support\ServiceProvider;

class HostsRepositoryServiceProvider extends ServiceProvider
{	

	/**
	 * Service provider substitutes the HostRepositoryInterface
	 * with DbHostsRepository database implementation
	 */
	public function register()
	{
		$this->app->bind(
			'Acme\Repositories\HostsRepository\HostsRepositoryInterface',
			'Acme\Repositories\HostsRepository\DbHostsRepository'
		);
	}

}