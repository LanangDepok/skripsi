<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(protected AdminService $adminService)
    {
    }

    public function index()
    {
        return view('admin.index', ['title' => 'index']);
    }

    // mahasiswa
    public function getStudents()
    {
        return view('admin.mahasiswa.index', ['title' => 'mahasiswa']);
    }

    public function getStudent()
    {
        return view('admin.mahasiswa.detailMahasiswa', ['title' => 'mahasiswa']);
    }

    public function editStudent()
    {
        return view('admin.mahasiswa.editMahasiswa', ['title' => 'mahasiswa']);
    }

    public function createStudent()
    {
        return view('admin.mahasiswa.createMahasiswa', ['title' => 'mahasiswa']);
    }

    // dosen
    public function getLecturers()
    {
        return view('admin.dosen.index', ['title' => 'dosen']);
    }

    public function getLecturer()
    {
        return view('admin.dosen.detailDosen', ['title' => 'dosen']);
    }

    public function createLecturer()
    {
        return view('admin.dosen.createDosen', ['title' => 'dosen']);
    }

    public function editLecturer()
    {
        return view('admin.dosen.editDosen', ['title' => 'dosen']);
    }

    //pengajuan judul
    public function pengajuanJudul()
    {
        return view('admin.pengajuan.judul.index', ['title' => 'pengajuan']);
    }

    public function storePengajuanJudul(Request $request)
    {
        dd($request);
    }

    public function getPengajuanJudul()
    {
        return view('admin.pengajuan.judul.detailPengajuan', ['title' => 'pengajuan']);
    }

    //pengajuan sempro
    public function pengajuanSempro()
    {
        return view('admin.pengajuan.sempro.index', ['title' => 'pengajuan']);
    }

    public function getPengajuanSempro()
    {
        return view('admin.pengajuan.sempro.detailPengajuan', ['title' => 'pengajuan']);
    }

    //pengajuan skripsi
    public function pengajuanSkripsi()
    {
        return view('admin.pengajuan.skripsi.index', ['title' => 'pengajuan']);
    }

    public function getPengajuanSkripsi()
    {
        return view('admin.pengajuan.skripsi.detailPengajuan', ['title' => 'pengajuan']);
    }

    //skripsi
    public function getSkripsian()
    {
        return view('admin.skripsi.index', ['title' => 'skripsi']);
    }
}
