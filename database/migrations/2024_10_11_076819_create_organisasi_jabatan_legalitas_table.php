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
        Schema::create('organisasi_jabatan_legalitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organisasi_id');
            $table->foreign('organisasi_id')->references('id')->on('organisasis')->onDelete('cascade');
            // $table->unsignedBigInteger('organisasi_grup_jabatan_id')->nullable();
            // $table->foreign('organisasi_grup_jabatan_id')->references('id')->on('organisasi_grup_jabatans');

            $table->year('tahun');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('sk_nomor');
            $table->string('sk_tanggal');
            // $table->boolean('is_aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisasi_jabatan_legalitas');
    }
};
