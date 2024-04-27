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
Route::controller(LoginController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::post('/login', 'authenticate')->middleware('guest');
    Route::post('/logout', 'logout')->middleware('auth');
});

//mahasiswa
Route::middleware('auth')->controller(MahasiswaController::class)->group(function () {
    Route::get('/mahasiswa/index', 'index');

    Route::get('/mahasiswa/pengajuan/judul/{user}', 'pengajuanJudul');
    Route::post('/mahasiswa/pengajuan/judul/{user}', 'ajukanJudul');

    Route::get('/mahasiswa/pengajuan/sempro', 'pengajuanSempro');
    Route::post('/mahasiswa/pengajuan/sempro/{user}', 'ajukanSempro');

    Route::get('/mahasiswa/pengajuan/skripsi', 'pengajuanSkripsi');
    Route::post('/mahasiswa/pengajuan/skripsi/{user}', 'ajukanSkripsi');

    Route::get('/mahasiswa/pengajuan/alat', 'pengajuanAlat');

    Route::get('/mahasiswa/logbook', 'getLogbooks');
    Route::get('/mahasiswa/logbook/create', 'createLogbook');
    Route::get('/mahasiswa/logbook/{logbook}', 'getLogbook');
    Route::post('/mahasiswa/logbook', 'storeLogbook');

    Route::get('/mahasiswa/skripsi', 'getSkripsi');
    Route::get('/mahasiswa/skripsi/edit', 'editSkripsi');
    Route::put('/mahasiswa/skripsi/{user}', 'updateSkripsi');

    Route::get('/mahasiswa/informasi', 'getInformations');
    Route::get('/mahasiswa/informasi/{pengajuanJudul}/pengajuanJudul', 'getPengajuanJudul');
    Route::get('/mahasiswa/informasi/{pengajuanSempro}/pengajuanSempro', 'getPengajuanSempro');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/pengajuanSkripsi', 'getPengajuanSkripsi');
    Route::get('/mahasiswa/informasi/1/berita_sempro', 'beritaAcaraSempro');
    Route::get('/mahasiswa/informasi/1/berita_skripsi', 'beritaAcaraSkripsi');

    Route::get('/mahasiswa/revisi', 'getAllRevisi');
    Route::post('/mahasiswa/revisi/{pengajuanRevisi}', 'terimaRevisi');
    Route::get('/mahasiswa/revisi/{pengajuanRevisi}', 'getRevisi');

    Route::get('/mahasiswa/profile', 'getProfile');
    Route::get('/mahasiswa/profile/edit', 'editProfile');
    Route::put('/mahasiswa/profile/{user}', 'updateProfile');
});

//Admin
Route::middleware('auth')->controller(AdminController::class)->group(function () {
    Route::get('/admin/index', 'index');
    Route::post('/admin/index', 'updateKonten');

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
    Route::get('/admin/pengajuan/judul/{pengajuanJudul}', 'getPengajuanJudul');
    Route::post('/admin/pengajuan/judul/{pengajuanJudul}', 'terimaPengajuanJudul');

    Route::get('/admin/pengajuan/sempro', 'pengajuanSempro');
    Route::get('/admin/pengajuan/sempro/{pengajuanSempro}', 'getPengajuanSempro');
    Route::post('/admin/pengajuan/sempro/{pengajuanSempro}', 'terimaPengajuanSempro');

    Route::get('/admin/pengajuan/skripsi', 'pengajuanSkripsi');
    Route::get('/admin/pengajuan/skripsi/{pengajuanSkripsi}', 'getPengajuanSkripsi');
    Route::post('/admin/pengajuan/skripsi/{pengajuanSkripsi}', 'terimaPengajuanSkripsi');

    Route::get('/admin/pengajuan/alat', 'getAllPengajuanAlat');
    Route::get('/admin/pengajuan/alat/1', 'getPengajuanAlat');

    Route::get('/admin/skripsi', 'getSkripsian');

    Route::get('/admin/revisi', 'getAllRevisi');
    Route::get('/admin/revisi/{pengajuanRevisi}', 'getRevisi');
    Route::post('/admin/revisi/{pengajuanRevisi}', 'keputusanRevisi');
});

