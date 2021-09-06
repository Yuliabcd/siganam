<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [\App\Http\Controllers\AccountController::class, 'profile'])->name('profile');
    Route::put('/profile', [\App\Http\Controllers\AccountController::class, 'updateProfile'])->name('update_profile');
    Route::get('/password', [\App\Http\Controllers\AccountController::class, 'password'])->name('password');
    Route::put('/password', [\App\Http\Controllers\AccountController::class, 'updatePassword'])->name('update_password');
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('pengurus', \App\Http\Controllers\PengurusController::class);
    Route::resource('kegiatan', \App\Http\Controllers\KegiatanController::class);
    Route::resource('laporan', \App\Http\Controllers\LaporanController::class);
    Route::resource('laporan_pengurus', \App\Http\Controllers\LaporanPengurusController::class);
    Route::resource('laporan_simpan_pinjam', \App\Http\Controllers\LaporanSimpanPinjamController::class);
});

Route::fallback(function () {
    abort(404);
});
