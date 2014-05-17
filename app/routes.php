<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('start', 'ServerController@createGame');
Route::any('api/update/{user_id}/{control_id}/{value}', 'ServerController@checkEvent');
Route::any('api/fail/{user_id}/{value}', 'ServerController@failEvent');

