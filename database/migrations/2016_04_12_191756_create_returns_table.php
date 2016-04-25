<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('returns', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('branch_id');
            $table->integer('staff_id');
            $table->integer('client_id');
            $table->text('comments');
            $table->boolean('state');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('staff_id')->references('id')->on('staff');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('returns');
		Schema::drop('returns_details');
	}

}
