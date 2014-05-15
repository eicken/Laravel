<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Attachment extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project';
	
	
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