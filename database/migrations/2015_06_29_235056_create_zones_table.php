<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zones', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('description');
            $table->integer('comision');
            $table->decimal('km');
            $table->integer('city_id')->unsigned();
			$table->timestamps();



            $table->foreign('city_id')->references('id')->on('cities');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('cities');
		Schema::dropIfExists('zones');
	}

}
