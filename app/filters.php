<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/**
 * used for accessing all other pages. Possibly add check for rights here!
 */
Route::filter('auth', function()
{
	if (Auth::check())
	{
	    return Route::resource('users', 'UserController');
	}
	else
	{
		$message = Lang::get('messages.Please first login');
		return Redirect::to('login')->with('message', $message);	
	}
});


/**
 * checks if a user is already logged in when visting login page. Redirects to user page if already logged in, else to 
 * login page
 */
Route::filter('authLogin', function()
{

	if (Auth::check())
	{
		$message = Lang::get('messages.You are already logged in!');
		return Redirect::to('users')->with('message', $message);
	}
	else
	{
		#return Redirect::to('login');
		Route::get('login/{lang?}', array('uses' => 'AuthController@showLogin'));
	}

});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});



/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('admin', function()
{
	
});

Route::filter('guest', function()
{

});

Route::filter('supervisor', function()
{

});

Route::filter('user', function()
{

});

Route::filter('workers', function()
{

});

Route::filter('customer', function()
{

});
