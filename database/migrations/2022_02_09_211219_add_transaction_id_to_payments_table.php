<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionIdToPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn("payments", "transaction_id")) {
                $table->unsignedBigInteger("transaction_id")->nullable();
            }
            if (!Schema::hasColumn("payments", "fee")) {
                $table->double("fee")->default(0);
            }
            if (!Schema::hasColumn("payments", "activity")) {
                $table->string("activity")->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            //
        });
    }
}
