<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_drugs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('prescription_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('drug_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('type')->nullable();
            $table->string('strength')->nullable();
            $table->string('dose')->nullable();
            $table->string('duration')->nullable();
            $table->mediumText('drug_advice')->nullable();
            
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
        Schema::dropIfExists('prescription_drugs');
    }
}
