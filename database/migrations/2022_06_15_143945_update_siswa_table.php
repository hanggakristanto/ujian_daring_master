<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->string('ktp')->nullable();
            $table->string('jk')->nullable();
            $table->string('cv')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('wa', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn('ktp');
            $table->dropColumn('jk');
            $table->dropColumn('cv');
            $table->dropColumn('ijazah');
            $table->dropColumn('wa');
        });
    }
}
