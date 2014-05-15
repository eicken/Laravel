<?php

// app/database/seeds/UserTableSeeder.php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('user')->delete();
		DB::table('role')->delete();
		#User::create(array(
		/*array(
			'name'     => 'Haider Al-aoubaidy',
			'username' => 'haider',
			'email'    => 'haider@test.de',
			'password' => Hash::make('haider'),
			'gruppe'	   => '1'
			),
			
			array(
					'name'     => 'Haider user',
					'username' => 'haider',
					'email'    => 'haider@test1.de',
					'password' => Hash::make('haider'),
					'gruppe'	   => '2'
			)
				));*/
		$users = array(
		array(
		'greeting'	   => 'Herr',
		'first_name'   => 'Haider Al-aoubaidy',
		'last_name'    => 'haider admin',
		'email'   	   => 'haider@admin.de',
		'phone'		   => '123456789',
 		'password' 	   => Hash::make('adminhaider'),
		'role_id'	   => '1',
		'customer_id'	   => '1',
		'status'	   => 'active',		
				),
				
				
		array(
		'greeting'	   => 'Herr',
		'first_name'   => 'Haider Al-aoubaidy',
		'last_name'    => 'haider projectsupervisior',
		'email'   	   => 'haider@projectsupervisior.de',
		'phone'		   => '123456789',
		'password' 	   => Hash::make('supervisor'),
		'role_id'	   => '2',
		'customer_id'	   => '2',
		'status'	   => 'active',
		),
					
		array(
		'greeting'	   => 'Herr',
		'first_name'   => 'Haider Al-aoubaidy',
		'last_name'    => 'haider user',
		'email'   	   => 'haider@user.de',
		'phone'		   => '123456789',
 		'password' 	   => Hash::make('userhaider'),
		'role_id'	   => '3',
		'customer_id'	   => '2',
		'status'	   => 'active',		
				),
				
		array(
		'greeting'	   => 'Herr',
		'first_name'   => 'Haider Al-aoubaidy',
		'last_name'    => 'haider geust',
		'email'   	   => 'haider@guest.de',
		'phone'		   => '123456789',
 		'password' 	   => Hash::make('guesthaider'),
		'role_id'	   => '4',
		'customer_id'	   => '2',
		'status'	   => 'active',		
				),
		array(
		'greeting'	   => 'Herr',
		'first_name'   => 'Haider Al-aoubaidy',
	    'last_name'    => 'haider geust',
		'email'   	   => 'haider@guest.de',
		'phone'		   => '123456789',
		'password' 	   => Hash::make('guesthaider'),
		'role_id'	   => '5',
		'customer_id'	   => '2',
		'status'	   => 'active',
				),
				
		
		);
		
		$roles = array(
			
		array(
				'id' => '1',
				'role_name'  =>'admin',	
				'serialized_permissions'=>'a:3:{i:0;s:4:"read";i:1;s:6:"delete";i:2;s:6:"update";}'
			),
				
		array(
				'id' => '2',
				'role_name'  =>'project-supervisor',
				'serialized_permissions'=>'a:3:{i:0;s:4:"read";i:1;s:6:"delete";i:2;s:6:"update";}'
			),
				
		array(
				'id' => '3',
				'role_name'  =>'user',
				'serialized_permissions'=>'a:3:{i:0;s:4:"read";i:1;s:6:"delete";i:2;s:6:"update";}'
			),
				
		array(
				'id' => '4',
				'role_name'  =>'geust',
				'serialized_permissions'=>'a:3:{i:0;s:4:"read";i:1;s:6:"delete";i:2;s:6:"update";}'
			),
				
		array(
				'id' => '5',
				'role_name'  =>'workers',
				'serialized_permissions'=>'a:3:{i:0;s:4:"read";i:1;s:6:"delete";i:2;s:6:"update";}'
			),						
		);
		
		DB::table('user')->insert( $users);
		DB::table('role')->insert( $roles);
	}

}