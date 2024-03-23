<?php

namespace App\Http\Controllers;

use App\Services\MahasiswaService;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function __construct(protected MahasiswaService $mahasiswaService)
    {
    }

    public function index()
    {
        return view('mahasiswa.index', ['title' => 'index']);
    }

    // pengajuan
    public function pengajuanJudul()
    {
        return view('mahasiswa.pengajuan.pengajuanJudul', ['title' => 'pengajuan']);
    }

    public function pengajuanSempro()
    {
        return view('mahasiswa.pengajuan.pengajuanSempro', ['title' => 'pengajuan']);
    }

    public function pengajuanSkripsi()
    {
        return view('mahasiswa.pengajuan.pengajuanSkripsi', ['title' => 'pengajuan']);
    }

    public function pengajuanAlat()
    {
        return view('mahasiswa.pengajuan.pengajuanAlat', ['title' => 'pengajuan']);
    }

    // logbook
    public function getLogbooks()
    {
        return view('mahasiswa.logbook.index', ['title' => 'logbook']);
    }

    public function createLogbook()
    {
        return view('mahasiswa.logbook.logbookCreate', ['title' => 'logbook']);
    }

    // skripsi
    public function getSkripsi()
    {
        return view('mahasiswa.skripsi.index', ['title' => 'skripsi']);
    }

    public function editSkripsi()
    {
        return view('mahasiswa.skripsi.skripsiEdit', ['title' => 'skripsi']);
    }

    // informasi
    public function getInformations()
    {
        return view('mahasiswa.informasi.index', ['title' => 'informasi']);
    }

    public function getBeritaSempro()
    {
        return view('mahasiswa.informasi.beritaSempro', ['title' => 'informasi']);
    }
    public function getBeritaSkripsi()
    {
        return view('mahasiswa.informasi.beritaSkripsi', ['title' => 'informasi']);
    }

    //Revisi
    public function getAllRevisi()
    {
        return view('mahasiswa.Revisi.index', ['title' => 'revisi']);
    }
    public function getRevisi()
    {
        return view('mahasiswa.Revisi.detail', ['title' => 'revisi']);
    }

    // profile
    public function getProfile()
    {
        return view('mahasiswa.profile.index', ['title' => 'profile']);
    }

    public function editProfile()
    {
        return view('mahasiswa.profile.profileEdit', ['title' => 'profile']);
    }
}
