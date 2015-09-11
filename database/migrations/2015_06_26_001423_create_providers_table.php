<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('providers', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('description');
            $table->string('razon');
            $table->string('ruc');
            $table->string('tel')->nullable();
            $table->string('mail')->nullable();
            $table->string('web')->nullable();
            $table->string('direcc')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('products');
		Schema::drop('providers');
	}

}
