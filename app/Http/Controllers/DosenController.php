<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        return view('dosen.index', ['title' => 'index']);
    }

    //logbook
    public function getLogbooks()
    {
        return view('dosen.bimbingan.logbook.index', ['title' => 'bimbingan']);
    }

    public function getLogbook()
    {
        return view('dosen.bimbingan.logbook.detailLogbook', ['title' => 'bimbingan']);
    }

    //persetujuan sidang
    public function getAllPersetujuanSidang()
    {
        return view('dosen.bimbingan.persetujuanSidang.index', ['title' => 'bimbingan']);
    }

    public function getPersetujuanSidang()
    {
        return view('dosen.bimbingan.persetujuanSidang.detailPersetujuan', ['title' => 'bimbingan']);
    }

    //listMahasiswa
    public function getAllListMahasiswa()
    {
        return view('dosen.bimbingan.ListMahasiswa.index', ['title' => 'bimbingan']);
    }

    public function getListMahasiswa()
    {
        return view('dosen.bimbingan.ListMahasiswa.detailMahasiswa', ['title' => 'bimbingan']);
    }


    //profile
    public function getProfile()
    {
        return view('dosen.profile.index', ['title' => 'profile']);
    }

    public function editProfile()
    {
        return view('dosen.profile.edit', ['title' => 'profile']);
    }

    //pengujian sempro
    public function getAllPengujianSempro()
    {
        return view('dosen.pengujian.sempro.index', ['title' => 'pengujian']);
    }

    public function getPengujianSempro()
    {
        return view('dosen.pengujian.sempro.detail', ['title' => 'pengujian']);
    }

    public function penilaianSempro()
    {
        return view('dosen.pengujian.sempro.penilaian', ['title' => 'pengujian']);
    }

    //pengujian skripsi
    public function getAllPengujianSkripsi()
    {
        return view('dosen.pengujian.skripsi.index', ['title' => 'pengujian']);
    }

    public function getPengujianSkripsi()
    {
        return view('dosen.pengujian.skripsi.detail', ['title' => 'pengujian']);
    }

    public function penilaianSkripsi()
    {
        return view('dosen.pengujian.skripsi.penilaian', ['title' => 'pengujian']);
    }

    //pengujian terbimbing
    public function getAllPengujianTerbimbing()
    {
        return view('dosen.pengujian.terbimbing.index', ['title' => 'pengujian']);
    }

    public function getPengujianTerbimbing()
    {
        return view('dosen.pengujian.terbimbing.detail', ['title' => 'pengujian']);
    }

    public function penilaianTerbimbing()
    {
        return view('dosen.pengujian.terbimbing.penilaian', ['title' => 'pengujian']);
    }

    //rekapitulasi nilai
    public function getAllRekapitulasi()
    {
        return view('dosen.rekapitulasi.index', ['title' => 'rekapitulasi']);
    }

    public function getRekapitulasi()
    {
        return view('dosen.rekapitulasi.detail', ['title' => 'rekapitulasi']);
    }
}
