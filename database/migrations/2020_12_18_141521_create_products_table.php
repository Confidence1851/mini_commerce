<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateProductsTable.
 */
class CreateProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
            $table->id();
			$table->foreignId('category_id')->index()->nullable()->nullOnDelete()->constrianed('product_categories');
			$table->string('name');
			$table->text('description');
			$table->decimal('price');
			$table->decimal('discount')->nullable();
			$table->decimal('ratings')->default(5);
			$table->integer('ratings_count')->default(0);
            $table->string('weight')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('materials')->nullable();
            $table->string('colors')->nullable();
            $table->string('sizes')->nullable();
            $table->string('status');
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
		Schema::drop('products');
	}
}
