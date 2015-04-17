<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('location', function(Blueprint $table)
	    {
	        $table->increments('location_id');
	        $table->integer('user_id');
	        $table->string('country_name');
	        $table->string('state_name');
	        $table->string('city_name');
	        $table->string('street_name');
	        $table->string('street_number');
	        $table->string('room_number');
	    	$table->integer('level');
	    	$table->integer('parent');
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
		Schema::table('location', function(Blueprint $table)
		{
			//
		});
	}

}
