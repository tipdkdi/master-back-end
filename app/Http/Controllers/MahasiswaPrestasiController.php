<?php

namespace App\Http\Controllers;

use App\Http\Requests\MahasiswaPrestasiRequest;
use App\Models\MahasiswaPrestasi;
use Illuminate\Http\Request;

class MahasiswaPrestasiController extends Controller
{
    public function index($mahasiswa_id)
    {
        try {
            // Get jalur masuk for the specified mahasiswa_id
            $data = MahasiswaPrestasi::where('mahasiswa_id', $mahasiswa_id)->get();

            // Check if jalur masuk exists
            if ($data->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'data' => null,
                    'pesan' => 'Data prestasi tidak ditemukan untuk mahasiswa ini.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'data' => $data,
                'pesan' => 'Data berhasil diambil.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Gagal mengambil data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // STORE: Create new mahasiswa jalur masuk
    public function store(MahasiswaPrestasiRequest $request) // Use the custom request
    {
        try {
            // Data already validated by the request
            $data = MahasiswaPrestasi::create($request->validated());

            return response()->json([
                'status' => true,
                'data' => $data,
                'pesan' => 'Data berhasil disimpan.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan saat menyimpan data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function show($id)
    {
        try {
            // Get jalur masuk for the specified mahasiswa_id
            $data = MahasiswaPrestasi::findOrFail($id);

            return response()->json([
                'status' => true,
                'data' => $data,
                'pesan' => 'Data berhasil diambil.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Gagal mengambil data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    // UPDATE: Update mahasiswa jalur masuk
    public function update(MahasiswaPrestasiRequest $request, $id) // Use the custom request
    {
        try {
            // $jalurMasuk = MahasiswaJalurMasuk::findOrFail($id);
            // $jalurMasuk = MahasiswaPrestasi::where('mahasiswa_id', $id)->firstOrFail();
            $data = MahasiswaPrestasi::findOrFail($id);
            $data->update($request->validated());
            return response()->json([
                'status' => true,
                'data' => $data,
                'pesan' => 'Data berhasil diupdate.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan saat mengupdate data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // DELETE: Delete mahasiswa jalur masuk
    public function destroy($id)
    {
        try {
            // $jalurMasuk = MahasiswaPrestasi::findOrFail($id);
            $data = MahasiswaPrestasi::findOrFail($id);
            $data->delete();
            return response()->json([
                'status' => true,
                'pesan' => 'Data berhasil dihapus.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan saat menghapus data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
