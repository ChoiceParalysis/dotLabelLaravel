<?php namespace Acme\Repositories\HostsRepository;

use Host;
use Exception;

class DbHostsRepository implements HostsRepositoryInterface
{

	/**
	 * Create a new host object in the database
	 * @param  array $attributes 
	 * @return object Object containing a new host values
	 */
	public function create($attributes)
	{
		return Host::create([

				'ipaddress' => $attributes['ipaddress'],
				'subnet' => $attributes['subnet'],
				'description' => $attributes['description'],
				'enabled' => isset($attributes['enabled']) ? 1 : 0

			]);
	}

	/**
	 * Update a host in the database
	 * @param  object $host    Original host object
	 * @param  array $updates 
	 * @return object          Object containing updated values
	 */
	public function update($host, $updates)
	{
		$host->ipaddress = $updates['ipaddress'];
		$host->subnet = $updates['subnet'];
		$host->description = $updates['description'];
		$host->enabled = $updates['enabled'];

		$host->save();

		return $host;
	}

	/**
	 * Delete a host from the database
	 * @param  int $id 
	 * @return bool 
	 */
	public function delete($id)
	{
		$host = Host::find($id);

		return ($host) ? $host->delete() : false;
	}

	/**
	 * Get all host objects from the database
	 * @param  string $order ASC or DESC
	 * @return collection        
	 */
	public function all($order = 'DESC', $limit = 5)
	{
		
		$hosts = Host::orderBy('id', $order)->paginate($limit);

		return $hosts;
	}

	/**
	 * 
	 * @param  int $id 
	 * @return object 
	 */
	public function find($id)
	{
		$host = Host::find($id);

		return $host;
	}

	
}