Route::middleware('auth')->controller(DosenController::class)->group(function () {
    Route::get('/dosen/index', 'index');

    Route::get('/dosen/bimbingan/logbook', 'getLogbooks');
    Route::get('/dosen/bimbingan/logbook/{logbook}', 'getLogbook');
    Route::post('/dosen/bimbingan/logbook/{logbook}', 'acceptLogbook');

    Route::get('/dosen/bimbingan/persetujuanSidang', 'getAllPersetujuanSidang');
    Route::get('/dosen/bimbingan/persetujuanSempro/{pengajuanSempro}', 'getPersetujuanSempro');
    Route::post('/dosen/bimbingan/persetujuanSempro/{pengajuanSempro}', 'acceptPersetujuanSidangSempro');
    Route::get('/dosen/bimbingan/persetujuanSkripsi/{pengajuanSkripsi}', 'getPersetujuanSkripsi');
    Route::post('/dosen/bimbingan/persetujuanSkripsi/{pengajuanSkripsi}', 'acceptPersetujuanSidangSkripsi');

    Route::get('/dosen/bimbingan/listMahasiswa', 'getAllListMahasiswa');
    Route::get('/dosen/bimbingan/listMahasiswa/{bimbingan}', 'getListMahasiswa');

    Route::get('/dosen/pengujian/sempro', 'getAllPengujianSempro');
    Route::get('/dosen/pengujian/sempro/{pengajuanSempro}', 'getPengujianSempro');
    Route::get('/dosen/pengujian/sempro/{pengajuanSempro}/terima', 'penilaianSempro');
    Route::post('/dosen/pengujian/sempro/{pengajuanSempro}', 'nilaiSempro');

    Route::get('/dosen/pengujian/skripsi', 'getAllPengujianSkripsi');
    Route::get('/dosen/pengujian/skripsi/{pengajuanSkripsi}', 'getPengujianSkripsi');
    Route::get('/dosen/pengujian/skripsi/{pengajuanSkripsi}/terima', 'penilaianSkripsi');
    Route::post('/dosen/pengujian/skripsi/{pengajuanSkripsi}', 'nilaiskripsi');


    // Route::get('/dosen/pengujian/terbimbing', 'getAllPengujianTerbimbing');
    // Route::get('/dosen/pengujian/terbimbing/1', 'getPengujianTerbimbing');
    Route::get('/dosen/pengujian/terbimbing/{pengajuanSkripsi}/terima', 'penilaianTerbimbing');

    Route::get('/dosen/rekapitulasi', 'getAllRekapitulasi');
    Route::get('/dosen/rekapitulasi/{pengajuanSkripsi}', 'getRekapitulasi');
    Route::post('/dosen/rekapitulasi/{pengajuanSkripsi}', 'rekapNilai');

    Route::get('/dosen/kelulusan', 'getAllKelulusan');
    Route::get('/dosen/kelulusan/{pengajuanSkripsi}', 'getKelulusan');
    Route::post('/dosen/kelulusan/lulus/{pengajuanSkripsi}', 'luluskanSkripsi');
    Route::post('/dosen/kelulusan/tolak/{pengajuanSkripsi}', 'tolakSkripsi');
    Route::post('/dosen/kelulusan/revisi/{pengajuanSkripsi}', 'revisiSkripsi');

    Route::get('/dosen/revisi', 'getAllRevisi');
    Route::get('/dosen/revisi/{pengajuanRevisi}', 'getRevisi');
    Route::post('/dosen/revisi/{pengajuanRevisi}', 'keputusanRevisi');

    Route::get('/dosen/profile', 'getProfile');
    Route::put('/dosen/profile/{user}', 'updateProfile');
});
