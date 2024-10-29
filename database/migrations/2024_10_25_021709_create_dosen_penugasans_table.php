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
        Schema::create('dosen_penugasans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dosen_id');
            $table->foreign('dosen_id')->references('id')->on('dosens');
            $table->unsignedBigInteger('prodi');
            $table->foreign('prodi')->references('id')->on('organisasis');

            $table->string('tahun_ajar');
            $table->string('surat_tugas_nomor');
            $table->date('surat_tugas_tanggal');
            $table->date('surat_tugas_tmt');
            $table->string('surat_tugas_file')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_penugasans');
    }
};
