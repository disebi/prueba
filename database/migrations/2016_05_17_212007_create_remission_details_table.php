<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemissionDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('remission_details', function(Blueprint $table)
		{
            $table->integer('remission_id');
            $table->integer('product_id');
            $table->integer('cant');
            $table->timestamps();
            $table->foreign('remission_id')->references('id')->on('remissions');
            $table->foreign('product_id')->references('id')->on('products');
            $table->primary(['remission_id','product_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('remission_details');
	}

}
