<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropDrugIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_report', function (Blueprint $table) {
            //
           
                $table->dropForeign(['drug_id']);
                $table->dropColumn('drug_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_report', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('drug_id')->nullable();
            // Réapplique la clé étrangère
            $table->foreign('drug_id')->references('id')->on('drugs')->onDelete('cascade');
        });
    }
}
