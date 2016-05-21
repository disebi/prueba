<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('remissions', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('branch_id');
            $table->integer('staff_id');
            $table->integer('branch_to');
            $table->integer('staff_to')->nullable();
            $table->integer('total');
            $table->integer('process');
            $table->boolean('state')->default(true);
            $table->text('comments');
            $table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('branch_to')->references('id')->on('branches');
            $table->foreign('staff_to')->references('id')->on('staff');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('remissions');
	}

}
