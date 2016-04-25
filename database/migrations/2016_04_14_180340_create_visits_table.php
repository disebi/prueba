<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visits', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('zone_id');
            $table->integer('branch_id');
            $table->date('delivery_date');
            $table->boolean('state');
            $table->integer('process')->default(1);
            $table->timestamps();
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->foreign('branch_id')->references('id')->on('branches');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('visits');
	}

}
