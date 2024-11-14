<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaJalurMasukController;
use App\Http\Controllers\MahasiswaOrtuController;
use App\Http\Controllers\MahasiswaPrestasiController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\OrganisasiGrupController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DosenPenugasanController;
use App\Http\Controllers\GrupJabatanController;
use App\Http\Controllers\OrganisasiPejabatController;
use App\Http\Controllers\LainnyaController;
use App\Http\Middleware\JwtMiddleware;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('login', [JWTAuthController::class, 'login']);

// Route::resource('biodata', BiodataController::class);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::resource('mahasiswa', MahasiswaController::class)->parameters([
        'mahasiswa' => 'mahasiswa_id'
    ]);
    Route::resource('pegawai', PegawaiController::class)->parameters([
        'pegawai' => 'pegawai_id'
    ]);

    Route::resource('dosen', DosenController::class)->parameters([
        'dosen' => 'dosen_id'
    ]);
    Route::put('dosen/{dosen_id}/penugasan', [DosenPenugasanController::class, 'updateByDosenId']); //dipisah dari resource agar bisa tetap konsisten mahasiswa/id/orang_tua
    Route::delete('dosen/{dosen_id}/penugasan', [DosenPenugasanController::class, 'destroy']); //dipisah dari resource agar bisa tetap konsisten mahasiswa/id/orang_tua
    Route::resource('dosen.penugasan', DosenPenugasanController::class)->parameters([
        'penugasan' => 'penugasan_id'
    ]);

    Route::put('mahasiswa/{mahasiswa}/orang_tua', [MahasiswaOrtuController::class, 'updateByMahasiswaId']); //dipisah dari resource agar bisa tetap konsisten mahasiswa/id/orang_tua
    Route::resource('mahasiswa.orang_tua', MahasiswaOrtuController::class);

    Route::put('mahasiswa/{mahasiswa}/jalur_masuk', [MahasiswaJalurMasukController::class, 'updateByMahasiswaId']); //dipisah dari resource agar bisa tetap konsisten mahasiswa/id/orang_tua
    Route::delete('mahasiswa/{mahasiswa_id}/jalur_masuk', [MahasiswaJalurMasukController::class, 'destroy']); //dipisah dari resource agar bisa tetap konsisten mahasiswa/id/orang_tua
    Route::resource('mahasiswa.jalur_masuk', MahasiswaJalurMasukController::class);

    Route::put('mahasiswa/{mahasiswa}/prestasi', [MahasiswaPrestasiController::class, 'updateByMahasiswaId']); //dipisah dari resource agar bisa tetap konsisten mahasiswa/id/orang_tua
    Route::delete('mahasiswa/{mahasiswa_id}/prestasi', [MahasiswaPrestasiController::class, 'destroy']); //dipisah dari resource agar bisa tetap konsisten mahasiswa/id/orang_tua
    Route::resource('mahasiswa.prestasi', MahasiswaPrestasiController::class);

    Route::resource('organisasi-grup', OrganisasiGrupController::class)->parameters([
        'organisasi-grup' => 'organisasi_grup_id'
    ]);
    Route::resource('organisasi', OrganisasiController::class)->parameters([
        'organisasi' => 'organisasi_id'
    ]);

    //INI UNTUK JABATAN DI ORGANISASI GRUP, MISALNYA DI GRUP FAKULTAS JABATAN YANG ADA DEKAN, WADEK, DLL
    //MISALNYA JUGA UNTUK GRUP PRODI, ADA KAPRODI, SEKRETARIS PRODI DLL
    //UNTUK MASTER JABATAN DI ORGANISASI GRUP
    Route::put('organisasi-grup/{grup_id}/jabatan', [GrupJabatanController::class, 'update']);
    Route::delete('organisasi-grup/{grup_id}/jabatan', [GrupJabatanController::class, 'destroy']);
    Route::resource('organisasi-grup.jabatan', GrupJabatanController::class)->parameters([
        'organisasi-grup' => 'grup_id'
    ]);

    // Route::put('organisasi/{grup_id}/pejabat', [OrganisasiPejabatController::class, 'update']);
    // Route::delete('organisasi/{grup_id}/pejabat', [OrganisasiPejabatController::class, 'destroy']);
    // Route::resource('organisasi.pejabat', OrganisasiPejabatController::class)->parameters([
    // 'organisasi.pejabat' => 'organisasi_id'
    // ]);
    // Rute untuk GET dan POST dengan prefix organisasi/{organisasi}/pejabat
    Route::get('organisasi/{organisasi}/pejabat', [OrganisasiPejabatController::class, 'index'])->name('organisasi.pejabat.index');
    Route::post('organisasi/{organisasi}/pejabat', [OrganisasiPejabatController::class, 'store'])->name('organisasi.pejabat.store');

    // Rute untuk tindakan yang memerlukan ID menggunakan prefix pejabat/{id}
    Route::get('pejabat/{id}', [OrganisasiPejabatController::class, 'show'])->name('pejabat.show');
    Route::put('pejabat/{id}', [OrganisasiPejabatController::class, 'update'])->name('pejabat.update');
    Route::delete('pejabat/{id}', [OrganisasiPejabatController::class, 'destroy'])->name('pejabat.destroy');


    Route::get('status-asn', [LainnyaController::class, 'statusAsn'])->name('status.asn');
    Route::get('kategori-pegawai', [LainnyaController::class, 'kategoriPegawai'])->name('kategori.pegawai');
    Route::get('decrypt', [LainnyaController::class, 'decrypt'])->name('decrypt');
});
