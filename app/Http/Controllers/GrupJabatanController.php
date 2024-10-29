<?php

namespace App\Http\Controllers;

use App\Http\Requests\GrupJabatanRequest;
use App\Models\OrganisasiGrupJabatan;
use Illuminate\Http\Request;

//INI UNTUK JABATAN DI ORGANISASI GRUP, MISALNYA DI GRUP FAKULTAS JABATAN YANG ADA DEKAN, WADEK, DLL
//MISALNYA JUGA UNTUK GRUP PRODI, ADA KAPRODI, SEKRETARIS PRODI DLL
//UNTUK MASTER JABATAN DI ORGANISASI GRUP
class GrupJabatanController extends Controller
{
    public function index($id)
    {
        $data = OrganisasiGrupJabatan::where('organisasi_grup_id', $id)->first();
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => 'Data dosen berhasil diambil'
        ], 200);
    }

    public function store(GrupJabatanRequest $request) // Use the custom request
    {
        try {
            $data = OrganisasiGrupJabatan::create($request->validated());

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

    public function update(GrupJabatanRequest $request, $id) // Use the custom request
    {
        try {
            $data = OrganisasiGrupJabatan::findOrFail($id);
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

            $data = OrganisasiGrupJabatan::findOrFail($id);
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
