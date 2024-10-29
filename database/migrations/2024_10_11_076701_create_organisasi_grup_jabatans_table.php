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
        Schema::create('organisasi_grup_jabatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organisasi_grup_id');
            $table->foreign('organisasi_grup_id')->references('id')->on('organisasi_grups');

            $table->string('jabatan', 200);
            $table->string('flag');
            $table->integer('urutan');
            $table->string('keterangan', 100)->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisasi_grup_jabatans');
    }
};
