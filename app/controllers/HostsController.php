<?php

use Acme\Repositories\AllowedHostsRepository\HostsRepositoryInterface;
use Acme\Services\HostCreatorService;
use Acme\Validators\HostValidationException;
use Acme\Exceptions\NonExistentHostException;

class HostsController extends \BaseController {

	protected $hostRepository;
	protected $hostCreator;

	public function __construct(HostsRepositoryInterface $hostRepository, HostCreatorService $hostCreator)
	{
		$this->hostRepository = $hostRepository;
		$this->hostCreator = $hostCreator;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$hosts = $this->hostRepository->all();

		return $hosts;

		//return View::make('hosts.index', compact('hosts'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try {
			AuthHost::create(Input::all());
			
			return Response::json(['success' => 'Added successfully.']);
		}

		catch(HostValidationException $e)
		{
			return Response::json($e->getErrors(), 408);
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
			return AuthHost::changeState($id);
		}

		catch(NonExistentHostException $e)
		{
			return $e->getErrors();
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
		$host = $this->hostRepository->find($id);

		return $host;
	}

	public function changeState($id)
	{
		try {
			return AuthHost::changeState($id);
		}

		catch(NonExistentHostException $e)
		{
			dd('exception');
		}

	}


}
