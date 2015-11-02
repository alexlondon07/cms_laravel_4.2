<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('category_id');
            $table->string('name');
            $table->string('reference');
            $table->Integer('stocks');//existencias
            $table->string('tag');//etiquetas (nuevo, agotado, descuento....)
            $table->string('description', 450);
            $table->string('gender', 10);
            $table->double('cost');
            $table->double('value');//valor
            $table->string('crossed_out_price');//precio tallado
            $table->string('featured', 5);//prod destcado
            $table->string('enable');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		chema::drop('product');
	}

}
