<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('clients', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('description');
            $table->string('ruc')->unique();
            $table->string('razon')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('tel')->nullable();
            $table->string('direcc');
            $table->integer('zone_id')->unsigned();
            $table->integer('rubro_id')->unsigned();
            $table->timestamps();


            $table->foreign('zone_id')->references('id')->on('zones');
            $table->foreign('rubro_id')->references('id')->on('businesses');
        });


    }


    /**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

        Schema::dropIfExists('businesses');
        Schema::dropIfExists('zones');
		Schema::dropIfExists('clients');
	}

}
