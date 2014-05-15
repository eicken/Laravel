<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Comment extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comment';

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
	
	public static function SaveComment($ticket_id, $user_id, $attachment_id = 0, $comment, $id =0)
	{
		#echo $ticket_id.'#'.$user_id.'#'.$comment.'#'.$id;
		#die();
		$timestamp 		 = date('Y-m-d H:i:s', time());
		
		if($id != 0)
		{
			DB::table('comment')
			->where('id', $id)
			->update(array('comment' => $comment, 'updated_at'=>$timestamp,));
		}
		
		else
		{
			$save_comment = DB::table('comment')->insert(
					array('ticket_id' => $ticket_id, 'user_id' => $user_id, 'attachment_id'=>$attachment_id, 'comment'=>$comment, 'created_at'=>$timestamp, 'updated_at'=>$timestamp));
		}
	}
	
	public static function DeleteComment($id)
	{
		DB::table('comment')->where('id', '=', $id)->delete();
	}

}