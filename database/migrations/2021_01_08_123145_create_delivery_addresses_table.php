<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateDeliveryAddressesTable.
 */
class CreateDeliveryAddressesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delivery_addresses', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id',false);
            $table->string('name');
            $table->string('apartment_no')->nullable();
            $table->text('address');
            $table->string('zip_code')->nullable();
            $table->text('city')->nullable();
            $table->text('state');
            $table->text('country');
            $table->string('phone');
            $table->string('phone_2')->nullable();
            $table->tinyInteger('is_default')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
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
		Schema::drop('delivery_addresses');
	}
}
