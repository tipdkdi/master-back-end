<?php

namespace App\Http\Controllers;

use App\Models\PegawaiKategori;
use App\Models\PegawaiStatusAsn;

use Illuminate\Http\Request;
use Jose\Component\Encryption\JWEDecrypter;
use Jose\Component\Encryption\Serializer\CompactSerializer;
use Jose\Component\Core\JWK;
use Jose\Component\KeyManagement\JWKFactory;

class LainnyaController extends Controller
{
    //

    public function decrypt(Request $request)
    {
        // Ambil JOSE token yang diterima dari request
        $jwtString = $request->input('eyJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImthZnVkZWZ1cmFAZ21haWwuY29tIiwiaWF0IjoxNzMxNDY0MDY3LCJleHAiOjE3MzE0NzEyNjd9.ZfEBWGOm-bjceq9yneqC8YGS-cTwqW4G4Udgqre0M_8');

        // Mendekripsi token
        try {
            // Misalnya kunci privat disimpan dalam .env atau di tempat aman
            $privateKey = env('JWT_SECRET');

            // Membuat JWK dari kunci privat
            $jwk = JWKFactory::createFromPrivateKey($privateKey);

            // Gunakan Compact Serializer untuk memproses token
            $serializer = new CompactSerializer();
            $jwe = $serializer->unserialize($jwtString);  // Token JWE

            // Inisialisasi dekripter
            $decrypter = new JWEDecrypter();
            $decrypter->decryptUsingKey($jwe, $jwk, 0);

            // Dapatkan payload setelah dekripsi
            $payload = json_decode($jwe->getPayload(), true);

            // Kembalikan payload yang sudah didekripsi
            return response()->json($payload);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Decryption failed: ' . $e->getMessage()], 400);
        }
    }

    // public function decrypt()
    // {
    //     $jwt_string = 'eyJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImthZnVkZWZ1cmFAZ21haWwuY29tIiwiaWF0IjoxNzMxNDY0MDY3LCJleHAiOjE3MzE0NzEyNjd9.ZfEBWGOm-bjceq9yneqC8YGS-cTwqW4G4Udgqre0M_8';
    //     $jwe = JOSE_JWT::decode($jwt_string);
    //     $jwe->decrypt(env('JWT_SECRET'));
    //     return $jwe;
    // }
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
}
