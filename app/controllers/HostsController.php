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

		return View::make('hosts.index', compact('hosts'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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

			// 
		}

		catch(HostValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}

		return Redirect::home();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return 'hi';
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
