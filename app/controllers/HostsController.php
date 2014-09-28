<?php

use Acme\Repositories\HostsRepository\HostsRepositoryInterface;
use Acme\Validators\HostValidationException;
use Acme\Exceptions\NonExistentHostException;
use Acme\Transformers\HostTransformer;

class HostsController extends ApiController {


	protected $transformer;

	/**
	 *	 
	 * @param HostTransformer $transformer 
	 */
	public function __construct(HostTransformer $transformer)
	{
		$this->transformer = $transformer;

		$this->beforeFilter('auth.basic', ['on' => ['post', 'patch', 'delete']]);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return json object containing hosts data
	 */
	public function index()
	{
		// Fetch all hosts using the facade
		$hosts = AuthorisedHosts::all('DESC', 10);

		return $hosts;
	}

	/**
	 * Method to display information about a specific host
	 * @param  int $id Host ID in the repository
	 * @return json object containing host data or error messages
	 */
	public function show($id)
	{
		// Find a host using the facade
		$host = AuthorisedHosts::find($id);

		if (! $host)
		{
			return $this->respondNotFound();
		}

		return $this->respond([
			'data' => $this->transformer->transform($host)
		]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return json object containing newly created host object's data 
	 *         or an object containing error
	 */
	public function store()
	{	
		try 
		{
			// Create a host using the facade
			$host = AuthorisedHosts::create(Input::all());

			return $this->respondCreated($this->transformer->transform($host), 'Host created successfully.');
		}

		catch(HostValidationException $e)
		{
			return $this->respondUnprocessableEntity($e->getErrors());
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id Host ID in the repository
	 * @return json object containing updated host object or error messages
	 */
	public function update($id)
	{
		try 
		{
			// Update a host using the facade
			$host = AuthorisedHosts::update($id, Input::all());

			return $this->respondUpdated($this->transformer->transform($host));
		}

		catch(HostValidationException $e)
		{
			return $this->respondUnprocessableEntity($e->getErrors(), 'Parameters failed validation.');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id Host ID in the repository
	 * @return json object containing success or error messages
	 */
	public function destroy($id)
	{
		try {
			if (AuthorisedHosts::delete($id))
			{
				return $this->respondDeleted('Host deleted successfully.');
			}
		}

		catch(NonExistentHostException $e)
		{
			return $this->setErrors($e->getErrors())->respondNotFound();
		}

		
	}


}
