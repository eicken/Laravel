<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		#### Ticket tables ####
		Schema::create('ticket', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('subject');
			$table->integer('priority_id');
			$table->string('description');
			$table->text('link');
			$table->integer('user_id');
			$table->integer('project_id');
			$table->integer('status_id');
		});
		
		Schema::create('attachments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_id');
			$table->string('parent_type');
			$table->string('file');
			$table->string('file_type');
			$table->integer('user_id');
		});
		
		Schema::create('priority', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('priority_name');
			$table->string('inter-val');
		});	

		Schema::create('ticket-status', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('status_name');
		});
		#### End Ticket tables ####
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ticket');
		Schema::drop('attachments');
		Schema::drop('priority');
	}

}