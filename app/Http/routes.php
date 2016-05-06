<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
| Authentication routes
*/
Route::auth();

/*
| Home controller
*/
Route::get('/home', 'HomeController@index');

/*
| Task controller
*/
Route::get('/tasks', 'TaskController@index');
Route::get('/tasks/edit/{task}', [
  'uses'  =>  'TaskController@edit',
  'as'    =>  'edit_task'
]);
Route::post('/task', 'TaskController@store');
Route::post('/task/edit/{id}', 'TaskController@update');
Route::post('/tasks/{id}', 'TaskController@complete');
Route::post('/tasks/archive/{id}', 'TaskController@archive');
Route::delete('/task/{task}', 'TaskController@destroy');
