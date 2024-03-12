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
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

//mahasiswa
Route::controller(MahasiswaController::class)->group(function () {
    Route::get('/mahasiswa/index', 'index');

    Route::get('/mahasiswa/pengajuan/judul', 'pengajuanJudul');
    Route::get('/mahasiswa/pengajuan/sempro', 'pengajuanSempro');
    Route::get('/mahasiswa/pengajuan/skripsi', 'pengajuanSkripsi');

    Route::get('/mahasiswa/logbook', 'getLogbooks');
    Route::get('/mahasiswa/logbook/create', 'createLogbook');

    Route::get('/mahasiswa/skripsi', 'getSkripsi');
    Route::get('/mahasiswa/skripsi/1/edit', 'editSkripsi');

    Route::get('/mahasiswa/informasi', 'getInformations');

    Route::get('/mahasiswa/profile', 'getProfile');
    Route::get('/mahasiswa/profile/1/edit', 'editProfile');
});

//Admin
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/index', 'index');

    Route::get('/admin/mahasiswa', 'getStudents');
    Route::get('/admin/mahasiswa/1', 'getStudent');
    Route::get('/admin/mahasiswa/create', 'createStudent');
    Route::get('/admin/mahasiswa/1/edit', 'editStudent');

    Route::get('/admin/dosen', 'getLecturers');
    Route::get('/admin/dosen/1', 'getLecturer');
    Route::get('/admin/dosen/create', 'createLecturer');
    Route::get('/admin/dosen/1/edit', 'editLecturer');

    // Route::get('/admin/komite', 'getCommittees');
    // Route::get('/admin/komite/1', 'getCommittee');
    // Route::get('/admin/komite/create', 'createCommittee');
    // Route::get('/admin/komite/1/edit', 'editCommittee');

    Route::get('/admin/pengajuan/judul', 'pengajuanJudul');
    Route::get('/admin/pengajuan/judul/1', 'getPengajuanJudul');
    Route::get('/admin/pengajuan/sempro', 'pengajuanSempro');
    Route::get('/admin/pengajuan/sempro/1', 'getPengajuanSempro');
    Route::get('/admin/pengajuan/skripsi', 'pengajuanSkripsi');
    Route::get('/admin/pengajuan/skripsi/1', 'getPengajuanSkripsi');
});
