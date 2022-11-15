<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TkrkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AdminKrkController;
use App\Http\Controllers\TpermohonanController;
use App\Http\Controllers\LupaPasswordController;
use App\Http\Controllers\DaftarLayananController;
use App\Http\Controllers\AdminPermohonanController;


Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->hasRole('superadmin')) {
            return redirect('superadmin');
        } elseif (Auth::user()->hasRole('pemohon')) {
            return redirect('pemohon');
        }
    }
    return redirect('/login');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('daftar', [DaftarController::class, 'index']);
Route::post('daftar', [DaftarController::class, 'daftar']);
Route::get('lupa-password', [LupaPasswordController::class, 'index']);
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);
Route::get('/logout', [LogoutController::class, 'logout']);


Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::get('superadmin', [HomeController::class, 'superadmin']);
    Route::get('superadmin/permohonan', [AdminPermohonanController::class, 'index']);
    Route::get('superadmin/krk', [AdminKrkController::class, 'index']);
    Route::get('superadmin/krk/{id}/verifikasi', [AdminKrkController::class, 'verifikasi']);
    Route::get('superadmin/krk/{id}/edit', [AdminKrkController::class, 'edit']);
    Route::get('superadmin/krk/{id}/print', [AdminKrkController::class, 'pdf']);
    Route::post('superadmin/krk/{id}/edit', [AdminKrkController::class, 'update']);
    Route::get('superadmin/krk/{id}/delete', [AdminKrkController::class, 'delete']);
    Route::post('superadmin/krk/{id}/verifikasi', [AdminKrkController::class, 'verified']);
    Route::get('superadmin/krk/{id}/unverifikasi', [AdminKrkController::class, 'unverifikasi']);
});

Route::group(['middleware' => ['auth', 'role:pemohon']], function () {
    Route::get('pemohon', [HomeController::class, 'pemohon']);
    Route::get('pemohon/daftar-layanan', [DaftarLayananController::class, 'index']);

    Route::get('pemohon/{id}/berkas', [TpermohonanController::class, 'berkas']);

    Route::get('pemohon/{id}/berkas/krk_kkpr/create', [TkrkController::class, 'create']);
    Route::post('pemohon/{id}/berkas/krk_kkpr/create', [TkrkController::class, 'store']);
    Route::get('pemohon/{id}/berkas/krk_kkpr/edit/{krk_id}', [TkrkController::class, 'edit']);
    Route::post('pemohon/{id}/berkas/krk_kkpr/edit/{krk_id}', [TkrkController::class, 'update']);
    Route::get('pemohon/{id}/berkas/krk_kkpr/pdf/{krk_id}', [TkrkController::class, 'pdf']);

    Route::post('pemohon/permohonan/add', [TpermohonanController::class, 'store']);
    Route::post('pemohon/permohonan/update', [TpermohonanController::class, 'update']);
});
