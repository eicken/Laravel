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

// route to show the login form
Route::get('', array('as' => 'test2', 'before' => 'authLogin','uses' => 'AuthController@showLogin'));


// route to show the login form
Route::get('login', array( 'as' => 'test', 'before' => 'authLogin',  'uses' => 'AuthController@showLogin'));


// route to process the form
Route::post('login', array('as' => 'test1', 'before' => 'authLogin','uses' => 'AuthController@doLogin'));

// route for selected language
Route::get('login/{lang?}', array('uses' => 'AuthController@setlanguage'));

//auth-protected routes for users already logged in
Route::group(array('before' => 'auth'), function()
{
	Route::resource('users', 'UserController');
	Route::resource('customers', 'CustomerController');
	Route::resource('projects', 'ProjectController');
	Route::resource('roles', 'RoleController');
	Route::resource('tickets', 'TicketController' , array('except' => array('show')));
	Route::resource('comments', 'CommentController', array('except' => array('index', 'create')));
	Route::resource('attachment', 'AttachmentController');
	#Route::get('tickets/{id?}/{file?}/{project?}/deleteattachment', array('uses' => 'TicketController@deleteattachment'));
});

//Route for editing Password; auth mechanism maybe not enough
Route::get('users/editPW/{id}', array('before' => 'auth', 'uses' => 'UserController@editPW'));
Route::post('users/updatePW/{id}', array('as' => 'updatePW', 'before' => 'auth', 'uses' => 'UserController@updatePW'));

//log out user
Route::get('logout', array('uses' => 'AuthController@getLogout'));