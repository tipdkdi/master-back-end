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
        Schema::create('pegawai_kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('kategori'); //Tenaga Pendidik, tenaga kependidikan, Honorer
            $table->string('alias'); //dosen, pegawai, honorer
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_kategoris');
    }
};
