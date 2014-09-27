<?php

class PagesController extends BaseController
{
	

	/**
	 * 
	 * @return view
	 */
	public function index()
	{
		return View::make('pages.index');
	}

}