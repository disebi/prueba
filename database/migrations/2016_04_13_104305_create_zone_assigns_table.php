<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZoneAssignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zone_assigns', function(Blueprint $table)
		{
            $table->integer('staff_id');
            $table->integer('zone_id');
            $table->timestamps();
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->primary(['staff_id','zone_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zone_assigns');
	}

}
