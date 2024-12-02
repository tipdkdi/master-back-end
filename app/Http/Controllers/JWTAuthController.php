<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use App\Http\Resources\UserRoleResource;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class JWTAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function callbackGoogle() //google mengarahkan ke sini ketika login google berhasil
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        // Simpan atau update user
        $user = User::updateOrCreate(
            ['email' => $googleUser->email],
            [
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                'password' => bcrypt('1234qwer'),
                'foto' => $googleUser->avatar,
            ]
        );
        // Generate JWT token
        $token = JWTAuth::fromUser($user);
        return $token;
        return redirect('https://portal.iainkendari.ac.id/token/' . $token);
    }

    public function validateToken() //fungsi untuk validasi token
    {
        try {
            // Verifikasi token
            $user = Auth::guard('api')->user();

            if (!$user) {
                return response()->json(['error' => 'Token tidak valid'], 401);
            }

            return response()->json([
                'message' => 'Token valid',
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token tidak valid atau expired'], 401);
        }
    }
    public function login(Request $request)
    {
        // Ambil hanya `email` dari request

        $credentials = $request->only('email');

        try {
            // Cari user berdasarkan email tanpa mengecek password
            $user = \App\Models\User::where('email', $credentials['email'])->first();

            if (!$user) {
                $status = false;
                $message = 'Login gagal, email tidak terdaftar';
                $data = [];
                return response()->json(compact('status', 'message', 'data'), 401);

                // return response()->json(['error' => 'Invalid credentials'], 401);
            }

            // Buat token dengan klaim khusus (contohnya `role` jika ada)
            $data['token'] = JWTAuth::claims(['grup' => "admin_utama"])->fromUser($user);
            $roles = $user->userRoles()->with('role')->get();

            $data['grup'] = UserRoleResource::collection($roles);
            $data['biodata'] = $user->userBiodata->biodata;
            $status = true;
            $message = 'Login Berhasil';
            return response()->json(compact('status', 'message', 'data'));
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }
}
