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
            // $grup = $request->input('grup');
            // $parent = $request->input('parent_id');
            // $query = Organisasi::query();

            // if ($grup) {
            //     // Menyaring berdasarkan grup_flag dari relasi grup
            //     $query->whereHas('grup', function ($query) use ($grup) {
            //         $query->where('grup_flag', $grup);
            //     });
            // }
            // if ($parent) {
            //     // Menyaring berdasarkan grup_flag dari relasi grup
            //     $query->where('parent_id', $parent);
            // }

            // // Memuat relasi grup dan mengambil hasil paginated
            // $data = $query->with('grup')->paginate(25);

            $grup = $request->input('grup', 'semua');
            $parent = $request->input('parent_id');
            $id = $request->input('id');
            if ($grup)
                $data = OrganisasiGrup::where('grup_flag', $grup)->with('organisasi')->get();
            if ($parent)
                $data = Organisasi::where('parent_id', $parent)->get();
            if ($id)
                $data = Organisasi::with(['grup'])->find($id);
            // if ($child == "yes")
            //     $query->with('organisasi.child');
            // $data = $query->get();

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
