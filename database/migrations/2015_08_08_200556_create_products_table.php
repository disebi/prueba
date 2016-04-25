<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('products', function(Blueprint $table)
		{   $table->increments('id');
            $table->string('description');
            $table->integer('compra');
            $table->integer('venta');
            $table->decimal('contenido');
            $table->integer('aroma_id')->unsigned();
            $table->integer('presentation_id')->unsigned();
            $table->integer('line_id')->unsigned();
            $table->integer('unity_id')->unsigned();
            $table->integer('provider_id')->unsigned();
            $table->integer('tax_id')->unsigned();
            $table->integer('min');
            $table->float('peso')->unsigned();
            $table->timestamps();

            $table->foreign('aroma_id')->references('id')->on('aromas');
            $table->foreign('presentation_id')->references('id')->on('presentations');
            $table->foreign('line_id')->references('id')->on('lines');
            $table->foreign('unity_id')->references('id')->on('unities');
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->foreign('tax_id')->references('id')->on('taxes');

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
	}

}
