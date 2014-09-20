<?php namespace Acme\Services;

use Acme\Validators\AuthorisedHostValidator;
use Acme\Validators\HostValidationException;
use Host;
use Redirect;

class HostCreatorService
{

	protected $validator;
	
	public function __construct(AuthorisedHostValidator $validator)
	{
		$this->validator = $validator;
	}

	public function create($attributes)
	{
		if ($this->validator->isValid($attributes))
		{
			Host::create($attributes);
			return Redirect::home();
		}

		throw new HostValidationException('Host validation failed.', $this->validator->getErrors());
	}	

}