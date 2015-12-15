<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_detail', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('car_make');
			$table->string('car_model');
			$table->string('car_year');
			$table->string('car_engine_no');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
			Schema::drop('car_detail');
	}

}
