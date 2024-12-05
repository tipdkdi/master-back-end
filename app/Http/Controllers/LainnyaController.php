<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserLoginResource;
use App\Models\MasterJabatan;
use App\Models\PegawaiKategori;
use App\Models\PegawaiStatusAsn;
use App\Models\User;
use App\Models\UserRole;
use Tymon\JWTAuth\Facades\JWTAuth;

class LainnyaController extends Controller
{
    public function getUserInfo()
    {
        $payload = JWTAuth::getPayload();

        // Ambil 'sub' (user ID) dari payload
        $userId = $payload->get('sub');
        $user = User::with('userBiodata.biodata')->find($userId);
        // return $user;
        if ($user && $user->userBiodata) {
            $jenis = $user->userBiodata->jenis;
            if ($jenis == 'pegawai') {
                $user->load(['userBiodata.biodata.pegawai.statusAsn', 'userBiodata.biodata.pegawai.kategori']); // Memuat relasi pegawai jika jenis pegawai

                // Memeriksa apakah pegawai ada dan memiliki properti is_dosen
                if ($user->userBiodata->biodata && $user->userBiodata->biodata->pegawai && $user->userBiodata->biodata->pegawai->is_dosen) {
                    $user->load(['userBiodata.biodata.pegawai.dosen']); // Memuat relasi dosen jika pegawai adalah dosen
                }
            } elseif ($jenis == 'mahasiswa') {
                $user->load('userBiodata.biodata.mahasiswa'); // Memuat relasi mahasiswa jika jenis mahasiswa
            }
        }
        $data = new UserLoginResource($user);
        return response()->json([
            'status' => true,
            'data' => $data,
            'pesan' => "data ditemukan",
        ]);
        // return ;
    }
    public function is_roled()
    {
        try {
            $payload = JWTAuth::getPayload();

            // Ambil 'sub' (user ID) dari payload
            $userId = $payload->get('sub');

            $user = UserRole::where('user_id', $userId)->first();
            // return $user;
            if (!$user) {
                $status = false;
                $pesan = "Akun tidak memiliki role di aplikasi ini";
                return response()->json(compact('status', 'pesan'));
            }
            $status = true;
            $pesan = "Anda memiliki role di aplikasi ini. silahkan lanjut";
            $link = route('https://super-app.iainkendari.ac.id/dashboard');
            return response()->json(compact('status', 'pesan'));
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function statusAsn()
    {
        try {
            $data = PegawaiStatusAsn::all();

            return response()->json([
                'status' => true,
                'data' => $data,
                'pesan' => "data ditemukan",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function kategoriPegawai()
    {
        try {
            $data = PegawaiKategori::all();

            return response()->json([
                'status' => true,
                'data' => $data,
                'pesan' => "data ditemukan",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function masterJabatan()
    {
        try {
            $data = MasterJabatan::all();

            return response()->json([
                'status' => true,
                'data' => $data,
                'pesan' => "data ditemukan",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'pesan' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
