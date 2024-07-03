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
    Route::post('/mahasiswa/pengajuan/alat/{user}', 'ajukanAlat');
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
    Route::get('/mahasiswa/informasi/{pengajuanAlat}/pengajuanAlat', 'getPengajuanAlat');
    Route::get('/mahasiswa/informasi/{pengajuanSempro}/f1', 'f1');
    Route::get('/mahasiswa/informasi/{pengajuanSempro}/f2', 'f2');
    Route::get('/mahasiswa/informasi/{pengajuanSempro}/f3', 'f3');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f4', 'f4');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f5', 'f5');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f6a', 'f6a');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f6b', 'f6b');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f7a', 'f7a');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f7b', 'f7b');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f7c', 'f7c');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f8', 'f8');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f9', 'f9');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f10', 'f10');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f11', 'f11');
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
    Route::post('/admin/mahasiswa/excel', 'storeStudentExcel');
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
    Route::get('/admin/pengajuan/alat', 'PengajuanAlat');
    Route::get('/admin/pengajuan/alat/{pengajuanAlat}', 'getPengajuanAlat');
    Route::post('/admin/pengajuan/alat/{pengajuanAlat}', 'terimaPengajuanAlat');
    Route::get('/admin/pelaksanaan/sempro', 'getAllSempro');
    Route::get('/admin/pelaksanaan/sempro/{pengajuanSempro}', 'getSempro');
    Route::get('/admin/pelaksanaan/skripsi', 'getAllSkripsi');
    Route::get('/admin/pelaksanaan/skripsi/{pengajuanSkripsi}', 'getSkripsi');
    Route::get('/admin/pelaksanaan/alat', 'getAllalat');
    Route::get('/admin/pelaksanaan/alat/{pengajuanAlat}', 'getAlat');
    Route::get('/admin/revisi', 'getAllRevisi');
    Route::get('/admin/revisi/{pengajuanRevisi}', 'getRevisi');
    Route::post('/admin/revisi/{pengajuanRevisi}', 'keputusanRevisi');
    Route::get('/admin/profile', 'getProfile');
    Route::put('/admin/profile/{user}', 'updateProfile');
    Route::get('/admin/database/tahun', 'getAllTahunAjaran');
    Route::get('/admin/database/tahun/create', 'createTahunAjaran');
    Route::post('/admin/database/tahun', 'storeTahunAjaran');
    Route::get('/admin/database/tahun/{tahunAjaran}/edit', 'editTahunAjaran');
    Route::put('/admin/database/tahun/{tahunAjaran}', 'updateTahunAjaran');
    Route::get('/admin/database/kelas', 'getAllKelas');
    Route::get('/admin/database/kelas/create', 'createKelas');
    Route::post('/admin/database/kelas', 'storeKelas');
    Route::get('/admin/database/kelas/{kelas}/edit', 'editKelas');
    Route::put('/admin/database/kelas/{kelas}', 'updateKelas');
    Route::get('/admin/database/prodi', 'getAllProgramStudi');
    Route::get('/admin/database/prodi/create', 'createProgramStudi');
    Route::post('/admin/database/prodi', 'storeProgramStudi');
    Route::get('/admin/database/prodi/{programStudi}/edit', 'editProgramStudi');
    Route::put('/admin/database/prodi/{programStudi}', 'updateProgramStudi');
    Route::get('/admin/database/jabatan', 'getAllJabatan');
    Route::get('/admin/database/jabatan/create', 'createJabatan');
    Route::post('/admin/database/jabatan', 'storeJabatan');
    Route::get('/admin/database/jabatan/{jabatan}/edit', 'editJabatan');
    Route::put('/admin/database/jabatan/{jabatan}', 'updateJabatan');
    Route::get('/admin/database/fungsional', 'getAllJabatanFungsional');
    Route::get('/admin/database/fungsional/create', 'createJabatanFungsional');
    Route::post('/admin/database/fungsional', 'storeJabatanFungsional');
    Route::get('/admin/database/fungsional/{jabatanFungsional}/edit', 'editJabatanFungsional');
    Route::put('/admin/database/fungsional/{jabatanFungsional}', 'updateJabatanFungsional');
    Route::get('/admin/database/golongan', 'getAllPangkatGolongan');
    Route::get('/admin/database/golongan/create', 'createPangkatGolongan');
    Route::post('/admin/database/golongan', 'storePangkatGolongan');
    Route::get('/admin/database/golongan/{pangkatGolongan}/edit', 'editPangkatGolongan');
    Route::put('/admin/database/golongan/{pangkatGolongan}', 'updatePangkatGolongan');
    Route::get('/admin/report', 'reportAkhir');
    Route::post('/admin/report/excel', 'exportReport');
});

Route::middleware('auth')->controller(DosenController::class)->group(function () {
    Route::get('/dosen/index', 'index');
    Route::get('/dosen/bimbingan/logbook', 'getLogbooks');
    Route::post('/dosen/bimbingan/logbook', 'acceptAllLogbook');
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
    Route::get('/dosen/pengujian/terbimbing/{pengajuanSkripsi}/terima', 'penilaianTerbimbing');
    Route::post('/dosen/pengujian/skripsi/{pengajuanSkripsi}', 'nilaiskripsi');
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
    Route::get('/dosen/history/sempro', 'historySempro');
    Route::get('/dosen/history/sempro/{pengajuanSempro}', 'historySemproDetail');
    Route::get('/dosen/history/skripsi', 'historySkripsi');
    Route::get('/dosen/history/skripsi/{pengajuanSkripsi}', 'historySkripsiDetail');
    Route::get('/dosen/history/logbook', 'historyLogbook');
    Route::get('/dosen/history/logbook/{logbook}', 'historyLogbookDetail');
});
