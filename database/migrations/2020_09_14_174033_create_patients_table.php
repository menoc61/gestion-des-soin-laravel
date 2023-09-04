<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('birthday');
            $table->string('phone')->nullable();
            $table->mediumText('adress')->nullable();
            $table->string('gender');
            $table->string('medication')->nullable();
            $table->string('hobbie')->nullable();
            $table->string('demande')->nullable();
            $table->string('allergie')->nullable();
            $table->json('type_patient')->nullable();
            $table->json('alimentation')->nullable();
            $table->string('digestion')->nullable();
            $table->json('morphology')->nullable();

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
        Schema::dropIfExists('patients');
    }
}
