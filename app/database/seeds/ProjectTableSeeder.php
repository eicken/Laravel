<?php
class ProjectTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('project')->delete();
		DB::table('user-to-projects')->delete();
		
		$projects = array(
				array(
						'id'	   => '1',
						'project_name' 			   => 'project name',
						'customer_id'  			   => '1',
						'link'   			   => 'www.google.de',
						'description'		   => 'project description',
					),
				array(
						'id'	   => '2',
						'project_name' 			   => 'project name',
						'customer_id'  			   => '2',
						'link'   			   => 'www.google.de',
						'description'		   => 'project description',
				),		

			);
		
		$user_to_project = array(
			array(
					'id'	=> '1',
					'serialized_users_ids'=>'a:2:{i:0;s:1:"1";i:1;s:1:"5";}',
					'project_id'	=> '1',
					),
				array(
					'id'	=> '2',
					'serialized_users_ids'=>'a:2:{i:0;s:1:"1";i:1;s:1:"5";}',
					'project_id'	=> '2',
				),									
		);
		
		
		
		DB::table('project')->insert( $projects);
		DB::table('user-to-projects')->insert($user_to_project);
	}
}