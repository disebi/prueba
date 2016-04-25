<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdjustDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adjust_details', function(Blueprint $table)
		{
            $table->integer('adjust_id');
            $table->integer('product_id');
            $table->integer('activity');
            $table->integer('cant');
            $table->timestamps();
            $table->foreign('adjust_id')->references('id')->on('adjusts');
            $table->foreign('product_id')->references('id')->on('products');
            $table->primary(['adjust_id','product_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('adjust_details');
	}

}
