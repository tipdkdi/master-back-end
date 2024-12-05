<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Dosen;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\UserBiodata;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    public function importPegawai(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = json_decode($request->data);
            $name = "";
            $roleId = "";

            if ($data->email != null || $data->email != "") {
                $check = User::where("email", $data->email)->first();
                if ($check == null) {
                    $user = User::create([
                        'name' => $data->nama,
                        'email' => $data->email,
                        'password' => bcrypt($request->nip),
                        'foto' => "/",
                    ]);

                    $statusAsnId = 1; //PNS
                    $kategoriId = 1; // Pegawai / Tendik / Non Dosen
                    $isDosen = false;

                    if ($data->jenispns == "P3K") {
                        $statusAsnId = 2; //P3K
                    } else if ($data->jenispns == "NON PNS") {
                        $statusAsnId = 3; //NON PNS
                        $kategoriId = 3; // Honorer
                    }
                    // if (in_array($data->no_nidn, ['', '-', '.', '0', 'No.Baru Kartu ASN A200500005021'])) {
                    // }

                    $checkPegawai = Pegawai::where('pegawai_nomor_induk', $data->nip)->first();
                    if (empty($checkPegawai)) {
                        $biodata = Biodata::create([
                            'nik' => $data->no_ktp,
                            'nama_lengkap' => $data->nama,
                            'jenis_kelamin' => $data->kel,
                            'lahir_tempat' => $data->tmp_lhr,
                            'lahir_tanggal' => $data->tgl_lhr,
                            'no_hp' => $data->no_telp,
                            // 'agama' => $data->agama,
                            'alamat_domisili' => $data->ar_jalan . ", " . $data->ar_kab . ", Kec. " . $data->ar_kec . ", " . $data->ar_prov,
                        ]);
                        UserBiodata::create([
                            'user_id' => $user->id,
                            'biodata_id' => $biodata->id,
                            'jenis' => 'pegawai'
                        ]);
                        $pegawai = Pegawai::create([
                            'idpeg' => $data->idpeg,
                            'pegawai_nomor_induk' => $data->nip,
                            'biodata_id' => $biodata->id,
                            'gelar_depan' => $data->gelar_depan,
                            'gelar_belakang' => $data->gelar_belakang,
                            'status_asn_id' => $statusAsnId,
                            'kategori_id' => $kategoriId,
                            'is_dosen' => $isDosen,
                        ]);
                        if ($isDosen)
                            Dosen::create([
                                'pegawai_id' => $pegawai->id,
                                'nomor_dosen' => $data->no_nidn,
                                'dosen_kategori' => $data->no_nidn,
                                'homebase' => $data->no_nidn,
                            ]);
                    }
                    DB::commit();

                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil ditambahkan',
                        'details' => $user,
                    ], 200);
                }
                return response()->json([
                    'status' => false,
                    'message' => 'Data sudah Ada',
                    'details' => [],
                ], 200);
            }
            return response()->json([
                'status' => false,
                'message' => 'Email tidak ada',
                'details' => [],
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return;

            return response()->json([
                'status' => false,
                'message' => $th,
                'details' => [],
            ], 500);
        }
    }
}
