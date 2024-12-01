<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganisasiRequest;
use App\Models\Organisasi;
use App\Models\OrganisasiGrup;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $grup = $request->input('grup', 'semua'); //Menampilkan berdasarkan grup, misalnya semua yang memiliki grup prodi
            $parent = $request->input('parent_id'); //menampilkan berdasarkan parent_id, misalnya mau menampilkan semua prodi di fakultas FATIK
            $query = Organisasi::query();

            if ($grup)
                // $data = OrganisasiGrup::where('grup_flag', $grup)->with('organisasi')->get();
                // ->with('grup', function ($grupQuery) use ($grup) {
                //     $grupQuery->where('grup_flag', $grup);
                // })
                $query->whereHas('grup', function ($grupQuery) use ($grup) {
                    $grupQuery->where('grup_flag', $grup);
                });
            if ($parent)
                $query->where('parent_id', $parent);
            // if ($child == "yes")
            //     $query->with('organisasi.child');
            // $data = $query->get();
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
    public function store(OrganisasiRequest $request) // Use the custom request
    {
        try {
            $data = Organisasi::create($request->validated());

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
            $data = Organisasi::findOrFail($id);

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
    public function update(OrganisasiRequest $request, $id) // Use the custom request
    {
        try {
            $data = Organisasi::findOrFail($id);

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
            $jalurMasuk = Organisasi::findOrFail($id);
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
