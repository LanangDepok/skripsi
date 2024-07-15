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
    Route::post('/login', 'authenticate')->middleware('guest')->name('masuk');
    Route::post('/logout', 'logout')->middleware('auth')->name('keluar');
});

//mahasiswa
Route::middleware('auth')->controller(MahasiswaController::class)->group(function () {
    Route::get('/mahasiswa/index', 'index')->name('mhs.index');
    Route::get('/mahasiswa/pengajuan/judul/{user}', 'pengajuanJudul')->name('mhs.pengajuanJudul');
    Route::post('/mahasiswa/pengajuan/judul/{user}', 'ajukanJudul')->name('mhs.ajukanJudul');
    Route::get('/mahasiswa/pengajuan/sempro', 'pengajuanSempro')->name('mhs.pengajuanSempro');
    Route::post('/mahasiswa/pengajuan/sempro/{user}', 'ajukanSempro')->name('mhs.ajukanSempro');
    Route::get('/mahasiswa/pengajuan/skripsi', 'pengajuanSkripsi')->name('mhs.pengajuanSkripsi');
    Route::post('/mahasiswa/pengajuan/skripsi/{user}', 'ajukanSkripsi')->name('mhs.ajukanSkripsi');
    Route::get('/mahasiswa/pengajuan/alat', 'pengajuanAlat')->name('mhs.pengajuanAlat');
    Route::post('/mahasiswa/pengajuan/alat/{user}', 'ajukanAlat')->name('mhs.ajukanAlat');
    Route::get('/mahasiswa/pengajuan/kompetensi', 'pengajuanKompetensi')->name('mhs.pengajuanKompetensi');
    Route::post('/mahasiswa/pengajuan/kompetensi/{user}', 'ajukanKompetensi')->name('mhs.ajukanKompetensi');
    Route::get('/mahasiswa/logbook', 'getLogbooks')->name('mhs.getLogbooks');
    Route::get('/mahasiswa/logbook/create', 'createLogbook')->name('mhs.createLogbook');
    Route::get('/mahasiswa/logbook/{logbook}', 'getLogbook')->name('mhsw.getLogbook');
    Route::post('/mahasiswa/logbook', 'storeLogbook')->name('mhs.storeLogbook');
    Route::get('/mahasiswa/skripsi', 'getSkripsi')->name('mhs.getSkripsi');
    Route::get('/mahasiswa/skripsi/edit', 'editSkripsi')->name('mhs.editSkripsi');
    Route::put('/mahasiswa/skripsi/{user}', 'updateSkripsi')->name('mhs.updateSkripsi');
    Route::get('/mahasiswa/informasi', 'getInformations')->name('mhs.getInformations');
    Route::get('/mahasiswa/informasi/{pengajuanJudul}/pengajuanJudul', 'getPengajuanJudul')->name('mhs.getPengajuanJudul');
    Route::get('/mahasiswa/informasi/{pengajuanSempro}/pengajuanSempro', 'getPengajuanSempro')->name('mhs.getPengajuanSempro');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/pengajuanSkripsi', 'getPengajuanSkripsi')->name('mhs.getPengajuanSkripsi');
    Route::get('/mahasiswa/informasi/{pengajuanAlat}/pengajuanAlat', 'getPengajuanAlat')->name('mhs.getPengajuanAlat');
    Route::get('/mahasiswa/informasi/{pengajuanKompetensi}/pengajuanKompetensi', 'getPengajuanKompetensi')->name('mhs.getPengajuanKompetensi');
    Route::get('/mahasiswa/informasi/{pengajuanSempro}/f1', 'f1')->name('mhs.f1');
    Route::get('/mahasiswa/informasi/{pengajuanSempro}/f2', 'f2')->name('mhs.f2');
    Route::get('/mahasiswa/informasi/{pengajuanSempro}/f3', 'f3')->name('mhs.f3');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f4', 'f4')->name('mhs.f4');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f5', 'f5')->name('mhs.f5');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f6a', 'f6a')->name('mhs.f6a');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f6b', 'f6b')->name('mhs.f6b');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f7a', 'f7a')->name('mhs.f7a');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f7b', 'f7b')->name('mhs.f7b');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f7c', 'f7c')->name('mhs.f7c');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f8', 'f8')->name('mhs.f8');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f9', 'f9')->name('mhs.f9');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f10', 'f10')->name('mhs.f10');
    Route::get('/mahasiswa/informasi/{pengajuanSkripsi}/f11', 'f11')->name('mhs.f11');
    Route::get('/mahasiswa/revisi', 'getAllRevisi')->name('mhs.getAllRevisi');
    Route::post('/mahasiswa/revisi/{pengajuanRevisi}', 'terimaRevisi')->name('mhs.terimaRevisi');
    Route::get('/mahasiswa/revisi/{pengajuanRevisi}', 'getRevisi')->name('mhs.getRevisi');
    Route::get('/mahasiswa/profile', 'getProfile')->name('mhs.getProfile');
    Route::get('/mahasiswa/profile/edit', 'editProfile')->name('mhs.editProfile');
    Route::put('/mahasiswa/profile/{user}', 'updateProfile')->name('mhs.updateProfile');
});

