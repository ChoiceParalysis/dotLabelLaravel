<?php

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@index']);

Route::group(['prefix' => 'api/v1'], function() {

	//Route::resource('hosts', 'HostsController', ['only' => ['index', 'store', 'update', 'destroy']]);

	Route::get('hosts', 'HostsController@index');

	Route::post('hosts', 'HostsController@store');

	Route::post('hosts/{id}/update', 'HostsController@update');

	Route::delete('/hosts/{id}', 'HostsController@destroy');

});



Route::delete('hosts/{id}', ['as' => 'hosts.destroy', 'uses' => 'HostsController@destroy']);