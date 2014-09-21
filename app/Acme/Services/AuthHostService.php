<?php namespace Acme\Services;

use Acme\Repositories\AllowedHostsRepository\HostsRepositoryInterface;
use Acme\Validators\HostValidationException;
use Acme\Validators\AuthorisedHostValidator;
use Host;

class AuthHostService 
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
			Host::create([
				'ipaddress' => $attributes['ipaddress'],
				'subnet' => $attributes['subnet'],
				'description' => $attributes['description'],
				'enabled' => isset($attributes['enabled']) ?: 0
			]);

			return true;
		}

		throw new HostValidationException('Host Validation failed', $this->validator->getErrors());
		
	}

	public function changeState($id)
	{
		$host = $this->hostRepository->find($id);

		if (! $host) throw new NonExistentHostException;

	}

}