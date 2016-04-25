<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('credit_details', function(Blueprint $table)
		{
            $table->integer('credit_id');
            $table->integer('product_id');
            $table->integer('cant');
            $table->integer('price');
            $table->timestamps();
            $table->foreign('credit_id')->references('id')->on('credits');
            $table->foreign('product_id')->references('id')->on('products');
            $table->primary(['credit_id','product_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('credit_details');
	}

}
