<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('staff', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('branch_id');
			$table->integer('position_id');
			$table->integer('ci');
			$table->string('name');
			$table->string('last_name');
			$table->string('tel');
			$table->string('direcc');
			$table->date('birth_date');
			$table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->unique(['id','user_id','branch_id']);

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('staff');
	}

}
