<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnDetailsTable extends Migration {

	public function up()
	{
		Schema::create('return_details', function(Blueprint $table)
		{
            $table->integer('return_id');
            $table->integer('product_id');
            $table->integer('cant');
            $table->timestamps();
            $table->foreign('return_id')->references('id')->on('returns');
            $table->foreign('product_id')->references('id')->on('products');
            $table->primary(['return_id','product_id']);
		});
	}

	public function down()
	{
		Schema::drop('return_details');
	}

}
