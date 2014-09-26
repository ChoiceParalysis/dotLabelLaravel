<?php namespace Acme\Repositories\HostsRepository;

use Host;
use Exception;

class DbHostsRepository implements HostsRepositoryInterface
{

	public function create($attributes)
	{
		return Host::create([

				'ipaddress' => $attributes['ipaddress'],
				'subnet' => $attributes['subnet'],
				'description' => $attributes['description'],
				'enabled' => isset($attributes['enabled']) ? 1 : 0

			]);
	}


	public function update($host, $updates)
	{
		$host->ipaddress = $updates['ipaddress'];
		$host->subnet = $updates['subnet'];
		$host->description = $updates['description'];
		$host->enabled = $updates['enabled'];

		$host->save();

		return $host;
	}


	public function delete($id)
	{
		$host = Host::find($id);

		if ($host)
		{
			return $host->delete();
		}
		
		return false;
	}


	public function all()
	{
		$hosts = Host::orderBy('id', 'DESC')->get();
		
		return $hosts;
	}


	public function find($id)
	{
		$host = Host::find($id);

		return $host;
	}

	
}