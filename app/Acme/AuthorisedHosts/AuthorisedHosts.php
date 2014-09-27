<?php namespace Acme\AuthorisedHosts;

use Host;
use Acme\Repositories\HostsRepository\HostsRepositoryInterface;
use Acme\Validators\AuthorisedHostValidator;
use Acme\Validators\HostValidationException;
use Acme\Exceptions\NonExistentHostException;

class AuthorisedHosts 
{

	protected $hostsRepository;
	protected $validator;

	public function __construct(HostsRepositoryInterface $hostsRepository, 
								AuthorisedHostValidator $validator)
	{
		$this->hostsRepository = $hostsRepository;
		$this->validator = $validator;
	}


	/**
	 * Get all items from the repository
	 * @param  string $order Order of collection to be retrieved
	 * @return collection host objects
	 */
	public function all()
	{
		return $this->hostsRepository->all();
	}

	/**
	 * Find an item in the repository provided
	 * @param  int $id
	 * @return object    Object containing host data
	 */
	public function find($id)
	{
		return $this->hostsRepository->find($id);
	}

	/**
	 * Create new item in the repository
	 * @param  array $attributes
	 * @return object    Object containing host data
	 */
	public function create($attributes)
	{
		if($this->validator->isValid($attributes))
		{
			return $this->hostsRepository->create($attributes);
		}

		throw new HostValidationException('Host Validation failed', $this->validator->getErrors());
		
	}

	/**
	 * Update host in the repository
	 * @param  int $id    
	 * @param  array $updates
	 * @return object
	 */
	public function update($id, $updates)
	{		
		// refactor : only send the ID to the repository
		$host = $this->hostsRepository->find($id);

		if (! $host) throw new NonExistentHostException('Host was not found.');

		if ($this->validator->isValid($updates, $host->id))
		{
			$host = $this->hostsRepository->update($host, $updates);

			return $host;
		}

		throw new HostValidationException('Host Validation failed', $this->validator->getErrors());

	}

	/**
	 * Delete an item from the repository
	 * @param  int $id
	 * @return bool
	 */
	public function delete($id)
	{
		// Check if the host was deleted successfully
		if ( ! $this->hostsRepository->delete($id))
		{
			throw new NonExistentHostException('Host was not found.', ['Host was not found.']);
		}

		return true;
	}	

	

}