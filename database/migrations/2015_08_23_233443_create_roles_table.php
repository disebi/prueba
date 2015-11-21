<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('description');
			$table->timestamps();
		});

        Schema::create('license_role', function(Blueprint $table)
        {
            $table->integer('role_id');
            $table->integer('license_id');
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('license_id')->references('id')->on('licenses');
            $table->primary('role_id','license_id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('role_license');
		Schema::drop('roles');
	}

}
