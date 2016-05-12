<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBacksTable extends Migration {


	public function up()
	{
		Schema::create('backs', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('out_id');
            $table->integer('branch_id');
            $table->integer('staff_id');
            $table->float('km');
            $table->float('tanque');
            $table->text('comments');
            $table->boolean('state');
            $table->timestamps();
            $table->foreign('out_id')->references('id')->on('outs');
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
		Schema::drop('backs');
	}

}
