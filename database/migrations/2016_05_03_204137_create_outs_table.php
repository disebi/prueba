<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('outs', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('work_id')->nullable();
            $table->integer('branch_id');
            $table->integer('drive_id');
            $table->integer('driver_id');
            $table->integer('staff_id');
            $table->integer('razon');
            $table->integer('razon_id')->nullable();
            $table->float('km');
            $table->float('tanque');
            $table->text('comments');
            $table->boolean('state');
            $table->timestamps();
            $table->foreign('work_id')  ->references('id')->on('work_orders');
            $table->foreign('drive_id') ->references('id')->on('drives');
            $table->foreign('driver_id')->references('id')->on('staff');
            $table->foreign('staff_id') ->references('id')->on('staff');
            $table->foreign('branch_id')->references('id')->on('branches');
        });
	}


	public function down()
	{
		Schema::drop('outs');
	}

}
