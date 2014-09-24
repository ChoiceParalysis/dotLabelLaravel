<?php namespace Acme\Services;

use Host;
use Acme\Repositories\HostsRepository\HostsRepositoryInterface;
use Acme\Validators\AuthorisedHostValidator;
use Acme\Validators\HostValidationException;
use Acme\Exceptions\NonExistentHostException;

class AuthorisedHostsService 
{

	protected $hostRepository;
	protected $validator;

	public function __construct(HostsRepositoryInterface $hostRepository, AuthorisedHostValidator $validator)
	{
		$this->hostRepository = $hostRepository;
		$this->validator = $validator;
	}

	public function create($attributes)
	{
		if($this->validator->isValid($attributes))
		{
			return $this->hostRepository->create($attributes);

		}

		throw new HostValidationException('Host Validation failed', $this->validator->getErrors());
		
	}

	
	public function update($id, $updates)
	{		
		// refactor : only send the ID to the repository
		$host = $this->hostRepository->find($id);

		if (! $host) throw new NonExistentHostException('Host was not found.');

		if ($this->validator->isValid($updates, $host->id))
		{
			$host = $this->hostRepository->update($host, $updates);

			return $host;
		}

		throw new HostValidationException('Host Validation failed', $this->validator->getErrors());

	}


	public function delete($id)
	{
		if ( ! $this->hostRepository->delete($id))
			throw new NonExistentHostException('Host was not found.');
	}	


	public function changeState($id)
	{
		$host = $this->hostRepository->find($id);

		if (! $host) throw new NonExistentHostException('Host does not exist.');

		$host->enabled = ($host->enabled) ? 0 : 1;

		$host->save();

		return $host;

	}

}