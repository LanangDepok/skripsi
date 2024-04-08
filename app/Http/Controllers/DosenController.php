<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Konten;
use App\Models\Logbook;
use App\Models\User;
use App\Services\DosenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DosenController extends Controller
{
    public function __construct(protected DosenService $dosenService)
    {
    }

    public function index()
    {
        $konten = Konten::get();

        return view('dosen.index', ['title' => 'index', 'konten' => $konten]);
    }

    //logbook
    public function getLogbooks()
    {
        $bimbingans = Auth::user()->dosen->bimbingans;

        return view('dosen.bimbingan.logbook.index', ['title' => 'bimbingan', 'bimbingans' => $bimbingans]);
    }

    public function getLogbook(Logbook $logbook)
    {
        return view('dosen.bimbingan.logbook.detailLogbook', ['title' => 'bimbingan', 'logbook' => $logbook]);
    }

    public function acceptLogbook(Request $request, Logbook $logbook)
    {
        if (isset($request->terima)) {
            $logbook->update(['status' => 'diterima']);
            return redirect('dosen/bimbingan/logbook');
        } else {
            $logbook->update(['status' => 'ditolak']);
            return redirect('dosen/bimbingan/logbook');

        }
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

    public function getListMahasiswa(Bimbingan $bimbingan)
    {
        return view('dosen.bimbingan.ListMahasiswa.detailMahasiswa', ['title' => 'bimbingan', 'bimbingan' => $bimbingan]);
    }


    //profile
    public function getProfile()
    {
        if (Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            return view('dosen.profile.index', ['title' => 'profile']);
        }
        abort(404);
    }

    public function updateProfile(Request $request, User $user)
    {
        if (Gate::forUser($user)->any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            $photo_profil = $request->photo_profil;
            $tanda_tangan = $request->tanda_tangan;

            $this->dosenService->updateProfile($user, $photo_profil, $tanda_tangan);

            return back();
        }
        abort(404);
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

    //kelulusan
    public function getAllKelulusan()
    {
        return view('dosen.kelulusan.index', ['title' => 'kelulusan']);
    }

    //pengajuan revisi
    public function getAllRevisi()
    {
        return view('dosen.revisi.index', ['title' => 'revisi']);
    }

    public function getRevisi()
    {
        return view('dosen.revisi.detail', ['title' => 'revisi']);
    }
}
