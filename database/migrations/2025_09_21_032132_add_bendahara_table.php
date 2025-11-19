<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBendaharaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skpds', function (Blueprint $table) {
            //
              $table->string('id_bendahara')->after('id')->nullable();
              $table->string('id_pimpinan')->after('id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skpds', function (Blueprint $table) {
            //
        });
    }
}
