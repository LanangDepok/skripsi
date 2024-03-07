<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/1', function () {
    return view('mahasiswa.index2');
});

//login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

//mahasiswa
Route::controller(MahasiswaController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/pengajuan/judul', 'pengajuanJudul');
    Route::get('/pengajuan/sempro', 'pengajuanSempro');
    Route::get('/pengajuan/skripsi', 'pengajuanSkripsi');
    Route::get('/logbook', 'logbook');
    Route::get('/skripsi', 'skripsi');
    Route::get('/informasi', 'informasi');
    Route::get('/profile', 'profile');
});
