<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('test_name');
            $table->string('diagnostic_type');
            $table->mediumText('comment')->nullable();

            $table->string('signes_particuliers_peau')->nullable();

            $table->string('Etat_generale_des_mains')->nullable();
            $table->string('Etat_des_ongles_mains')->nullable();
            $table->string('signes_particuliers_mains')->nullable();
            $table->string('signes_particuliers_ongles_mains')->nullable();
            $table->string('soinList_main')->nullable();
            $table->string('vernisInput_main')->nullable();
            $table->string('obserationInput_main')->nullable();
            $table->string('reliefInput_main')->nullable();
            $table->string('cicatrices_main')->nullable();
            $table->string('callosites_main')->nullable();
            $table->string('spInput_main')->nullable();
            $table->string('skinStateInput_main')->nullable();
            $table->string('tache_main')->nullable();
            $table->string('cicatrices_main_dorsal')->nullable();
            $table->string('callosite_main_dorsal')->nullable();
            $table->string('spInput_main_dorsal')->nullable();

            $table->string('Etat_generale_des_pieds')->nullable();
            $table->string('Etat_des_ongles_pieds')->nullable();
            $table->string('signes_particuliers_pieds')->nullable();
            $table->string('signes_particuliers_ongles_pieds')->nullable();
            $table->string('soinList_pied')->nullable();
            $table->string('vernisInput_pied')->nullable();
            $table->string('obserationInput_pied')->nullable();
            $table->string('etat_pieds')->nullable();
            $table->string('taches_pieds')->nullable();
            $table->string('aureoles_pieds')->nullable();
            $table->string('veines_face_ext_pieds')->nullable();
            $table->string('veines_face_int_pieds')->nullable();
            $table->string('douleur_talon_pieds')->nullable();
            $table->string('spInput_pieds')->nullable();

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
        Schema::dropIfExists('tests');
    }
}
