<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdjustsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adjusts', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('branch_id');
            $table->integer('staff_id');
            $table->boolean('state');
            $table->text('comments');
            $table->timestamps();
            $table->foreign('staff_id')->references('id')->on('staff');
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
		Schema::drop('adjusts');
	}

}
