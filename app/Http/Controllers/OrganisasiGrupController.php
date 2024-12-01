<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganisasiGrupRequest;
use App\Models\OrganisasiGrup;
use Illuminate\Http\Request;

class OrganisasiGrupController extends Controller
{
    public function index(Request $request)
    {
        try {
            $flag = $request->input('flag');
            $parent = $request->input('parent_id');
            $child = $request->input('child');
            $query = OrganisasiGrup::query();
            if ($flag)
                $query->where('grup_flag', $flag)->with('organisasi');
            if ($parent)
                $query->whereHas('organisasi', function ($organisasi) use ($parent) {
                    $organisasi->where('id', $parent);
                });
            if ($child == "yes")
                $query->with('organisasi.child');
            $data = $query->get();
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
    public function store(OrganisasiGrupRequest $request) // Use the custom request
    {
        try {
            $data = OrganisasiGrup::create($request->validated());

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
    public function show($id) // Use the custom request
    {
        try {
            $data = OrganisasiGrup::findOrFail($id);

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

    // UPDATE: Update mahasiswa jalur masuk
    public function update(OrganisasiGrupRequest $request, $id) // Use the custom request
    {
        try {
            $data = OrganisasiGrup::findOrFail($id);

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
            $jalurMasuk = OrganisasiGrup::findOrFail($id);
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
