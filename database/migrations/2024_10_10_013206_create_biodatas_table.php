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
        Schema::create('biodatas', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama_lengkap', 150);
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
            $table->string('lahir_tempat', 100)->nullable();
            $table->date('lahir_tanggal')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->enum('agama', ['islam', 'kristen', 'budha', 'hindu'])->default('islam');
            $table->text('alamat_domisili')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodatas');
    }
};
