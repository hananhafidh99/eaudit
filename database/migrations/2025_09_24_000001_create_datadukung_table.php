<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datadukung', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pengawasan');
            $table->string('nama_file');
            $table->timestamps();

            // Foreign key constraint (optional)
            $table->foreign('id_pengawasan')->references('id')->on('pengawasans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datadukung');
    }
};
