<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCartItemsTable.
 */
class CreateCartItemsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cart_items', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id',false);
            $table->unsignedBigInteger('product_id',false)->nullable();
            $table->integer('price')->default(0);
            $table->integer('quantity')->default(1);
            $table->decimal('discount')->default(0);
            $table->decimal('total')->default(0);
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
		Schema::drop('cart_items');
	}
}
