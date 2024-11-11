<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Biodata;
use App\Http\Requests\MahasiswaBiodataRequest; // Import MahasiswaRequest
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{

    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            $paging = $request->input('paging', 25);
            // if ($request->filled('search')) {
            //     $search = $request->search;
            $mahasiswa = Mahasiswa::with('biodata')
                ->when($search, function ($query, $search) {
                    return $query->whereHas('biodata', function ($query) use ($search) {
                        $query->where('nama_lengkap', 'LIKE', "%{$search}%");
                    })
                        ->orWhere('nim', 'LIKE', "%{$search}%");
                })
                ->with(['biodata', 'prodi.fakultas'])
                ->paginate($paging);

            return response()->json([
                'status' => true,
                'data' => $mahasiswa,
                'pesan' => "",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function store(MahasiswaBiodataRequest $request)
    {
        DB::beginTransaction();

        try {
            // Simpan data biodata
            $biodata = Biodata::create($request->only([
                'nik',
                'nama_lengkap',
                'jenis_kelamin',
                'lahir_tempat',
                'lahir_tanggal',
                'no_hp',
                'agama',
                'alamat_domisili'
            ]));

            // Simpan data mahasiswa dengan menambahkan biodata_id
            $mahasiswa = Mahasiswa::create([
                'iddata' => $request->iddata,
                'nisn' => $request->nisn,
                'nim' => $request->nim,
                'prodi_id' => $request->prodi_id,
                'is_luar_negeri' => $request->is_luar_negeri,
                'biodata_id' => $biodata->id,
            ]);

            // Commit transaksi jika semua berhasil
            DB::commit();

            return response()->json([
                'status' => true,
                'data' => [
                    'biodata' => $biodata,
                    'mahasiswa' => $mahasiswa
                ],
                'pesan' => 'Data berhasil disimpan.',
            ], 201);
        } catch (\Exception $e) {
            // Rollback transaksi jika ada kesalahan
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(MahasiswaBiodataRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $mahasiswa = Mahasiswa::findOrFail($id);

            // Update biodata terkait
            $biodata = Biodata::findOrFail($mahasiswa->biodata_id);
            $biodata->update($request->only([
                'nik',
                'nama_lengkap',
                'jenis_kelamin',
                'lahir_tempat',
                'lahir_tanggal',
                'no_hp',
                'agama',
                'alamat_domisili'
            ]));

            // Update mahasiswa
            $mahasiswa->update([
                'iddata' => $request->iddata,
                'nisn' => $request->nisn,
                'nim' => $request->nim,
                'prodi_id' => $request->prodi_id,
                'is_luar_negeri' => $request->is_luar_negeri,
            ]);

            // Commit transaksi jika semua berhasil
            DB::commit();

            return response()->json([
                'status' => true,
                'data' => [
                    'biodata' => $biodata,
                    'mahasiswa' => $mahasiswa,
                ],
                'pesan' => 'Data berhasil diperbarui.',
            ]);
        } catch (\Exception $e) {
            // Rollback transaksi jika ada kesalahan
            DB::rollBack();

            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }


    // public function destroy($id)
    // {
    //     // Cari data dan hapus
    //     $mahasiswa = Mahasiswa::findOrFail($id);
    //     $mahasiswa->delete();

    //     return response()->json([
    //         'status' => true,
    //         'pesan' => 'Data berhasil dihapus.',
    //     ], 200);
    // }
}