//Admin
Route::middleware('auth')->controller(AdminController::class)->group(function () {
    Route::get('/admin/index', 'index')->name('adm.index');
    Route::post('/admin/index', 'updateKonten')->name('adm.updateKonten');
    Route::get('/admin/mahasiswa', 'getStudents')->name('adm.getStudents');
    Route::get('/admin/mahasiswa/create', 'createStudent')->name('adm.createStudent');
    Route::post('/admin/mahasiswa', 'storeStudent')->name('adm.storeStudent');
    Route::post('/admin/mahasiswa/excel', 'storeStudentExcel')->name('adm.storeStudentExcel');
    Route::get('/admin/mahasiswa/{mahasiswa}', 'getStudent')->name('adm.getStudent');
    Route::get('/admin/mahasiswa/{mahasiswa}/edit', 'editStudent')->name('adm.editStudent');
    Route::put('/admin/mahasiswa/{mahasiswa}', 'updateStudent')->name('adm.updateStudent');
    Route::delete('/admin/mahasiswa/{mahasiswa}', 'deleteStudent')->name('adm.deleteStudent');
    Route::get('/admin/dosen', 'getLecturers')->name('adm.getLecturers');
    Route::get('/admin/dosen/create', 'createLecturer')->name('adm.createLecturer');
    Route::post('/admin/dosen', 'storeLecturer')->name('adm.storeLecturer');
    Route::get('/admin/dosen/{dosen}', 'getLecturer')->name('adm.getLecturer');
    Route::get('/admin/dosen/{dosen}/edit', 'editLecturer')->name('adm.editLecturer');
    Route::put('/admin/dosen/{dosen}', 'updateLecturer')->name('adm.updateLecturer');
    Route::delete('/admin/dosen/{dosen}', 'deleteLecturer')->name('adm.deleteLecturer');
    Route::get('/admin/pengajuan/judul', 'pengajuanJudul')->name('adm.pengajuanJudul');
    Route::get('/admin/pengajuan/judul/{pengajuanJudul}', 'getPengajuanJudul')->name('adm.getPengajuanJudul');
    Route::post('/admin/pengajuan/judul/{pengajuanJudul}', 'terimaPengajuanJudul')->name('adm.terimaPengajuanJudul');
    Route::get('/admin/pengajuan/sempro', 'pengajuanSempro')->name('adm.pengajuanSempro');
    Route::get('/admin/pengajuan/sempro/{pengajuanSempro}', 'getPengajuanSempro')->name('adm.getPengajuanSempro');
    Route::post('/admin/pengajuan/sempro/{pengajuanSempro}', 'terimaPengajuanSempro')->name('adm.terimaPengajuanSempro');
    Route::get('/admin/pengajuan/skripsi', 'pengajuanSkripsi')->name('adm.pengajuanSkripsi');
    Route::get('/admin/pengajuan/skripsi/{pengajuanSkripsi}', 'getPengajuanSkripsi')->name('adm.getPengajuanSkripsi');
    Route::post('/admin/pengajuan/skripsi/{pengajuanSkripsi}', 'terimaPengajuanSkripsi')->name('adm.terimaPengajuanSkripsi');
    Route::get('/admin/pengajuan/alat', 'PengajuanAlat')->name('adm.pengajuanAlat');
    Route::get('/admin/pengajuan/alat/{pengajuanAlat}', 'getPengajuanAlat')->name('adm.getPengajuanAlat');
    Route::post('/admin/pengajuan/alat/{pengajuanAlat}', 'terimaPengajuanAlat')->name('adm.terimaPengajuanAlat');
    Route::get('/admin/pengajuan/kompetensi', 'PengajuanKompetensi')->name('adm.pengajuanKompetensi');
    Route::get('/admin/pengajuan/kompetensi/{pengajuanKompetensi}', 'getPengajuanKompetensi')->name('adm.getPengajuanKompetensi');
    Route::post('/admin/pengajuan/kompetensi/{pengajuanKompetensi}', 'terimaPengajuanKompetensi')->name('adm.terimaPengajuanKompetensi');
    Route::get('/admin/pelaksanaan/sempro', 'getAllSempro')->name('adm.getAllSempro');
    Route::get('/admin/pelaksanaan/sempro/{pengajuanSempro}', 'getSempro')->name('adm.getSempro');
    Route::get('/admin/pelaksanaan/skripsi', 'getAllSkripsi')->name('adm.getAllSkripsi');
    Route::get('/admin/pelaksanaan/skripsi/{pengajuanSkripsi}', 'getSkripsi')->name('adm.getSkripsi');
    Route::get('/admin/pelaksanaan/alat', 'getAllAlat')->name('adm.getAllAlat');
    Route::get('/admin/pelaksanaan/alat/{pengajuanAlat}', 'getAlat')->name('adm.getAlat');
    Route::get('/admin/pelaksanaan/kompetensi', 'getAllKompetensi')->name('adm.getAllKompetensi');
    Route::get('/admin/pelaksanaan/kompetensi/{pengajuanKompetensi}', 'getKompetensi')->name('adm.getKompetensi');
    Route::get('/admin/revisi', 'getAllRevisi')->name('adm.getAllRevisi');
    Route::get('/admin/revisi/{pengajuanRevisi}', 'getRevisi')->name('adm.getRevisi');
    Route::post('/admin/revisi/{pengajuanRevisi}', 'keputusanRevisi')->name('adm.keputusanRevisi');
    Route::get('/admin/profile', 'getProfile')->name('adm.getProfile');
    Route::put('/admin/profile/{user}', 'updateProfile')->name('adm.updateProfile');
    Route::get('/admin/database/tahun', 'getAllTahunAjaran')->name('adm.getAllTahunAjaran');
    Route::get('/admin/database/tahun/create', 'createTahunAjaran')->name('adm.createTahunAjaran');
    Route::post('/admin/database/tahun', 'storeTahunAjaran')->name('adm.storeTahunAjaran');
    Route::get('/admin/database/tahun/{tahunAjaran}/edit', 'editTahunAjaran')->name('adm.editTahunAjaran');
    Route::put('/admin/database/tahun/{tahunAjaran}', 'updateTahunAjaran')->name('adm.updateTahunAjaran');
    Route::get('/admin/database/kelas', 'getAllKelas')->name('adm.getAllKelas');
    Route::get('/admin/database/kelas/create', 'createKelas')->name('adm.createKelas');
    Route::post('/admin/database/kelas', 'storeKelas')->name('adm.storeKelas');
    Route::get('/admin/database/kelas/{kelas}/edit', 'editKelas')->name('adm.editKelas');
    Route::put('/admin/database/kelas/{kelas}', 'updateKelas')->name('adm.updateKelas');
    Route::get('/admin/database/prodi', 'getAllProgramStudi')->name('adm.getAllProgramStudi');
    Route::get('/admin/database/prodi/create', 'createProgramStudi')->name('adm.createProgramStudi');
    Route::post('/admin/database/prodi', 'storeProgramStudi')->name('adm.storeProgramStudi');
    Route::get('/admin/database/prodi/{programStudi}/edit', 'editProgramStudi')->name('adm.editProgramStudi');
    Route::put('/admin/database/prodi/{programStudi}', 'updateProgramStudi')->name('adm.updateProgramStudi');
    Route::get('/admin/database/jabatan', 'getAllJabatan')->name('adm.getAllJabatan');
    Route::get('/admin/database/jabatan/create', 'createJabatan')->name('adm.createJabatan');
    Route::post('/admin/database/jabatan', 'storeJabatan')->name('adm.storeJabatan');
    Route::get('/admin/database/jabatan/{jabatan}/edit', 'editJabatan')->name('adm.editJabatan');
    Route::put('/admin/database/jabatan/{jabatan}', 'updateJabatan')->name('adm.updateJabatan');
    Route::get('/admin/database/fungsional', 'getAllJabatanFungsional')->name('adm.getAllJabatanFungsional');
    Route::get('/admin/database/fungsional/create', 'createJabatanFungsional')->name('adm.createJabatanFungsional');
    Route::post('/admin/database/fungsional', 'storeJabatanFungsional')->name('adm.storeJabatanFungsional');
    Route::get('/admin/database/fungsional/{jabatanFungsional}/edit', 'editJabatanFungsional')->name('adm.editJabatanFungsional');
    Route::put('/admin/database/fungsional/{jabatanFungsional}', 'updateJabatanFungsional')->name('adm.updateJabatanFungsional');
    Route::get('/admin/database/golongan', 'getAllPangkatGolongan')->name('adm.getAllPangkatGolongan');
    Route::get('/admin/database/golongan/create', 'createPangkatGolongan')->name('adm.createPangkatGolongan');
    Route::post('/admin/database/golongan', 'storePangkatGolongan')->name('adm.storePangkatGolongan');
    Route::get('/admin/database/golongan/{pangkatGolongan}/edit', 'editPangkatGolongan')->name('adm.editPangkatGolongan');
    Route::put('/admin/database/golongan/{pangkatGolongan}', 'updatePangkatGolongan')->name('adm.updatePangkatGolongan');
    Route::get('/admin/report', 'reportAkhir')->name('adm.reportAkhir');
    Route::post('/admin/report/excel', 'exportReport')->name('adm.exportReport');
    Route::get('/admin/kompetensi', 'kompetensiAkhir')->name('adm.kompetensiAkhir');
    Route::post('/admin/kompetensi/excel', 'exportKompetensi')->name('adm.exportKompetensi');
});

