<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDoctorIdToActivityreportTable extends Migration
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
            $table->unsignedBigInteger('doctor_id')->default(3);
            $table->foreign('doctor_id')->references('id')->on('users');
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
            $table->unsignedBigInteger('doctor_id')->default(3);
            $table->foreign('doctor_id')->references('id')->on('users');
        });
    }
}
