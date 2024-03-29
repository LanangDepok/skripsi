<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
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
    Route::get('/mahasiswa/pengajuan/alat', 'pengajuanAlat');

    Route::get('/mahasiswa/logbook', 'getLogbooks');
    Route::get('/mahasiswa/logbook/create', 'createLogbook');

    Route::get('/mahasiswa/skripsi', 'getSkripsi');
    Route::get('/mahasiswa/skripsi/1/edit', 'editSkripsi');

    Route::get('/mahasiswa/informasi', 'getInformations');
    Route::get('/mahasiswa/informasi/1/berita_sempro', 'getBeritaSempro');
    Route::get('/mahasiswa/informasi/1/berita_skripsi', 'getBeritaSkripsi');

    Route::get('/mahasiswa/revisi', 'getAllRevisi');
    Route::get('/mahasiswa/revisi/1', 'getRevisi');

    Route::get('/mahasiswa/profile', 'getProfile');
    Route::get('/mahasiswa/profile/1/edit', 'editProfile');
});

//Admin
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/index', 'index');

    Route::get('/admin/mahasiswa', 'getStudents');
    Route::get('/admin/mahasiswa/create', 'createStudent');
    Route::post('/admin/mahasiswa', 'storeStudent');
    Route::get('/admin/mahasiswa/{mahasiswa}', 'getStudent');
    Route::get('/admin/mahasiswa/{mahasiswa}/edit', 'editStudent');
    Route::put('/admin/mahasiswa/{mahasiswa}', 'updateStudent');
    Route::delete('/admin/mahasiswa/{mahasiswa}', 'deleteStudent');

    Route::get('/admin/dosen', 'getLecturers');
    Route::get('/admin/dosen/create', 'createLecturer');
    Route::post('/admin/dosen', 'storeLecturer');
    Route::get('/admin/dosen/{dosen}', 'getLecturer');
    Route::get('/admin/dosen/{dosen}/edit', 'editLecturer');
    Route::put('/admin/dosen/{dosen}', 'updateLecturer');
    Route::delete('/admin/dosen/{dosen}', 'deleteLecturer');

    Route::get('/admin/pengajuan/judul', 'pengajuanJudul');
    Route::get('/admin/pengajuan/judul/1', 'getPengajuanJudul');
    Route::post('/admin/pengajuan/judul/store', 'storePengajuanJudul');
    Route::get('/admin/pengajuan/sempro', 'pengajuanSempro');
    Route::get('/admin/pengajuan/sempro/1', 'getPengajuanSempro');
    Route::get('/admin/pengajuan/skripsi', 'pengajuanSkripsi');
    Route::get('/admin/pengajuan/skripsi/1', 'getPengajuanSkripsi');
    Route::get('/admin/pengajuan/alat', 'getAllPengajuanAlat');
    Route::get('/admin/pengajuan/alat/1', 'getPengajuanAlat');

    Route::get('/admin/skripsi', 'getSkripsian');

    Route::get('/admin/revisi', 'getAllRevisi');
    Route::get('/admin/revisi/1', 'getRevisi');
});

Route::controller(DosenController::class)->group(function () {
    Route::get('/dosen/index', 'index');

    Route::get('/dosen/bimbingan/logbook', 'getLogbooks');
    Route::get('/dosen/bimbingan/logbook/1', 'getLogbook');

    Route::get('/dosen/bimbingan/persetujuanSidang', 'getAllPersetujuanSidang');
    Route::get('/dosen/bimbingan/persetujuanSidang/1', 'getPersetujuanSidang');

    Route::get('/dosen/bimbingan/listMahasiswa', 'getAllListMahasiswa');
    Route::get('/dosen/bimbingan/listMahasiswa/1', 'getListMahasiswa');

    Route::get('/dosen/pengujian/sempro', 'getAllPengujianSempro');
    Route::get('/dosen/pengujian/sempro/1', 'getPengujianSempro');
    Route::get('/dosen/pengujian/sempro/1/terima', 'penilaianSempro');

    Route::get('/dosen/pengujian/skripsi', 'getAllPengujianSkripsi');
    Route::get('/dosen/pengujian/skripsi/1', 'getPengujianSkripsi');
    Route::get('/dosen/pengujian/skripsi/1/terima', 'penilaianSkripsi');

    Route::get('/dosen/pengujian/terbimbing', 'getAllPengujianTerbimbing');
    Route::get('/dosen/pengujian/terbimbing/1', 'getPengujianTerbimbing');
    Route::get('/dosen/pengujian/terbimbing/1/terima', 'penilaianTerbimbing');

    Route::get('dosen/rekapitulasi', 'getAllRekapitulasi');
    Route::get('dosen/rekapitulasi/1', 'getRekapitulasi');

    Route::get('/dosen/kelulusan', 'getAllKelulusan');

    Route::get('/dosen/revisi', 'getAllRevisi');
    Route::get('dosen/revisi/1', 'getRevisi');

    Route::get('/dosen/profile', 'getProfile');
    Route::get('/dosen/profile/1/edit', 'editProfile');
});
