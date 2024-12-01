<?php

namespace App\Http\Controllers;

use App\Models\MasterJabatan;
use App\Models\PegawaiKategori;
use App\Models\PegawaiStatusAsn;

use Illuminate\Http\Request;
use Jose\Component\Encryption\JWEDecrypter;
use Jose\Component\Encryption\Serializer\CompactSerializer;
use Jose\Component\Core\JWK;
use Jose\Component\KeyManagement\JWKFactory;

class LainnyaController extends Controller
{
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
