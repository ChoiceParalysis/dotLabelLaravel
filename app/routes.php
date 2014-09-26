<?php

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@index']);

Route::group(['prefix' => 'api/v1'], function() 
{
	Route::resource('hosts', 'HostsController');
});
