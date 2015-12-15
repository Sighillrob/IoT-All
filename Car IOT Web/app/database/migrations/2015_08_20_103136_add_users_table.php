<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->string('photo');
			$table->string('country');
			$table->string('address');
			$table->string('gender');
			$table->string('dob');
			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->string('photo');
			$table->string('country');
			$table->string('address');
			$table->string('gender');
			$table->string('dob');
		});
	}

}
