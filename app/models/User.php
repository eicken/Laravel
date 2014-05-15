<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

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
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
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

	/**
	 * Get all roles available
	 * 
	 * @return array
	 */
	public static function getRoles()
	{
		$get_roles = DB::table('role')->lists('role_name','id');
		$roles = array('' => trans('messages.Please Select a Role')) + $get_roles;
	
		return $roles;
	}
	
	/**
	 * Get all customers
	 * 
	 * @return array
	 */
	public static function getCustomers()
	{
		$get_customers = DB::table('customer')->lists('company_name','id');
		$customers = array('' => trans('messages.Please Select a customer')) + $get_customers;
	
		return $customers;
	}
	
	/**
	 * Get role for a user
	 * 
	 * @param Integer $id
	 * @return array
	 */
	public static function getUserRole($id)
	{
		$get_user_role = DB::table('user')->join('role', 'user.role_id', '=', 'role.id')->where('user.id', '=', $id)
		->get(array('role.role_name'));
	
		return $get_user_role;
	}
	
	/**
	 * Get Customer of a user
	 * 
	 * @param Integer $id
	 * @return array
	 */
	public static function getUserCustomer($id)
	{
		$get_user_customer = DB::table('user')->join('customer', 'user.customer_id', '=', 'customer.id')->where('user.id', '=', $id)
		->get(array('customer.company_name'));
	
		return $get_user_customer;
	}
}
