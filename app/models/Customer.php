<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Customer extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer';

	
	
	public static function getCustomer_data($id)
	{
		$customer_data = DB::table('customer')->join('customer-address', 'customer.id', '=', 'customer-address.customer_id')->where('customer.id', '=', $id)
		->get(array('customer.id', 'customer.first_name', 'customer.last_name', 'customer.company_name', 'customer_number',  'contact_person_id', 'customer-address.street', 'customer-address.house_number', 'customer-address.city', 'customer-address.zip_code', 'customer-address.country_id', 'customer-address.phone', 'customer-address.telefax', 'customer-address.email'));
		
		$customer_country = DB::table('customer-address')->join('country', 'customer-address.country_id', '=', 'country.id')->where('customer-address.customer_id', '=', $id)
		->get(array('country.id', 'country.country_name'));
		
		$contact_person =  DB::table('user')->where('id', $customer_data[0]->contact_person_id)->first();
		
		$customer = new Customer();
		$customer->id= $customer_data[0]->id;
		$customer->first_name= $customer_data[0]->first_name;
		$customer->last_name= $customer_data[0]->last_name;
		$customer->company_name= $customer_data[0]->company_name;
		$customer->contact_person= $customer_data[0]->contact_person_id;
		$customer->contact_person_firstname= $contact_person->first_name;
		$customer->contact_person_lastname= $contact_person->last_name;
		$customer->phone= $customer_data[0]->phone;
		$customer->telefax= $customer_data[0]->telefax;
		$customer->email= $customer_data[0]->email;
		$customer->street= $customer_data[0]->street;
		$customer->house_number= $customer_data[0]->house_number;
		$customer->city= $customer_data[0]->city;
		$customer->zip_code= $customer_data[0]->zip_code;
		$customer->country= $customer_country[0]->id;
		$customer->country_name= $customer_country[0]->country_name;
		
		
		return $customer;
	}
	
	
	public static function getContact_person()
	{		
		$get_contacts_persons =  User::select(DB::raw('concat (first_name," ",last_name) as full_name,id'))->lists('full_name', 'id');
		$contacts_persons = array('' => trans('messages.Please Select contact person')) + $get_contacts_persons;
		
		return $contacts_persons;
	}
	
	public static function getCountries()
	{
		$get_countries = DB::table('country')->lists('country_name','id');
		$countries = array('' => trans('messages.Please Select Your Country')) + $get_countries;
		
		return $countries;
	}
	
	
	public static function SaveCustomer($id = 0)
	{
			
		$first_name   	= Input::get('first_name');
		$last_name    	= Input::get('last_name');
		$company_name	= Input::get('company_name');
		$contact_person = Input::get('contact_person');
		$phone 	 	  	= Input::get('phone');
		$telefax 	  	= Input::get('telefax');
		$email 	 	  	= Input::get('email');
		$street 	  	= Input::get('street');
		$house_number 	= Input::get('house_number');
		$city 	 	  	= Input::get('city');
		$zip_code 	  	= Input::get('zip_code');
		$country_id 	= Input::get('country');
				
		if($id)
		{
			DB::table('customer')
	        ->where('id', $id)
	        ->update(array('first_name' => $first_name, 'last_name' => $last_name, 'company_name' => $company_name, 'contact_person_id' => $contact_person,));
	            
	        DB::table('customer-address')
	        ->where('customer_id', $id)
	        ->update(array('street' => $street, 'house_number' => $house_number, 'city' => $city, 'zip_code' => $zip_code, 'country_id' => $country_id, 'phone' => $phone,'telefax' => $telefax,'email' => $email,));
		}
						
		else
		{
			DB::table('customer')->insertGetId(
			array('first_name' => $first_name, 'last_name' => $last_name, 'company_name' => $company_name, 'contact_person_id' => $contact_person)
			);
	
			$inserted_record_id =  DB::getPdo()->lastInsertId();
				
			DB::table('customer-address')->insertGetId(
			array('customer_id' => $inserted_record_id, 'street' => $street, 'house_number' => $house_number, 'city' => $city, 'country_id'=>$country_id, 'zip_code'=>$zip_code, 'phone'=>$phone, 'telefax'=>$telefax, 'email'=>$email)
			);
		}
	
	}


}