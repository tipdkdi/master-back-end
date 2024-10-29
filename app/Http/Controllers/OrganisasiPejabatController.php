<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganisasiPejabatRequest;
use App\Models\OrganisasiPejabat;
use Illuminate\Http\Request;

class OrganisasiPejabatController extends Controller
{
    public function index($id)
    {
        $data = OrganisasiPejabat::where('organisasi_id', $id)->get();
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'Data dosen berhasil diambil'
        ], 200);
    }

    public function store(OrganisasiPejabatRequest $request) // Use the custom request
    {
        try {
            $data = OrganisasiPejabat::create($request->validated());

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

    public function update(OrganisasiPejabatRequest $request, $id) // Use the custom request
    {
        try {
            $data = OrganisasiPejabat::findOrFail($id);
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

            $data = OrganisasiPejabat::findOrFail($id);
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
