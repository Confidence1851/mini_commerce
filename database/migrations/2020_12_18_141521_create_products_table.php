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
			$table->string('reference' , 50)->unique();
			$table->decimal('ratings')->default(5);
			$table->integer('ratings_count')->default(0);
			$table->integer('total_views')->default(0);
			$table->integer('total_orders')->default(0);
            $table->string('weight')->nullable();
            $table->text('dimensions')->nullable();
            $table->text('materials')->nullable();
            $table->text('colors')->nullable();
            $table->text('sizes')->nullable();
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
