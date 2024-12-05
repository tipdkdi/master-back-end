<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserLoginResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use App\Http\Resources\UserRoleResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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
        // $user = User::updateOrCreate(
        //     ['email' => $googleUser->email],
        //     [
        //         'name' => $googleUser->name,
        //         'google_id' => $googleUser->id,
        //         'password' => bcrypt('1234qwer'),
        //         'foto' => $googleUser->avatar,
        //     ]
        // );
        $user = User::where('email', $googleUser->email)
            ->first();
        if (!$user)
            return "Email Tidak terdaftar. Hubungi Admin Kampus";
        $token = JWTAuth::fromUser($user);
        // return $token;
        return redirect('https://super-app.iainkendari.ac.id/token/' . $token);
    }

    public function validateToken() //fungsi untuk validasi token
    {
        try {
            // Verifikasi token
            $user = Auth::guard('api')->user();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token tidak valid',
                    'data' => $user,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Token valid',
                'data' => $user,
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

    public function getRole(Request $request)
    {
        // Ambil payload dari token
        $payload = JWTAuth::getPayload();

        // Ambil 'sub' (user ID) dari payload
        $userId = $payload->get('sub');

        $user = User::with('userRoles.role')->find($userId);
        // return $user;
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $status = true;
        $pesan = "Data Role Berhasil diambil";
        $grup = UserRoleResource::collection($user->userRoles);
        return response()->json(compact('status', 'pesan', 'grup'));

        // return response()->json('role'=>[
        //     'user_id' => $user->id,
        //     'roles' => UserRoleResource::collection($user->userRoles),
        // ]);
    }

    public function logout(Request $request)
    {
        $token = auth()->guard('api')->getToken();
        auth()->guard('api')->logout();

        JWTAuth::invalidate($token);

        // Kirim permintaan ke backend domain lain
        $apps = ['spmb'];
        foreach ($apps as $app)
            Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,  // Mengirim Bearer token di header
            ])->post('https:api.iainkendari.ac.id/' . $app . '/logout');

        return response()->json(['message' => 'Logged out successfully']);
    }
}
