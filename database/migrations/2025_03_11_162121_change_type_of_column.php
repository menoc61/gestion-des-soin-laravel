<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeOfColumn extends Migration
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
            $table->string('next_rdv')->nullable()->change();
            $table->string('pourboire')->nullable()->change();
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
            $table->date('next_rdv')->change();
            $table->float('pourboire')->change();
        });
    }
}
