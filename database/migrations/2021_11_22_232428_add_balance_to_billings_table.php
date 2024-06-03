<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBalanceToBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->bigInteger('due_amount')->nullable();
            $table->bigInteger('deposited_amount')->nullable();
            $table->bigInteger('vat')->nullable();
            $table->bigInteger('total_without_tax')->nullable();
            $table->bigInteger('total_with_tax')->nullable();
            $table->bigInteger('Remise')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billings', function (Blueprint $table) {

            $table->bigInteger('due_amount')->nullable();
            $table->bigInteger('deposited_amount')->nullable();
            $table->bigInteger('vat')->nullable();
            $table->bigInteger('total_without_tax')->nullable();
            $table->bigInteger('total_with_tax')->nullable();
            $table->bigInteger('Remise')->nullable();
        });
    }
}
