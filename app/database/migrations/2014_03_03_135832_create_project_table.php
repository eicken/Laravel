<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		#### Projects tables ####
		Schema::create('project', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('project_name');
			$table->integer('customer_id');
			$table->string('link');
			$table->text('description');
			$table->timestamps();
			$table->string('serialized_permissions')->nullable();
		});
		
		Schema::create('user-to-projects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('serialized_users_ids');
			$table->integer('project_id');
		});
		#### End Projects tables ####
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project');
		Schema::drop('user-to-projects');
	}

}