Route::middleware('auth')->controller(DosenController::class)->group(function () {
    Route::get('/dosen/index', 'index')->name('dsn.index');
    Route::get('/dosen/bimbingan/logbook', 'getLogbooks')->name('dsn.getLogbooks');
    Route::post('/dosen/bimbingan/logbook', 'acceptAllLogbook')->name('dsn.acceptAllLogbook');
    Route::get('/dosen/bimbingan/logbook/{logbook}', 'getLogbook')->name('dsn.getLogbook');
    Route::post('/dosen/bimbingan/logbook/{logbook}', 'acceptLogbook')->name('dsn.acceptLogbook');
    Route::get('/dosen/bimbingan/persetujuanSidang', 'getAllPersetujuanSidang')->name('dsn.getAllPersetujuanSidang');
    Route::get('/dosen/bimbingan/persetujuanSempro/{pengajuanSempro}', 'getPersetujuanSempro')->name('dsn.getPersetujuanSempro');
    Route::post('/dosen/bimbingan/persetujuanSempro/{pengajuanSempro}', 'acceptPersetujuanSidangSempro')->name('dsn.acceptPersetujuanSidangSempro');
    Route::get('/dosen/bimbingan/persetujuanSkripsi/{pengajuanSkripsi}', 'getPersetujuanSkripsi')->name('dsn.getPersetujuanSkripsi');
    Route::post('/dosen/bimbingan/persetujuanSkripsi/{pengajuanSkripsi}', 'acceptPersetujuanSidangSkripsi')->name('dsn.acceptPersetujuanSidangSkripsi');
    Route::get('/dosen/bimbingan/listMahasiswa', 'getAllListMahasiswa')->name('dsn.getAllListMahasiswa');
    Route::get('/dosen/bimbingan/listMahasiswa/{bimbingan}', 'getListMahasiswa')->name('dsn.getListMahasiswa');
    Route::get('/dosen/pengujian/sempro', 'getAllPengujianSempro')->name('dsn.getAllPengujianSempro');
    Route::get('/dosen/pengujian/sempro/{pengajuanSempro}', 'getPengujianSempro')->name('dsn.getPengujianSempro');
    Route::get('/dosen/pengujian/sempro/{pengajuanSempro}/terima', 'penilaianSempro')->name('dsn.penilaianSempro');
    Route::post('/dosen/pengujian/sempro/{pengajuanSempro}', 'nilaiSempro')->name('dsn.nilaiSempro');
    Route::get('/dosen/pengujian/skripsi', 'getAllPengujianSkripsi')->name('dsn.getAllPengujianSkripsi');
    Route::get('/dosen/pengujian/skripsi/{pengajuanSkripsi}', 'getPengujianSkripsi')->name('dsn.getPengujianSkripsi');
    Route::get('/dosen/pengujian/skripsi/{pengajuanSkripsi}/terima', 'penilaianSkripsi')->name('dsn.penilaianSkripsi');
    Route::get('/dosen/pengujian/terbimbing/{pengajuanSkripsi}/terima', 'penilaianTerbimbing')->name('dsn.penilaianTerbimbing');
    Route::post('/dosen/pengujian/skripsi/{pengajuanSkripsi}', 'nilaiskripsi')->name('dsn.nilaiskripsi');
    Route::get('/dosen/rekapitulasi', 'getAllRekapitulasi')->name('dsn.getAllRekapitulasi');
    Route::get('/dosen/rekapitulasi/{pengajuanSkripsi}', 'getRekapitulasi')->name('dsn.getRekapitulasi');
    Route::post('/dosen/rekapitulasi/{pengajuanSkripsi}', 'rekapNilai')->name('dsn.rekapNilai');
    Route::get('/dosen/kelulusan', 'getAllKelulusan')->name('dsn.getAllKelulusan');
    Route::get('/dosen/kelulusan/{pengajuanSkripsi}', 'getKelulusan')->name('dsn.getKelulusan');
    Route::post('/dosen/kelulusan/lulus/{pengajuanSkripsi}', 'luluskanSkripsi')->name('dsn.luluskanSkripsi');
    Route::post('/dosen/kelulusan/tolak/{pengajuanSkripsi}', 'tolakSkripsi')->name('dsn.tolakSkripsi');
    Route::post('/dosen/kelulusan/revisi/{pengajuanSkripsi}', 'revisiSkripsi')->name('dsn.revisiSkripsi');
    Route::get('/dosen/revisi', 'getAllRevisi')->name('dsn.getAllRevisi');
    Route::get('/dosen/revisi/{pengajuanRevisi}', 'getRevisi')->name('dsn.getRevisi');
    Route::post('/dosen/revisi/{pengajuanRevisi}', 'keputusanRevisi')->name('dsn.keputusanRevisi');
    Route::get('/dosen/profile', 'getProfile')->name('dsn.getProfile');
    Route::put('/dosen/profile/{user}', 'updateProfile')->name('dsn.updateProfile');
    Route::get('/dosen/history/sempro', 'historySempro')->name('dsn.historySempro');
    Route::get('/dosen/history/sempro/{pengajuanSempro}', 'historySemproDetail')->name('dsn.historySemproDetail');
    Route::get('/dosen/history/skripsi', 'historySkripsi')->name('dsn.historySkripsi');
    Route::get('/dosen/history/skripsi/{pengajuanSkripsi}', 'historySkripsiDetail')->name('dsn.historySkripsiDetail');
    Route::get('/dosen/history/logbook', 'historyLogbook')->name('dsn.historyLogbook');
    Route::get('/dosen/history/logbook/{logbook}', 'historyLogbookDetail')->name('dsn.historyLogbookDetail');
});
