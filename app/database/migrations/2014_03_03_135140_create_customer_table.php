<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		#### Customer-tables ####
		Schema::create('customer', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 250);
			$table->string('last_name', 250);
			$table->string('company_name', 250);
			$table->string('customer_number');
			$table->integer('contact_person_id');
			$table->timestamps();
		});
		
		Schema::create('customer-address', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('customer_id');
			$table->string('street');
			$table->string('house_number');
			$table->string('city');
			$table->string('zip_code');
			$table->integer('country_id');
			$table->string('phone');
			$table->string('telefax');
			$table->string('email', 320);
		});
		
		Schema::create('country', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('country_name');
			$table->string('iso_code_2', 2);
			$table->string('iso_code_3', 3);
		});
		####End customer-tables ####
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customer');
		Schema::drop('customer-address');
		Schema::drop('country');
	}

}