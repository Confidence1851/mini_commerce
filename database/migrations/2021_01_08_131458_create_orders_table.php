<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateOrdersTable.
 */
class CreateOrdersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id', false);
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->unsignedBigInteger('payment_id')->nullable();
            $table->unsignedBigInteger('delivery_address_id')->nullable();
            $table->string('reference')->unique();
            $table->decimal('amount');
            $table->decimal('discount')->default(0);
            $table->string('payment_method');
            $table->text("history")->nullable();
            $table->string('file')->nullable();
            $table->string('comment')->nullable();
            $table->string('message')->nullable();
            $table->string('status');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->nullOnDelete();
        	$table->foreign('delivery_address_id')->references('id')->on('delivery_addresses')->nullOnDelete();
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
		Schema::drop('orders');
	}
}
