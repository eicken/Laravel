<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Project extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project';

	public static function getProject($id)
	{
		$get_project = DB::table('project')
		->join('customer', 'project.customer_id', '=', 'customer.id')
		->join('user-to-projects', 'user-to-projects.project_id', '=', 'project.id')
		->where('project.id', '=', $id)
		->get(array('project.id', 'project.project_name', 'project.customer_id', 'customer.company_name' , 'project.link', 'project.description', 'serialized_users_ids'));
		
		$get_project_users = DB::table('user-to-projects')->where('project_id', $id)->first(array('serialized_users_ids'));
		$project_users = $get_project_users->serialized_users_ids;
		
		$project = new Project();
		$project->id = $get_project[0]->id;
		$project->project_name = $get_project[0]->project_name;
		$project->company_name = $get_project[0]->company_name;
		$project->customer_id = $get_project[0]->customer_id;
		$project->link = $get_project[0]->link;
		$project->description = $get_project[0]->description;
		$project->multiselect = unserialize($project_users);

		return $project;
	}

	
	public static function getUsers()
	{
		$users =  User::select(DB::raw('concat (first_name," ",last_name) as full_name,id'))->lists('full_name', 'id');
		return $users;
	}
	
	public static function SaveProject($id = 0)
	{	
		$project_name     = Input::get('project_name');
		$link   = Input::get('link');
		$description    = Input::get('description');
		$customer_id 	= Input::get('customer_id');
		$serialized_users_ids = serialize(Input::get('multiselect'));

		if($id)
		{
			DB::table('user-to-projects')->where('project_id', $id)->update(array( 'serialized_users_ids'=>$serialized_users_ids));
			
			
			DB::table('project')
			->where('id', $id)
			->update(array('project_name' => $project_name, 'link' => $link, 'description' => $description, 'customer_id' => $customer_id,));
			 
		}
	
		else
		{
			
			DB::table('project')->insertGetId(
			array('project_name' => $project_name, 'link' => $link, 'description' => $description, 'customer_id' => $customer_id));
	
			$inserted_record_id =  DB::getPdo()->lastInsertId();
			
			echo $inserted_record_id;
	
			DB::table('user-to-projects')->insertGetId(
			array('project_id' => $inserted_record_id, 'serialized_users_ids' => $serialized_users_ids,));
		}
	
	}
	
	
	public static function GetAttachments($id, $parent_type)
	{
		$get_attachments  = DB::table('attachments')
		->where('parent_id', $id)
		->where('parent_type', $parent_type)
		->get();
		
		return($get_attachments);
	}
	
	
	public static function DeleteAttachemnt($id, $file, $project)
	{
		$path = storage_path().'/uploads/project_id_'.$project.'/'.$file;
		File::delete($path);
		$delete_img = DB::table('attachments')->where('id', '=', $id)->delete();
	}
	
	
	
	public static function SaveAttachemnt($parent_id, $parent_type, $file, $user_id, $project)
	{
			$get_type 	  = $file->getMimeType();
			$explode_type = explode("/", $get_type);
			#echo '.'.$explode_type[1];
			$destinationPath = storage_path().'/uploads/project_id_'.$project;
			$filename 		 = $file->getClientOriginalName();
			$hashed_file_name = str_random(15).'.'.$explode_type[1];
			$upload_success  = Input::file('attachment')->move($destinationPath, $hashed_file_name);
			
			if($upload_success == false)
			{
				Session::flash('message', trans('messages.File could not be uploaded'));
			}
			else
			{
				$save_attachment = DB::table('attachments')->insert
				(
						array(
								'parent_id' => $parent_id, 'parent_type' => $parent_type, 'file_name' => $filename, 'hashed_file_name'=>$hashed_file_name, 'file_type' => $explode_type[1], 'user_id' => $user_id
						)
				);
			}
	}

}

?>