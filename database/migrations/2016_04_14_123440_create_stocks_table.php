<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stocks', function(Blueprint $table)
		{
            $table->integer('deposit_id');
            $table->integer('product_id');
            $table->integer('min');
            $table->integer('cant');
            $table->timestamps();
            $table->foreign('deposit_id')->references('id')->on('deposits');
            $table->foreign('product_id')->references('id')->on('products');
            $table->primary(['deposit_id','product_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stocks');
	}

}
