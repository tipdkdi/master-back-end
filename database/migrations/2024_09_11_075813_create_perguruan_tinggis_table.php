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
        Schema::create('perguruan_tinggis', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('singkatan', 100);
            $table->string('alamat_1', 100);
            $table->string('alamat_2', 100);
            $table->string('alamat_3', 100);
            $table->string('alamat_4', 100)->nullable();
            $table->string('kode_pddikti', 100);
            $table->string('kode_kemenag', 100);
            $table->boolean('is_current')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perguruan_tinggis');
    }
};
