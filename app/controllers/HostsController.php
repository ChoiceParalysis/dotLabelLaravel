<?php

use Acme\Repositories\AllowedHostsRepository\HostsRepositoryInterface;
use Acme\Services\HostCreatorService;
use Acme\Validators\HostValidationException;

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
			$this->hostCreator->create(Input::all());
		}

		catch(HostValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
		//
	}


}
