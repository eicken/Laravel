<?php
class CustomerTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('customer')->delete();
		DB::table('customer-address')->delete();
		DB::table('country')->delete();
		
		$customers = array(
				array(
						'id'	   => '1',
						'first_name' 			   => 'Michael',
						'last_name'  			   => 'Brode',
						'company_name'   			   => 'Acrontum',
						'customer_number'		   => '1',
						'contact_person_id'		   => '1',
					),
		
				array(
						'id'	   => '2',
						'first_name' 			   => 'customer first name2',
						'last_name'  			   => 'customer last name2',
						'company_name'   			   => 'customer company-name2',
						'customer_number'		   => '2',
						'contact_person_id'		   => '2',
						
					),
				array(
						'id'	   => '3',
						'first_name' 			   => 'customer first name2',
						'last_name'  			   => 'customer last name2',
						'company_name'   			   => 'customer company-name2',
						'customer_number'		   => '2',
						'contact_person_id'		   => '2',
				
				),
			);
		
		$customers_addresses = array(
			array(
					'customer_id'	=> '1',
					'street'		=> 'test street',
					'house_number'	=> '15',
					'city'			=> 'test city',
					'zip_code'		=> '12345',
					'country_id'	=> '1',
					'phone'			=> '123456789',
					'telefax'		=> '123456789',
					'email'			=> 'customer@email.de',
			),
			array(
				    'customer_id'	=> '2',
					'street'		=> 'test street',
					'house_number'	=> '15',
					'city'			=> 'test city',
					'zip_code'		=> '12345',
					'country_id'	=> '1',
					'phone'			=> '123456789',
					'telefax'		=> '123456789',
					'email'			=> 'customer@email.de',
				),						
		);
		
		$countries = array(
			array(
				'country_name'		=> 'Deutschland',
				'iso_code_2'		=> 'DE',
				'iso_code_3'		=> 'DEU',	
				),
				
				array(
						'country_name'		=> 'Oesterreich',
						'iso_code_2'		=> 'AT',
						'iso_code_3'		=> 'AUT',
				),
		);
		
		
		DB::table('customer')->insert( $customers);
		DB::table('customer-address')->insert($customers_addresses);
		DB::table('country')->insert($countries);
	}
}