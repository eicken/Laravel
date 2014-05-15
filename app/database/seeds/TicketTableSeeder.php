<?php
class TicketTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('ticket')->delete();
		DB::table('priority')->delete();
		DB::table('ticket-status')->delete();
		
		$tickets = array(
				array(
						'id'	  		 => '1',
						'subject' 		 => 'Ticket Subject',
						'priority_id'  	 => '1',
						'description'    => 'Ticket description',
						'link'		     => 'www.google.de',
						'user_id'		 =>'1',
						'project_id'	 =>'1',
						'status_id'		 =>'1',
					),
				array(
						'id'	  		 => '2',
						'subject' 		 => 'Ticket Subject',
						'priority_id'  	 => '2',
						'description'    => 'Ticket description',
						'link'		     => 'www.google.de',
						'user_id'		 =>'2',
						'project_id'	 =>'2',
						'status_id'		 =>'2',
					),	

			);
		
		$priorities = array(
					array(
							'id'=>'1',
							'priority_name'=>'low',
						 ),
					array(
							'id'=>'2',
							'priority_name'=>'normal',
						 ),
					array(
							'id'=>'3',
							'priority_name'=>'high',
					    ),
					array(
							'id'=>'4',
							'priority_name'=>'immediately',
					),
			);
		
		$ticket_status = array(
						array(
								'id'=>'1',
								'status_name'=>'doing',

							 ),
						array(
								'id'=>'2',
								'status_name'=>'created',
	
							 ),
						array(
								'id'=>'3',
								'status_name'=>'cleared',

							 ),
						array(
								'id'=>'4',
								'status_name'=>'finished',
							 ),
						array(
								'id'=>'5',
								'status_name'=>'feedback',
						),
		);
		
		
		
		DB::table('ticket')->insert( $tickets);
		DB::table('priority')->insert($priorities);
		DB::table('ticket-status')->insert( $ticket_status);
	}
}