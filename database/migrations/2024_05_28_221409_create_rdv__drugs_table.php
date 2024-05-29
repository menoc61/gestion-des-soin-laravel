<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRdvDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rdv__drugs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('appointment_id')->nullable()->default(null)
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('drug_id')->nullable()->default(null)
                ->constrained()
                ->onDelete('cascade');

            $table->decimal('montant_drug')->nullable();
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
        Schema::dropIfExists('rdv__drugs');
    }
}
