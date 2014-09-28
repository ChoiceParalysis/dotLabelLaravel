<?php namespace Acme\Repositories\HostsRepository;

interface HostsRepositoryInterface
{

	/**
	 * Create a new host
	 * @param  array $attributes
	 * @return object
	 */
	public function create($attributes);

	/**
	 * Update a host
	 * @param  object $host    
	 * @param  array $updates 
	 * @return object
	 */
	public function update($host, $updates);

	/**
	 * Delete a host
	 * @param  int $id
	 * @return object
	 */
	public function delete($id);

	/**
	 * Return all items from the repository
	 */
	public function all($order, $limit);


	/**
	 * Find an item in the repository
	 * @param  int $id
	 */
	public function find($id);



}