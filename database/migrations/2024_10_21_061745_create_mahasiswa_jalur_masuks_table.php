<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa_jalur_masuks', function (Blueprint $table) { //import dari SPMB
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id')->unique();
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas');

            $table->string('jalur_pendaftaran');
            $table->string('jenis_pendaftaran');
            $table->date('tanggal_masuk');
            $table->string('periode_pendaftaran');
            $table->string('pembiayaan_awal')->default('mandiri');
            $table->string('biaya_masuk');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_jalur_masuks');
    }
};
