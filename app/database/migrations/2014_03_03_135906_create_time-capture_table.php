<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeCaptureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		#### Time capture ####
		Schema::create('time-capture', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('project_id');
			$table->integer('ticket_id');
			$table->timestamp('date');
			$table->text('description');
			$table->float('duration');
			$table->string('status');
		});
		#### End Time capture ####
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('time-capture');
	}

}