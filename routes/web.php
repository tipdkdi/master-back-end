<?php

use App\Http\Controllers\JWTAuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login/google', function () {
    return Socialite::driver('google')->redirect();
})->middleware('web');  // Pastikan middleware 'web' digunakan
Route::get('/callback/google', [JWTAuthController::class, 'callbackGoogle'])->middleware('web');
