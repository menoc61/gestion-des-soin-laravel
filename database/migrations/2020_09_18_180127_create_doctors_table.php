<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('speciality')->nullable();

            $table->string('saturday_from')->nullable();
            $table->string('saturday_to')->nullable();

            $table->string('sunday_from')->nullable();
            $table->string('sunday_to')->nullable();

            $table->string('monday_from')->nullable();
            $table->string('monday_to')->nullable();

            $table->string('tuesday_from')->nullable();
            $table->string('tuesday_to')->nullable();

            $table->string('wednesday_from')->nullable();
            $table->string('wednesday_to')->nullable();

            $table->string('thursday_from')->nullable();
            $table->string('thursday_to')->nullable();

            $table->string('friday_from')->nullable();
            $table->string('friday_to')->nullable();

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
        Schema::dropIfExists('doctors');
    }
}
