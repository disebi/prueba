<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrivesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('drives', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('description');
            $table->string('chapa');
            $table->string('chasis');
            $table->integer('year');
            $table->integer('brand_id');
			$table->timestamps();
            $table->foreign('brand_id')->references('id')->on('brands');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('drives');
	}

}
