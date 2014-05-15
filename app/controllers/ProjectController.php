<?php
class ProjectController extends AuthController {
	
		/**
		 * Display a listing of the resource.
		 *
		 * @return Response
		 *
		 */
	
	
		public function __construct()
		{
			// get language and locale from Session
			$lang =  Session::get('lang');
			App::setLocale($lang);
	
		}
	
		/**
		 * Function that displays all projects
		 * 
		 * @return Ambigous <\Illuminate\View\View, \Illuminate\View\View>
		 */
		public function index()
		{
			$data        = Session::all();
			$id          =  $data['user_id'];
			$user_groupe = $data['user_gruppe_name'];
	
			$projects = Project::join('customer', 'project.customer_id', '=', 'customer.id')
			->get(array('project.id', 'project.project_name', 'customer.company_name' , 'project.link', 'project.description'));
			
			//make view with the Projects
			return View::make('projects.index')
			->with('projects', $projects);
		}
	
	
	
	
		/**
		 * Show the form for creating a new resource.
		 *
		 * @return Response
		 */
		public function create()
		{
			$customers = User::getCustomers();
			$user =  Project::getUsers();
			
			// load the create form (app/views/projects/create.blade.php)
			return View::make('projects.create', array('customers' => $customers))
			->with('action', 'projects')
			->with('user', $user)
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
					'project_name'		 	 => 'required',
					'customer_id'       	 => 'required',
					'link'					 => 'required',
					'description'			 => 'required',
	
			);
				
			$validator = Validator::make(Input::all(), $rules);
	
			// process the login
			if ($validator->fails()) {
	
				$messages = $validator->messages();
				return Redirect::to('projects/create')
				->withErrors($validator)
				->withInput();
			} else {
				Project::SaveProject();
	
				// store
	
				// redirect
				Session::flash('message', trans('messages.Successfully created Project!'));
				return Redirect::to('projects');
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
			$project = Project::getProject($id);
			
			// show the view and pass the customer and contact-person to it
			return View::make('projects.show')
			->with('project', $project);
		}
	
		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * @return Response
		 */
		public function edit($id)
		{
			// get the Project
			$project   = Project::getProject($id);
			$customers = User::getCustomers();

			$user = DB::table('user')->get();
			$user =  Project::getUsers();
			
			// show the edit form and pass the User
			return View::make('projects.create', array('customers' => $customers))
			->with('project', $project)
			->with('user', $user)
			->with('action', 'projects/update')
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
			$rules = array(
					'project_name'	 => 'required',
					'customer_id'    => 'required',
					'link'			 => 'required',
					'description'	 => 'required',

			);
				
			$validator = Validator::make(Input::all(), $rules);
	
			// process the login
			if ($validator->fails()) {
				return Redirect::to('projects/' . $id . '/edit')
				->withErrors($validator)
				->withInput();
			} else {
				// store
				Project::SaveProject($id);
				
	
				// redirect
				Session::flash('message', trans('messages.Successfully updated Project!'));
				return Redirect::to('projects');
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
			$project = project::find($id);
			$project->delete();
			DB::table('user-to-projects')->where('project_id', '=', $id)->delete(); 
	
			// redirect
			Session::flash('message', trans('messages.Successfully deleted the Project!'));
			return Redirect::to('projects');
		}
		

	}
