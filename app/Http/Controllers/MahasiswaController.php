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
        return view('mahasiswa.index');
    }

    public function pengajuanJudul()
    {
        return view('mahasiswa.pengajuanJudul');
    }

    public function pengajuanSempro()
    {
        return view('mahasiswa.pengajuanSempro');
    }

    public function pengajuanSkripsi()
    {
        return view('mahasiswa.pengajuanSkripsi');
    }

    public function logbook()
    {
        return view('mahasiswa.logbook');
    }

    public function skripsi()
    {
        return view('mahasiswa.skripsi');
    }

    public function informasi()
    {
        return view('mahasiswa.informasi');
    }

    public function profile()
    {
        return view('mahasiswa.profile');
    }
}
