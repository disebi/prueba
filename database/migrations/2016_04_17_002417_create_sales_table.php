<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sales', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('branch_id');
            $table->integer('client_id');
            $table->integer('salesman_id');
            $table->integer('staff_id');
            $table->integer('iva 10');
            $table->integer('iva 5');
            $table->integer('exent');
            $table->integer('total');
            $table->boolean('state');
            $table->string('stamping');
            $table->text('comments');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('salesman_id')->references('id')->on('staff');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('order_id')->references('id')->on('orders');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sales');
	}

}
