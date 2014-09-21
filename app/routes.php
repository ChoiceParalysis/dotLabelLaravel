<?php

Route::get('/', 'PagesController@index');

Route::get('hosts', 'HostsController@index');

Route::post('hosts', 'HostsController@store');

//Route::get('hosts', ['as' => 'home', 'uses' => 'HostsController@index']);

Route::post('hosts/{id}/change-state', 'HostsController@changeState');



Route::get('/hosts', 'HostsController@index');

Route::delete('hosts/{id}', ['as' => 'hosts.destroy', 'uses' => 'HostsController@destroy']);