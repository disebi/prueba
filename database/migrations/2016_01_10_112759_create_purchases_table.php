<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchases', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('branch_id');
			$table->integer('staff_id');
			$table->integer('iva 10');
			$table->integer('iva 5');
			$table->integer('exent');
			$table->integer('total');
			$table->boolean('state');
			$table->string('stamping');
			$table->text('comments');
			$table->timestamps();
            $table->foreign('staff_id')->references('id')->on('staff');
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
		Schema::drop('purchases');
	}

}
