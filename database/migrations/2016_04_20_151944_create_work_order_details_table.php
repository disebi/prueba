<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkOrderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('work_order_details', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('work_order_id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('cant');
            $table->integer('price');
            $table->timestamps();
            $table->foreign('work_order_id')->references('id')->on('work_orders');
            $table->unique( array('work_order_id', 'order_id', 'product_id') );
            $table->foreign(array('order_id', 'product_id'))
            ->references(array('order_id', 'product_id'))
            ->on('order_details');
});


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('work_order_details');
	}

}
