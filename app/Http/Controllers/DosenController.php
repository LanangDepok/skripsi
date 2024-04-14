<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Konten;
use App\Models\Logbook;
use App\Models\PengajuanSempro;
use App\Models\User;
use App\Services\DosenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        if (Gate::allows('dosen_pembimbing')) {
            if (Auth::user()->dosen->tanda_tangan == null) {
                return redirect('/dosen/profile')->with('messages', 'Silahkan isi tanda tangan terlebih dahulu.');
            }
            $bimbingans = Auth::user()->dosen->bimbingans;
            return view('dosen.bimbingan.logbook.index', ['title' => 'bimbingan', 'bimbingans' => $bimbingans]);
        }
        abort(404);
    }

    public function getLogbook(Logbook $logbook)
    {
        if (Gate::allows('dosen_pembimbing')) {
            return view('dosen.bimbingan.logbook.detailLogbook', ['title' => 'bimbingan', 'logbook' => $logbook]);
        }
        abort(404);
    }

    public function acceptLogbook(Request $request, Logbook $logbook)
    {
        if (Gate::allows('dosen_pembimbing')) {
            if (isset($request->terima)) {
                $logbook->update(['status' => 'diterima']);
                return redirect('/dosen/bimbingan/logbook');
            } else {
                $logbook->update(['status' => 'ditolak']);
                return redirect('/dosen/bimbingan/logbook');
            }
        }
        abort(404);
    }

    //persetujuan sidang
    public function getAllPersetujuanSidang()
    {
        if (Gate::allows('dosen_pembimbing')) {
            return view('dosen.bimbingan.persetujuanSidang.index', ['title' => 'bimbingan']);
        }
        abort(404);
    }

    public function getPersetujuanSidang(PengajuanSempro $pengajuanSempro)
    {
        if (Gate::allows('dosen_pembimbing')) {
            return view('dosen.bimbingan.persetujuanSidang.detailPersetujuan', ['title' => 'bimbingan', 'pengajuanSempro' => $pengajuanSempro]);
        }
        abort(404);
    }

    public function acceptPersetujuanSidangSempro(Request $request, PengajuanSempro $pengajuanSempro)
    {
        if (Gate::allows('dosen_pembimbing')) {
            if (isset($request->terima)) {
                $pengajuanSempro->update(['status' => 'Menunggu pembagian jadwal']);
                return redirect('/dosen/bimbingan/persetujuanSidang');
            } else {
                $pengajuanSempro->update(['status' => 'Ditolak']);
                return redirect('/dosen/bimbingan/persetujuanSidang');
            }
        }
        abort(404);
    }

    //listMahasiswa
    public function getAllListMahasiswa()
    {
        if (Gate::allows('dosen_pembimbing')) {
            return view('dosen.bimbingan.ListMahasiswa.index', ['title' => 'bimbingan']);
        }
        abort(404);
    }

    public function getListMahasiswa(Bimbingan $bimbingan)
    {
        if (Gate::allows('dosen_pembimbing')) {
            return view('dosen.bimbingan.ListMahasiswa.detailMahasiswa', ['title' => 'bimbingan', 'bimbingan' => $bimbingan]);
        }
        abort(404);
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
        if (Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            if (Auth::user()->dosen->tanda_tangan == null) {
                return redirect('/dosen/profile')->with('messages', 'Silahkan isi tanda tangan terlebih dahulu.');
            }
            $ketua_sidang = PengajuanSempro::where('penguji1_id', '=', Auth::user()->id)->where('status', '=', 'Menunggu sidang')->get();
            $dosen_penguji = PengajuanSempro::where('penguji2_id', '=', Auth::user()->id)->orWhere('penguji3_id', '=', Auth::user()->id)->where('status', '=', 'Menunggu sidang')->get();
            $dosen_pembimbing = PengajuanSempro::where('dospem_id', '=', Auth::user()->id)->where('status', '=', 'Menunggu sidang')->get();
            return view('dosen.pengujian.sempro.index', [
                'title' => 'pengujian',
                'ketua_sidang' => $ketua_sidang,
                'dosen_penguji' => $dosen_penguji,
                'dosen_pembimbing' => $dosen_pembimbing,
            ]);
        }
        abort(404);
    }

    public function getPengujianSempro(PengajuanSempro $pengajuanSempro)
    {
        if (Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            return view('dosen.pengujian.sempro.detail', ['title' => 'pengujian', 'pengajuanSempro' => $pengajuanSempro]);
        }
        abort(404);
    }

    public function penilaianSempro(PengajuanSempro $pengajuanSempro)
    {
        if (Gate::allows('ketua_penguji')) {
            return view('dosen.pengujian.sempro.penilaian', ['title' => 'pengujian', 'pengajuanSempro' => $pengajuanSempro]);
        }
        abort(404);
    }

    public function nilaiSempro(Request $request, PengajuanSempro $pengajuanSempro)
    {
        if (Gate::allows('ketua_penguji')) {
            $data = $request->all();
            $rules = [
                'kriteria1' => [Rule::in([1, 2, 4, 5]), 'required'],
                'kriteria2' => [Rule::in([1, 2, 4, 5]), 'required'],
                'kriteria3' => [Rule::in([1, 2, 4, 5]), 'required'],
                'kriteria4' => [Rule::in([1, 2, 4, 5]), 'required'],
                'kriteria5' => [Rule::in([1, 2, 4, 5]), 'required'],
                'nilai' => 'required',
                'keterangan' => 'nullable',
            ];
            $messages = [
                'required' => ':attribute tidak boleh kosong.',
                'kriteria1.in' => 'Harus bernilai antara 1, 2, 4, atau 5.',
                'kriteria2.in' => 'Harus bernilai antara 1, 2, 4, atau 5.',
                'kriteria3.in' => 'Harus bernilai antara 1, 2, 4, atau 5.',
                'kriteria4.in' => 'Harus bernilai antara 1, 2, 4, atau 5.',
                'kriteria5.in' => 'Harus bernilai antara 1, 2, 4, atau 5.',
            ];
            $validator = Validator::make($data, $rules, $messages);

            $data = $validator->safe()->only(['nilai', 'keterangan']);

            if ($data['nilai'] >= 400) {
                $data['status'] = 'Lulus';
                $pengajuanSempro->update($data);
            } else {
                $data['status'] = 'Tidak lulus';
                $pengajuanSempro->update($data);
            }

            $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->update(['status' => 'Bimbingan Skripsi']);

            return redirect('/dosen/pengujian/sempro');
        }
        abort(404);
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
