<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateProductImagesTable.
 */
class CreateProductImagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_images', function(Blueprint $table) {
            $table->id();
			$table->foreignId('product_id')->constrained('products');
			$table->string('image');
            $table->tinyInteger('is_default')->default(0);
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
		Schema::drop('product_images');
	}
}
