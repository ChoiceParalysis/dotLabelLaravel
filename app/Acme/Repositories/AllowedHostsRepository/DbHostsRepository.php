<?php namespace Acme\Repositories\AllowedHostsRepository;

use Host;

class DbHostsRepository implements HostsRepositoryInterface
{
	public function all()
	{
		$hosts = Host::all();

		return $hosts;
	}
}