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
            //     $kategori = $request->input('kategori', 'semua');
            //     $search = $request->input('search');
            //     $paging = $request->input('paging', 25);
            //     if ($kategori == "dosen")
            //         $pegawai = Pegawai::with(['biodata', 'jabatan'])
            //             ->when($search, function ($query, $search) {
            //                 return $query->whereHas('biodata', function ($query) use ($search) {
            //                     $query->where('nama_lengkap', 'LIKE', "%{$search}%");
            //                 })
            //                     ->orWhere('pegawai_nomor_induk', 'LIKE', "%{$search}%");
            //             })
            //             ->with(['biodata', 'dosen', 'statusAsn', 'kategori'])
            //             ->where('is_dosen', 1)
            //             ->paginate($paging);
            //     else if ($kategori == "non_dosen")
            //         $pegawai = Pegawai::with(['biodata', 'jabatan'])
            //             ->when($search, function ($query, $search) {
            //                 return $query->whereHas('biodata', function ($query) use ($search) {
            //                     $query->where('nama_lengkap', 'LIKE', "%{$search}%");
            //                 })
            //                     ->orWhere('pegawai_nomor_induk', 'LIKE', "%{$search}%");
            //             })
            //             ->with(['biodata', 'statusAsn', 'kategori'])
            //             ->where('is_dosen', 0)
            //             ->paginate($paging);
            //     else
            //         $pegawai = Pegawai::with(['biodata', 'jabatan'])
            //             ->when($search, function ($query, $search) {
            //                 return $query->whereHas('biodata', function ($query) use ($search) {
            //                     $query->where('nama_lengkap', 'LIKE', "%{$search}%");
            //                 })
            //                     ->orWhere('pegawai_nomor_induk', 'LIKE', "%{$search}%");
            //             })
            //             ->with(['biodata', 'statusAsn', 'kategori'])
            //             ->paginate($paging);

            // Ambil parameter query dari request
            $kategori = $request->input('kategori');
            $statusAsn = $request->input('status_asn');
            $statusDosen = $request->input('status_dosen'); // tetap, tidak_tetap, lb

            $jabatan = $request->input('jabatan');
            $search = $request->input('search');
            $paging = $request->input('paging', 25); // Default 25 item per halaman

            // Mulai query
            $pegawai = Pegawai::with(['biodata', 'jabatan.masterJabatan', 'dosen', 'statusAsn', 'kategori']);

            // Tambahkan filter untuk relasi kategori
            if ($kategori) {
                $pegawai->whereHas('kategori', function ($query) use ($kategori) {
                    $query->where('id', $kategori);
                });
            }
            // Jika ada status_dosen, tambahkan logika khusus untuk kategori dosen
            if ($statusDosen) {
                $pegawai->whereHas('dosen', function ($query) use ($statusDosen) {
                    $query->where('dosen_kategori', $statusDosen); // Filter dosen berdasarkan kategori
                });
            }

            // Tambahkan filter untuk relasi status ASN
            if ($statusAsn) {
                $pegawai->whereHas('statusAsn', function ($query) use ($statusAsn) {
                    $query->where('id', $statusAsn);
                });
            }

            // Tambahkan filter untuk relasi dosen
            if ($statusDosen) {
                $pegawai->whereHas('dosen', function ($query) use ($statusDosen) {
                    $query->where('dosen_kategori', $statusDosen);
                });
            }

            // Tambahkan filter untuk relasi jabatan
            if ($jabatan) {
                $pegawai->whereHas('jabatan.masterJabatan', function ($query) use ($jabatan) {
                    $query->where('id', $jabatan);
                });
            }


            // Tambahkan pencarian (search) berdasarkan nama dan pegawai_nomor_induk
            if ($search) {
                $pegawai->where(function ($query) use ($search) {
                    $query->where('pegawai_nomor_induk', 'like', '%' . $search . '%') // Pencarian di kolom pegawai_nomor_induk
                        ->orWhereHas('biodata', function ($query) use ($search) {
                            $query->where('nama_lengkap', 'like', '%' . $search . '%'); // Pencarian di kolom nama di tabel biodata
                        });
                });
            }
            // Tambahkan pengurutan berdasarkan nama (di tabel biodata)
            $pegawai->orderBy(
                Biodata::select('nama_lengkap')
                    ->whereColumn('biodatas.id', 'pegawais.biodata_id')
                    ->limit(1)
            );
            // Eksekusi query dengan pagination
            $data = $pegawai->paginate($paging);

            return response()->json([
                'status' => true,
                'data' => $data,
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
                'pesan' => "Data ditemukan",
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
                'gelar_depan' => $request->gelar_depan,
                'gelar_belakang' => $request->gelar_belakang,
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
                'gelar_depan' => $request->gelar_depan,
                'gelar_belakang' => $request->gelar_belakang,
                'biodata_id' => $biodata->id,
                'status_asn_id' => $request->status_asn_id,
                'kategori_id' => $request->kategori_id,
                'is_dosen' => $request->is_dosen,
            ]);

            $pegawaiJabatan = PegawaiJabatan::where('pegawai_id', $id)->first();
            $pegawaiJabatan->update([
                'pegawai_id' => $id,
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

    public function destroy($id)
    {
        try {
            // $jalurMasuk = MahasiswaPrestasi::findOrFail($id);
            $data = PegawaiJabatan::where('pegawai_id', $id);
            $data->delete();

            $data = Pegawai::findOrFail($id);
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
