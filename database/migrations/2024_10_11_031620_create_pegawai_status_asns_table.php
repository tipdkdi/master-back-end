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
        Schema::create('pegawai_status_asns', function (Blueprint $table) {
            $table->id();
            $table->string('asn_nama'); //contoh Pegawai Negeri Sipil
            $table->string('singkatan'); //Contoh PNS
            $table->string('sebutan_nomor_induk'); //NIP
            $table->boolean('is_asn');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_status_asns');
    }
};
