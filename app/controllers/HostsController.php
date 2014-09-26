<?php

use Acme\Repositories\HostsRepository\HostsRepositoryInterface;
use Acme\Validators\HostValidationException;
use Acme\Exceptions\NonExistentHostException;
use Acme\Transformers\HostTransformer;

class HostsController extends ApiController {


	protected $transformer;


	public function __construct(HostTransformer $transformer)
	{
		$this->transformer = $transformer;

		$this->beforeFilter('auth.basic', ['on' => ['post', 'delete']]);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$hosts = AuthorisedHosts::all();

		return $this->respond([
			'data' => $this->transformer->transformCollection($hosts->toArray())
		]);
	}


	public function show($id)
	{
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
	 * @return Response
	 */
	public function store()
	{	
		try 
		{
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
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try 
		{
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
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try {
			if (AuthorisedHosts::delete($id))
			{

				return $this->respondDeleted();

				return $this->respond([
					'data' => [
						'message' => 'Post deleted successfully.'
						]	
					]);
			}
		}

		catch(NonExistentHostException $e)
		{
			return $this->setErrors($e->getErrors())->respondNotFound();
		}

		
	}


}
