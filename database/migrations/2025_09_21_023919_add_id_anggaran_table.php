<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdAnggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penugasans', function (Blueprint $table) {
            //
              $table->foreignId('id_anggaran')->after('id')->nullable();
        $table->foreignId('id_obrik')->after('id')->nullable();
        $table->foreignId('id_jenisPengawasan')->after('id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penugasans', function (Blueprint $table) {
            //
        });
    }
}
