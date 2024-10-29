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
        Schema::create('mahasiswa_orang_tuas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id')->unique();;
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas');

            $table->string('ayah_nik', 20);
            $table->string('ayah_nama', 100);
            $table->date('ayah_tgl_lahir')->nullable();

            $table->unsignedBigInteger('pekerjaan_ayah_id');
            $table->foreign('pekerjaan_ayah_id')->references('id')->on('master_pekerjaans');
            $table->unsignedBigInteger('pendapatan_ayah_id');
            $table->foreign('pendapatan_ayah_id')->references('id')->on('master_pendapatans');

            $table->string('ibu_nik', 20);
            $table->string('ibu_nama', 100);
            $table->date('ibu_tgl_lahir');

            $table->unsignedBigInteger('pekerjaan_ibu_id');
            $table->foreign('pekerjaan_ibu_id')->references('id')->on('master_pekerjaans');
            $table->unsignedBigInteger('pendapatan_ibu_id');
            $table->foreign('pendapatan_ibu_id')->references('id')->on('master_pendapatans');

            $table->string('hp_ortu');
            $table->text('alamat');
            $table->string('kelurahan');
            $table->string('kecamatan_id'); //untuk pddikti
            $table->string('kecamatan'); //otomatis dari pilihan kecamatan_id
            $table->string('kabupaten'); //otomatis dari pilihan kecamatan_id
            $table->string('provinsi'); //otomatis dari pilihan kecamatan_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_orang_tuas');
    }
};
