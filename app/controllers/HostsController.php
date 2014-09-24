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


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try {

			$host = AuthorisedHosts::create(Input::all());

			return $this->respond([
				'data' => $this->transformer->transform($host)
			]);	

		}

		catch(HostValidationException $e)
		{
			return $this->respondBadRequest($e->getErrors());
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
			return AuthorisedHosts::update($id, Input::all());
		}

		catch(HostValidationException $e)
		{
			return Response::json($e->getErrors(), 400);
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
			return AuthorisedHosts::delete($id);
		}

		catch(NonExistentHostException $e)
		{
			return $e->getErrors();
		}

		
	}


}
