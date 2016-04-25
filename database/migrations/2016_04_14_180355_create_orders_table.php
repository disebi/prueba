<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('client_id');
            $table->integer('visit_id');
            $table->integer('staff_id');
            $table->boolean('state');
            $table->integer('process')->default(1);
            $table->text('comments');
            $table->timestamps();
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('visits_id')->references('id')->on('visits');
            $table->foreign('client_id')->references('id')->on('clients');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
