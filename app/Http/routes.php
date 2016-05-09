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
| User profile controller
*/
Route::get('/profile', 'UserController@getProfile');
Route::patch('/profile/{id}, UserController@edit');
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
Route::get('/tasks/alerts', 'TaskController@alerts');
Route::get('/tasks/archive', 'TaskController@getArchive');                    // Linked
Route::post('/task', 'TaskController@store');
Route::patch('/task/edit/{id}', 'TaskController@update');
Route::post('/tasks/{id}', 'TaskController@complete');
Route::post('/tasks/archive/{id}', 'TaskController@archive');                  // Linked
Route::delete('/task/{task}', 'TaskController@destroy');
