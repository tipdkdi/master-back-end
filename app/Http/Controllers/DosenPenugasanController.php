<?php

namespace App\Http\Controllers;

use App\Http\Requests\DosenPenugasanRequest;
use App\Models\DosenPenugasan;
use Illuminate\Http\Request;

class DosenPenugasanController extends Controller
{
    public function index($id)
    {
        try {
            $data = DosenPenugasan::where('dosen_id', $id)->get();
            if ($data->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data dosen tidak ditemukan.'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => 'Data dosen berhasil diambil'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan saat mengambil data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(DosenPenugasanRequest $request) // Use the custom request
    {
        try {
            $data = DosenPenugasan::create($request->validated());

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
            $data = DosenPenugasan::findOrFail($id);
            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => 'Data dosen berhasil diambil'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan saat mengambil data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function update(DosenPenugasanRequest $request, $id) // Use the custom request
    {
        try {
            $data = DosenPenugasan::findOrFail($id);
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

    public function destroy($id)
    {
        try {
            $data = DosenPenugasan::findOrFail($id);
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
