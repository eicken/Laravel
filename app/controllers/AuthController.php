<?php
class AuthController extends BaseController 
{
	
	public function _construct() 
	{
		// get language from Session
		$lang = Session::get('lang');
		
		// if no language selected set German as default.
		if (empty($lang)){Session::put('lang', 'de');}
		App::setLocale(Session::get('lang'));
		
	}
	
	public function setlanguage($lang = null)
	{
	
		//Selected Language is german
		if($lang == '1')
		{
			//put infos in Session
			$session_lang = Session::put('lang', 'de');
			Config::set('app.locale', 'de');
			App::setLocale('de');
			Session::put('locale', 'de');
			return Redirect::to('login');
		}
	
	
		//Selected Language is English
		elseif($lang == '2')
		{
			//put infos in Session
			$session_lang = Session::put('lang', 'en');
			Config::set('app.locale', 'en');
			App::setLocale('en');
			Session::put('locale', 'en');
			return Redirect::to('login');
		}
	}
	
	public function showLogin() 
	{
		//show login page
		return View::make("login");
	}
	
	public function doLogin()
	{
	// get input field values
		$post_email    = Input::get('email');
		$post_password = Input::get('password');
		
		// get user from database
		$user_data     = DB::table('user')->where('email', $post_email)->first();


		// validate the info, create rules for the inputs
		$rules = array(
		'email'    => 'required|email', // make sure the email is an actual email
		'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		);
		
		//set current locale to de
		#App::setLocale(Session::get('lang'));

		// translate validation messages
		$messages = array
		(
			'email.required' 		 => trans('validation.required'),
			'email.email'    		 => trans('validation.email'),
			'password.required'		 => trans('validation.required'),
			'password.alphNum'		 => trans('validation.password.alphNum'),
		);


	// run the validation rules on the inputs from the form
	$validator = Validator::make(Input::all(), $rules, $messages);

	// if the validator fails, redirect back to the form
	if ($validator->fails()) {
	return Redirect::to('login')
	->withErrors($validator) // send back all errors to the login form
	->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
	} else {

	// create our user data for the authentication
		$userdata = array(
		'email' 	=> $post_email,
		'password' 	=> $post_password
			);

				// attempt to do the login
				if (Auth::attempt($userdata)) {
					
					// save last visit in Database
					$timestamp 		 = date('Y-m-d H:i:s', time());
					$set_user_active = DB::table('user')->where('id', $user_data->id)->update(array('status' => 0, 'last-visit'=>$timestamp));
					
				    //get user as object
					$user_id	 = $user_data->id;
					$user_name   = $user_data->last_name;
					$user_email  = $user_data->email; 
					$get_role    = $user_data->role_id;
					$role_data   = DB::table('role')->where('id', $get_role)->first();
					$role_id     = $role_data->id;
					$role_name   = $role_data->role_name;
				
					// set user status as Online
					$set_user_online = DB::table('user')->where('id', $user_id)->update(array('status' => 1));

					//put Data in Session
					$session_user_id     	  = Session::put('user_id', $user_id);
					$session_user_name     	  = Session::put('user_name', $user_name);
					$session_user_email       = Session::put('user_email', $user_email);
					$session_user_gruppe_id   = Session::put('user_gruppe_id', $role_id);
					$session_user_gruppe_name = Session::put('user_gruppe_name', $role_name);
					$data = Session::all();
					
					//redirect the user
					return Redirect::to('users');

				} else {
					$message = 'Bitte &uuml;berpr&uuml;fen Sie Ihre Eingabe.';
					return Redirect::to('login')->withInput(Input::except('password'))->with('message', $message);
			}
		}	
		
	}
	public function getLogout()
	{
		if (Auth::check())
		{
			$user_id = Session::get('user_id');
			$set_user_offline = DB::table('user')->where('id', $user_id)->update(array('status' => 0));
			//log the User out.
			Auth::logout();

			#Session::flush();
			$message = Lang::get('messages.you are logged out'); //trans('messages.you are logged out');
			return Redirect::to('login')->with('message', $message);
		}
	
		else
		{
			return Redirect::to('login');
		}
	}
}