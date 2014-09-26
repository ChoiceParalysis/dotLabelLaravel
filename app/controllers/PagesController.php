<?php

class PagesController extends BaseController
{
	

	/**
	 * 
	 * @return index
	 */
	public function index()
	{
		return View::make('pages.index');
	}

}