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


	public function all()
	{
		return $this->hostsRepository->all();
	}


	public function find($id)
	{
		return $this->hostsRepository->find($id);
	}


	public function create($attributes)
	{
		if($this->validator->isValid($attributes))
		{
			return $this->hostsRepository->create($attributes);
		}

		throw new HostValidationException('Host Validation failed', $this->validator->getErrors());
		
	}

	
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


	public function delete($id)
	{
		if ( ! $this->hostsRepository->delete($id))
			throw new NonExistentHostException('Host was not found.', ['Host was not found.']);

		return true;
	}	


	public function changeState($id)
	{
		$host = $this->hostsRepository->find($id);

		if (! $host) throw new NonExistentHostException('Host does not exist.');

		$host->enabled = ($host->enabled) ? 0 : 1;

		$host->save();

		return $host;

	}

}