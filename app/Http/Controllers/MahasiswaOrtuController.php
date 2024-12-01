<?php

namespace App\Http\Controllers;

use App\Http\Requests\MahasiswaOrtuRequest;
use App\Models\MahasiswaOrangTua;
use Illuminate\Http\Request;

class MahasiswaOrtuController extends Controller
{
    public function index($mahasiswa_id)
    {
        try {
            // Pencarian data Ortu berdasarkan mahasiswa_id
            $query = MahasiswaOrangTua::with(['pekerjaanAyah', 'pekerjaanIbu', 'pendapatanAyah', 'pendapatanIbu'])
                ->where('mahasiswa_id', $mahasiswa_id)->first();

            return response()->json([
                'status' => true,
                'data' => $query,
                'pesan' => 'Data berhasil diambil.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'data' => null,
                'pesan' => 'Terjadi kesalahan saat mengambil data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    // Store: Create new Ortu record
    public function store(MahasiswaOrtuRequest $request)
    {
        try {
            $ortu = MahasiswaOrangTua::create($request->validated());

            return response()->json([
                'status' => true,
                'data' => $ortu,
                'pesan' => 'Data berhasil disimpan.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'data' => null,
                'pesan' => 'Terjadi kesalahan saat menyimpan data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Update: Update Ortu record
    public function update(MahasiswaOrtuRequest $request, $id)
    {
        try {
            $data = MahasiswaOrangTua::findOrFail($id);
            $data->update($request->validated());

            return response()->json([
                'status' => true,
                'data' => $data,
                'pesan' => 'Data berhasil diupdate.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'data' => null,
                'pesan' => 'Terjadi kesalahan saat mengupdate data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
