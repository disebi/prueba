<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('credits', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('sale_id');
            $table->integer('branch_id');
            $table->integer('staff_id');
            $table->integer('total');
            $table->boolean('state')->default(true);
            $table->text('comments');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('sale_id')->references('id')->on('sales');
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
		Schema::drop('credits');
	}

}
