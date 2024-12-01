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
        Schema::create('organisasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organisasi_grup_id');
            $table->foreign('organisasi_grup_id')->references('id')->on('organisasi_grups');

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('organisasis');

            $table->string('organisasi_nama', 200);
            $table->string('pddikti_kode')->nullable();
            $table->string('singkatan', 200);
            $table->string('singkatan_sia', 200)->nullable(); //untuk sementara sampai data sia semua sudah pindah
            $table->text('keterangan')->nullable();
            $table->integer('urutan');
            $table->boolean('is_current')->nullable()->default(true);
            $table->boolean('is_aktif')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisasis');
    }
};
