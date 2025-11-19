<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdPeranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_tugas', function (Blueprint $table) {
            //
             $table->foreignId('id_pegawai')->after('id')->nullable();
        $table->foreignId('id_peran')->after('id')->nullable();
        $table->foreignId('id_penugasan')->after('id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_tugas', function (Blueprint $table) {
            //
        });
    }
}
