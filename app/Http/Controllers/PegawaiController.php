<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Biodata;
use App\Http\Requests\PegawaiBiodataRequest; // Import pegawaiRequest
use App\Models\PegawaiJabatan;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $kategori = $request->input('kategori', 'semua');
            $search = $request->input('search');
            $paging = $request->input('paging', 25);
            if ($kategori == "dosen")
                $pegawai = Pegawai::with('biodata')
                    ->when($search, function ($query, $search) {
                        return $query->whereHas('biodata', function ($query) use ($search) {
                            $query->where('nama_lengkap', 'LIKE', "%{$search}%");
                        })
                            ->orWhere('pegawai_nomor_induk', 'LIKE', "%{$search}%");
                    })
                    ->with(['biodata', 'dosen', 'statusAsn', 'kategori'])
                    ->where('is_dosen', 1)
                    ->paginate($paging);
            else if ($kategori == "non_dosen")
                $pegawai = Pegawai::with('biodata')
                    ->when($search, function ($query, $search) {
                        return $query->whereHas('biodata', function ($query) use ($search) {
                            $query->where('nama_lengkap', 'LIKE', "%{$search}%");
                        })
                            ->orWhere('pegawai_nomor_induk', 'LIKE', "%{$search}%");
                    })
                    ->with(['biodata', 'statusAsn', 'kategori'])
                    ->where('is_dosen', 0)
                    ->paginate($paging);
            else
                $pegawai = Pegawai::with('biodata')
                    ->when($search, function ($query, $search) {
                        return $query->whereHas('biodata', function ($query) use ($search) {
                            $query->where('nama_lengkap', 'LIKE', "%{$search}%");
                        })
                            ->orWhere('pegawai_nomor_induk', 'LIKE', "%{$search}%");
                    })
                    ->with(['biodata', 'statusAsn', 'kategori'])
                    ->paginate($paging);

            return response()->json([
                'status' => true,
                'data' => $pegawai,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $pegawai = Pegawai::with('biodata')->find($id);
            return response()->json([
                'status' => true,
                'data' => $pegawai,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function store(PegawaiBiodataRequest $request)
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

            // Simpan data pegawai dengan menambahkan biodata_id
            $pegawai = Pegawai::create([
                'idpeg' => $request->idpeg,
                'pegawai_nomor_induk' => $request->pegawai_nomor_induk,
                'biodata_id' => $biodata->id,
                'status_asn_id' => $request->status_asn_id,
                'kategori_id' => $request->kategori_id,
                'is_dosen' => $request->is_dosen,
            ]);

            $jabatan = PegawaiJabatan::create([
                'pegawai_id' => $pegawai->id,
                'master_jabatan_id' => $request->master_jabatan_id,
                'jabatan' => $request->jabatan,
                'pangkat' => $request->pangkat,
                'golongan' => $request->golongan,
                'is_current' => $request->is_current,
            ]);

            // Commit transaksi jika semua berhasil
            DB::commit();

            return response()->json([
                'status' => true,
                'data' => [
                    'biodata' => $biodata,
                    'pegawai' => $pegawai,
                    'jabatan' => $jabatan
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

    public function update(PegawaiBiodataRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $pegawai = Pegawai::findOrFail($id);

            // Update biodata terkait
            $biodata = Biodata::findOrFail($pegawai->biodata_id);
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

            // Update pegawai
            $pegawai->update([
                'idpeg' => $request->idpeg,
                'pegawai_nomor_induk' => $request->pegawai_nomor_induk,
                'biodata_id' => $biodata->id,
                'status_asn_id' => $request->status_asn_id,
                'kategori_id' => $request->kategori_id,
                'is_dosen' => $request->is_dosen,
            ]);

            // Commit transaksi jika semua berhasil
            DB::commit();

            return response()->json([
                'status' => true,
                'data' => [
                    'biodata' => $biodata,
                    'pegawai' => $pegawai,
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
}
