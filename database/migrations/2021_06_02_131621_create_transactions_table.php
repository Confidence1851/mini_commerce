<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained("users");
            $table->string('reference' , 50)->unique();
            $table->double('amount' , 12 , 2);
            $table->double('fee' , 12 , 2)->default(0);
            $table->double('total' , 12 , 2);
            $table->enum('type' , ["Debit" , "Credit"]);
            $table->string('description');
            $table->string('activity');
            $table->string('batch_no')->index()->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
