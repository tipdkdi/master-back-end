<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use App\Http\Resources\UserRoleResource;

class JWTAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function login(Request $request)
    // {
    //     // return "ggwp";
    //     $credentials = $request->only('email');

    //     try {
    //         if (! $token = JWTAuth::attempt($credentials)) {
    //             return response()->json(['error' => 'Invalid credentials'], 401);
    //         }

    //         // Get the authenticated user.
    //         $user = auth()->user();

    //         // (optional) Attach the role to the token.
    //         $token = JWTAuth::claims(['role' => $user->role])->fromUser($user);

    //         return response()->json(compact('token'));
    //     } catch (JWTException $e) {
    //         return response()->json(['error' => 'Could not create token'], 500);
    //     }
    // }
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
            $data['biodata'] = $user->biodata;
            $status = true;
            $message = 'Login Berhasil';
            return response()->json(compact('status', 'message', 'data'));
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }
}
