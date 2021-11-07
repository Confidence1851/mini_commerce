<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable()->nullOnDelete()->constrained("users");
            $table->foreignId('user_id')->index()->constrained("users");
            $table->string('payer_email')->nullable();
            $table->string('currency')->nullable();
            $table->string('gateway')->nullable();
            $table->string('method');
            $table->string('reference')->unique();
            $table->decimal('amount');
            $table->decimal('fees')->default(0);
            $table->string('receipt')->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->string('status')->default("Pending");
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
        Schema::dropIfExists('payments');
    }
}
