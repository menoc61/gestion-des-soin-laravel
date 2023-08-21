<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('test_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->mediumText('description')->nullable();
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
        Schema::dropIfExists('prescription_tests');
    }
}
