<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('work_orders', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('visit_id');
            $table->integer('branch_id');
            $table->integer('staff_id');
            $table->integer('process');
            $table->boolean('state')->default(true);
            $table->text('comments');
            $table->timestamps();
            $table->foreign('visit_id')->references('id')->on('visits');
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
		Schema::drop('work_orders');
	}

}
