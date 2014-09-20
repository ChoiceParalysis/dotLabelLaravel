<?php

Route::get('/', ['as' => 'home', 'uses' => 'HostsController@index']);

Route::resource('hosts', 'HostsController');

Route::get('/hosts', 'HostsController@index');

Route::delete('hosts/{id}', ['as' => 'hosts.destroy', 'uses' => 'HostsController@destroy']);