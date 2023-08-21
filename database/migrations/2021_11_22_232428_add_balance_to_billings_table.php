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
            $table->string('due_amount')->nullable();
            $table->string('deposited_amount')->nullable();
            $table->string('vat')->nullable();
            $table->string('total_without_tax')->nullable();
            $table->string('total_with_tax')->nullable();
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
            
            $table->string('due_amount')->nullable();
            $table->string('deposited_amount')->nullable();
            $table->string('vat')->nullable();
            $table->string('total_without_tax')->nullable();
            $table->string('total_with_tax')->nullable();

        });
    }
}
