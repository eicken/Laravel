<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Ticket extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ticket';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	public static function getTicketInfo()
	{
		$get_ticket_info = DB::table('ticket')
		->leftjoin('ticket-status', 'ticket.status_id', '=', 'ticket-status.id')
		->leftjoin('priority', 'ticket.priority_id', '=', 'priority.id')
		->leftjoin('project', 'ticket.project_id', '=', 'project.id')
		->leftjoin('customer', 'project.customer_id', '=', 'customer.id')
		->get(
				array(
						'ticket.id',
						'ticket.subject',  
						'ticket-status.status_name',  
						'priority.priority_name', 
						'project.project_name', 
						'customer.company_name', 
					));
		return $get_ticket_info;
	}
	
	public static function getTicket_data($id)
	{
		$get_ticket_data = DB::table('ticket')
		->leftjoin('ticket-status', 'ticket.status_id', '=', 'ticket-status.id')
		->leftjoin('priority', 'ticket.priority_id', '=', 'priority.id')
		->leftjoin('project', 'ticket.project_id', '=', 'project.id')
		->leftjoin('customer', 'project.customer_id', '=', 'customer.id')
		->leftjoin('user', 'ticket.user_id', '=', 'user.id')
		->leftjoin('ticket-to-user', 'ticket-to-user.ticket_id', '=', 'ticket.id' )
		->where('ticket.id', $id)
		->get(
				array(
						'ticket.id',
						'ticket.subject',
						'ticket.link',
						'ticket.status_id',
						'ticket.priority_id',
						'ticket.project_id',
						'ticket.description',
						'ticket.duration',
						'ticket.created_at',
						'ticket.updated_at',  
						'ticket-status.status_name',  
						'priority.priority_name', 
						'project.project_name', 
						'customer.company_name',
						'user.first_name',
						'user.last_name', 
						'ticket-to-user.ticket_creater_id',
						'ticket-to-user.applied_to_user_id',
					));
		
		$ticket_send_to_user = User::find($get_ticket_data[0]->applied_to_user_id);
		
		$ticket = new Ticket();
		$ticket->id 			= $get_ticket_data[0]->id;
		$ticket->subject 		= $get_ticket_data[0]->subject;
		$ticket->link 			= $get_ticket_data[0]->link;
		$ticket->description 	= $get_ticket_data[0]->description;
		$ticket->status_name 	= $get_ticket_data[0]->status_name;
		$ticket->status 		= $get_ticket_data[0]->status_id;
		$ticket->duration		= sprintf("%.2f",$get_ticket_data[0]->duration);
		$ticket->created_at    	= $get_ticket_data[0]->created_at;
		$ticket->updated_at    	= $get_ticket_data[0]->updated_at;
		$ticket->priority_name 	= $get_ticket_data[0]->priority_name;
		$ticket->priority 		= $get_ticket_data[0]->priority_id;
		$ticket->company_name 	= $get_ticket_data[0]->company_name;
		$ticket->first_name 	= $get_ticket_data[0]->first_name;
		$ticket->last_name 		= $get_ticket_data[0]->last_name;
		$ticket->project_name 	= $get_ticket_data[0]->project_name;
		$ticket->project 	    = $get_ticket_data[0]->project_id;
		$ticket->ticket_send_to = $ticket_send_to_user->email;

		#echo $get_ticket_data[0]->created_at;
		#echo date('d.m.y , H:m:s', strtotime($get_ticket_data[0]->created_at));
		#die();
		return($ticket);
	}
	
	public static function Translate_array($array)
	{
		$translated_array = array();
		$count = 1;
		foreach($array as $key => $value) {
			$translated_array[$count] = trans('messages.'.$value);
			$count++;
		}

		return array('' => trans('messages.Please Select')) +$translated_array;
	}
	
	
	public static function getStatus()
	{
		$get_status = DB::table('ticket-status')->lists('status_name','id');
		$translated_status = Ticket::Translate_array($get_status);
		
		return $translated_status;
	}
	
	public static function getPriority()
	{
		$get_priority = DB::table('priority')->lists('priority_name','id');
		$translated_priority = Ticket::Translate_array($get_priority);
		
		return $translated_priority;
	}
	
	public static function getProjects()
	{
		$get_project = DB::table('project')->lists('project_name','id');
		$projects = array('' => trans('messages.Please Select Project')) + $get_project;
	
	
		return $projects;
	}
	
	public static function SaveTicket($id = 0)
	{	
		$data         	  = Session::all();
		$user_id      	  = $data['user_id'];
		$subject   		  = Input::get('subject');
		$status    		  = Input::get('status');
		$priority		  = Input::get('priority');
		$project    	  = Input::get('project');
		$description      = Input::get('description');
		$link    		  = Input::get('link');	
		$duration     	  = Input::get('duration');
		$file	  	   	  = Input::file('attachment');
		$ticket_send_to   = Input::get('ticket_send_to');
		$parent_type	  = 'ticket';
		$get_user_send_to = DB::table('user')->where('email', $ticket_send_to)->first();
		

		/*if( $upload_success ) {
		 return Response::json('success', 200);
		} else {
		return Response::json('error', 400);
		}*/

		$timestamp 		 = date('Y-m-d H:i:s', time());
		
		// store
		if($id)
		{
			$parent_id = $id;
			DB::table('ticket')
			->where('id', $id)
			->update(array(
								'subject' => $subject, 
								'priority_id' => $priority, 
								'description' => $description, 
								'link' => $link, 
								'user_id' =>$user_id, 
								'project_id' => $project, 
								'status_id' => $status,
								'duration' =>$duration,
								'updated_at'=>$timestamp,
			));
			
			DB::table('ticket-to-user')
			->where('ticket_id', $id)
			->update(array('applied_to_user_id' =>$get_user_send_to->id ));
		}
		else
		{
			DB::table('ticket')->insertGetId(
			array(
					'subject' => $subject, 
					'priority_id' => $priority, 
					'description' => $description, 
					'link' => $link, 'user_id' =>$user_id, 
					'project_id' => $project, 
					'status_id' => $status, 
					'duration'=>$duration,
					'created_at'=>$timestamp,
					'updated_at'=>$timestamp,
			));
			
			$parent_id =  DB::getPdo()->lastInsertId();
			
			DB::table('ticket-to-user')->insertGetId(
			array('ticket_id' => $parent_id, 'ticket_creater_id' => $user_id, 'applied_to_user_id' => $get_user_send_to->id,)
			);
		}
		
		if(!empty($file)){Project::SaveAttachemnt($parent_id, $parent_type, $file, $user_id, $project);}
		
	}
	
	
	public static function DeleteTicket($id)
	{
		DB::table('ticket')->where('id', '=', $id)->delete();
		DB::table('ticket-to-user')->where('ticket_id', '=', $id)->delete();
	}

}