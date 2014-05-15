<?php

class RoleController extends AuthController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 * 
	 */
	
	
	public function __construct()
	{
		$lang =  Session::get('lang');
		App::setLocale($lang);			
	}
	
	public function index()
	{
		//TODO: Warum holt er sich immer noch den user?
		//get all Roles
		$data        = Session::all();
		$id          =  $data['user_id'];
		$user_groupe = $data['user_gruppe_name'];
		$user 		 = DB::table('user')->where('user.id', $id)->first();
		$roles 		 = DB::table('role')->get();

		return View::make('roles.index')
		->with('roles', $roles);		
	}
	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		// load the create form (app/views/users/create.blade.php)
		return View::make('roles.create')
					->with('action', 'roles')
					->with('method', 'POST');
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
				'role_name'		 => 'required',
			);
			
			$validator = Validator::make(Input::all(), $rules);
	
			// process the login
			//TODO: wieder: wozu messages?
			if ($validator->fails()) {
				
				$messages = $validator->messages();
				return Redirect::to('roles/create')
					->withErrors($validator);
			} else {
				$input = Input::all();
				if(!empty($input['permission'])){$serialize_permission = serialize($input['permission']);}
				else{$serialize_permission = 'N;';}
				// store
				$role = new Role;
				$role->role_name     = Input::get('role_name');
				Log::info(unserialize($serialize_permission));
				$role->serialized_permissions = $serialize_permission;
				$role->save();
	
				// redirect
				Session::flash('message',  trans('messages.Successfully created Role!'));
				return Redirect::to('roles');
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
		$role  = Role::find($id);
		
		// show the view and pass the user to it
		return View::make('roles.show')
		->with('role', $role);		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
			// get the Role
			$role =Role::find($id);
			$role->permission = unserialize($role->serialized_permissions);
	
			// show the edit form and pass the Role
			return View::make('roles.create')
				->with('role', $role)
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
		$input = Input::all();
		
		if(!empty($input['permission'])){$serialize_permission = serialize($input['permission']);}
		else{$serialize_permission = 'N;';}

		$rules = array(
				'role_name'		 => 'required',
			);	
			
		$validator = Validator::make(Input::all(), $rules);
		
		// process the login
		if ($validator->fails()) {
			return Redirect::to('roles/' . $id . '/edit')
			->withErrors($validator);

		} else {
			// store
			$role = Role::find($id);
			$role->role_name     = Input::get('role_name');
			$role->serialized_permissions = $serialize_permission;
			$role->save();
		
			// redirect
			Session::flash('message',  trans('messages.Successfully updated Role!'));
			return Redirect::to('roles');
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
		$role = Role::find($id);
		$role->delete();

		// redirect
		Session::flash('message', trans('messages.Successfully deleted the Rolle!'));
		return Redirect::to('roles');
	}

}