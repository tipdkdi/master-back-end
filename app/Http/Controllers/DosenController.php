<?php

namespace App\Http\Controllers;

use App\Http\Requests\DosenRequest;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function index()
    {
        $data = Dosen::with('pegawai.biodata')->paginate(10);
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'Data dosen berhasil diambil'
        ], 200);
    }

    public function store(DosenRequest $request) // Use the custom request
    {
        try {
            $data = Dosen::create($request->validated());

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

    public function update(DosenRequest $request, $id) // Use the custom request
    {
        try {
            $data = Dosen::findOrFail($id);

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
            $jalurMasuk = Dosen::findOrFail($id);
            $jalurMasuk->delete();

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
