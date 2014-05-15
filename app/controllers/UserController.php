<?php

class UserController extends AuthController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 *
	 */


	public function __construct()
	{
		#print_r(Session::all());
		$lang =  Session::get('lang');
		App::setLocale($lang);

	}

	public function index()
	{
		// load the view and pass the Users together with their respective roles

		$data        = Session::all();
		$id          =  $data['user_id'];
		$user_groupe = $data['user_gruppe_name'];
		$user = DB::table('user')->where('user.id', $id)->first();
		#print_r($data);

		$users = DB::table('user')->join('role', 'user.role_id', '=', 'role.id')->get(array('user.id', 'user.last_name', 'user.email', 'role.role_name'));

		return View::make('users.index')
		->with('users', $users);



	}




	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles =User::getRoles();
		$customers =User::getCustomers();

		// load the create form (app/views/users/create.blade.php)
		return View::make('users.create', array('roles' => $roles, 'customers' => $customers));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
			
		// validate
		$rules = array(
				'greeting'		 => 'required',
				'first_name'     => 'required',
				'last_name'		 => 'required',
				'email'      	 => 'required|email',
				'phone'	     	 => 'numeric',
				'password'		 => 'required|min:8|confirmed',
				'password_confirmation'		 => 'required|min:8',
				'role_id' 		 => 'required',
				'customer_id'	 => 'required'
		);
			
		$messages = array(
				'greeting.required' => trans('validation.greeting is required'),
				'role.required' => trans('validation.role is required'),
				'password.required'	=> trans('validation.required'),
				'password_confirmation.required'	=> trans('validation.required'),
		);
			
		$validator = Validator::make(Input::all(), $rules, $messages);

		// process the login
		if ($validator->fails()) {

			$messages = $validator->messages();
			return Redirect::to('users/create')
			->withErrors($validator)
			->withInput(Input::except(array('password', 'password_confirmation')));
		} else {
			// store
			$user = new User;
			$user->greeting     = Input::get('greeting');
			$user->first_name   = Input::get('first_name');
			$user->last_name    = Input::get('last_name');
			$user->email        = Input::get('email');
			$user->phone   	    = Input::get('phone');
			$user->password     = Hash::make(Input::get('password'));
			$user->role_id 	    = Input::get('role_id');
			$user->customer_id 	= Input::get('customer_id');
			$user->save();

			// redirect
			Session::flash('message', 'Successfully created User!');
			return Redirect::to('users');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
			
		// get the User
		#$user = User::find($id);

		/*$user = $user = DB::table('users')->where('users.id', $id)
		 ->leftJoin('gruppen', 'users.gruppe', '=', 'gruppen.gruppe_id')

		 ->first();*/

		$user              = User::find($id);
		$user_role_name    = User::getUserRole($id);
		$user_cutomer_name = User::getUserCustomer($id);

		// show the view and pass the user to it
		return View::make('users.show')
		->with('user_role_name', $user_role_name)
		->with('user_customer_name', $user_cutomer_name)
		->with('user', $user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the User
		$user = User::find($id);
		$roles =User::getRoles();
		$customers =User::getCustomers();
		unset($user['password']);

		// show the edit form and pass the User
		return View::make('users.create', array('roles' => $roles, 'customers' => $customers))
		->with('user', $user)
		->with('action', 'users/update')
		->with('method', 'PUT');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// validate
		//check if telefon more than 4 digits
		Validator::extend('check_digits', function($attribute, $value, $parameters)
		{
			// Remove all but numbers from $value
			$value = preg_replace('/[^\d]/', '', $value);

			//TODO: credit cards??
			// Credit Cards may range between 13 and 16 digits.
			if (strlen($value) < 4 ) return false;

			return $value;
		});


		$rules = array(
				'greeting'		 => 'required',
				'first_name'     => 'required',
				'last_name'		 => 'required',
				'email'      	 => 'required|email',
				'phone'	     	 => 'check_digits',
				'role_id' 		 => 'required',
				'customer_id' 		 => 'required',
		);
			
		$messages = array(
				'greeting.required' => trans('validation.greeting is required'),
				'role.required' => trans('validation.role is required'),
		);
			
		$validator = Validator::make(Input::all(), $rules, $messages);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('users/' . $id . '/edit')
			->withErrors($validator)
			->withInput(Input::all());
		} else {
			// store
			$user = User::find($id);
			$user->greeting     = Input::get('greeting');
			$user->first_name   = Input::get('first_name');
			$user->last_name    = Input::get('last_name');
			$user->email        = Input::get('email');
			$user->phone   		= Input::get('phone');
			$user->role_id 	  	= Input::get('role_id');
			$user->customer_id 	= Input::get('customer_id');
			$user->save();

			// redirect
			Session::flash('message', 'Successfully updated User!');
			return Redirect::to('users');
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete
		$user = User::find($id);
		$user->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the User!');
		return Redirect::to('users');
	}


	/**
	 * Show the form for editing the password of a specified user
	 *
	 * @param int $id
	 */
	public function editPW($id)
	{
		$user = User::find($id);
		return View::make('users.editPassword')
		->with('user_id', $id);
	}


	public function updatePW($id)
	{

		$rules = array(
			'old_password' => 'required',
			'password' => 'required|min:8|confirmed',
			'password_confirmation' => 'required|min:8',			
		);
		$messages = array(
			'old_password.required'	=> trans('validation.required'),
			'password.required'	=> trans('validation.required'),
			'password_confirmation.required'	=> trans('validation.required'),
		);
		//Check if all inputs have been made correctly
		$validator = Validator::make(Input::all(), $rules);
		if($validator->fails()) {
			return Redirect::to('users/editPW/' . $id)
				->withErrors($validator);
		}
		
		$user = User::find($id);
		$old_pw = Input::get("old_password");
		
		if(!Hash::check($old_pw, $user->password))
		{
				
			//Password does not match saved password
			return Redirect::to('users/editPW/' . $id)
			->withErrors('old_password', 'Old Password not correct');

		} else {
				
			//All inputs correct. Save new Password
			$user->password = Hash::make(Input::get("password"));
			$user->save();
			
			// redirect
			Session::flash('message', 'Successfully updated Password!');
			return Redirect::to('users');
		}
			
	}
}