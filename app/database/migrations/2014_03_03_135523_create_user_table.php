<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		#### User Tablles ####
		Schema::create('user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('greeting', 4);
			$table->string('first_name', 250);
			$table->string('last_name', 250);
			$table->string('email', 320);
			$table->string('phone');
			$table->string('password', 64);
			$table->integer('role_id');
			$table->integer('customer_id');
			$table->integer('status');
			$table->text('remember_token', 100)->nullable();
			$table->timestamp('last-visit');
			$table->timestamps();
		});
		#### End User tables ####
		
		#### Roles and Permission ####
		Schema::create('role', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('role_name');
			$table->string('serialized_permissions');
			$table->timestamps();
		});
		#### End Roles and Permissions ####
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user');
		Schema::drop('role');
	}

}