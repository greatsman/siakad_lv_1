<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGuruIdToMapel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mapel', function (Blueprint $table) {
            // 1. Create new column
            // You probably want to make the new column nullable
            $table->integer('guru_id')->unsigned()->nullable();

            // 2. Create foreign key constraints
            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mapel', function (Blueprint $table) {
           // 1. Drop foreign key constraints
           $table->dropForeign(['guru_id']);

           // 2. Drop the column
           $table->dropColumn('guru_id');
        });
    }
}
