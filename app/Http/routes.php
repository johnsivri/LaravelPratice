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
  'as'    =>  'edit_task',
  'uses'  =>  'TaskController@edit'
]);
Route::post('/task', 'TaskController@store');
Route::post('/task/edit/{task}', 'TaskController@update');
Route::delete('/task/{task}', 'TaskController@destroy');
