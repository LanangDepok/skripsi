<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Konten;
use App\Models\Logbook;
use App\Models\PengajuanRevisi;
use App\Models\PengajuanSempro;
use App\Models\PengajuanSkripsi;
use App\Models\ProgramStudi;
use App\Models\Role;
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
        if (Gate::any(['dosen_pembimbing', 'dosen_penguji'])) {
            $konten = Konten::get();
            return view('dosen.index', ['title' => 'index', 'konten' => $konten]);
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
        if (Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing']) && Auth::user()->id == $user->id) {
            $data = $request->all();
            $rules = [
                'photo_profil' => 'nullable|mimes:jpg,jpeg,png',
                'tanda_tangan' => 'nullable|mimes:jpg,jpeg,png',
            ];
            $messages = [
                'regex' => ':attribute harus berupa angka.',
                'mimes' => ':attribute harus berupa gambar dengan format (jpg, jpeg, png).',
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            if ($request->password) {
                $user->update(['password' => $request->password]);
            }

            $this->dosenService->updateProfile($user, $validated);

            return back();
        }
        abort(404);
    }

    //logbook
    public function getLogbooks()
    {
        if (Gate::allows('dosen_pembimbing')) {
            if (Auth::user()->dosen->tanda_tangan == null) {
                return redirect('/dosen/profile')->with('messages', 'Silahkan isi tanda tangan terlebih dahulu.');
            }
            $bimbingan = Auth::user()->bimbinganDosen;
            $bimbingan2 = Auth::user()->bimbinganDosen2;
            return view('dosen.bimbingan.logbook.index', ['title' => 'bimbingan', 'bimbingan' => $bimbingan, 'bimbingan2' => $bimbingan2]);
        }
        abort(404);
    }

    public function getLogbook(Logbook $logbook)
    {
        if (Gate::allows('dosen_pembimbing') && (Auth::user()->id == $logbook->bimbingan->dosen_id || Auth::user()->id == $logbook->bimbingan->dosen2_id)) {
            return view('dosen.bimbingan.logbook.detailLogbook', ['title' => 'bimbingan', 'logbook' => $logbook]);
        }
        abort(404);
    }

    public function acceptLogbook(Request $request, Logbook $logbook)
    {
        if (Gate::allows('dosen_pembimbing') && (Auth::user()->id == $logbook->bimbingan->dosen_id || Auth::user()->id == $logbook->bimbingan->dosen2_id)) {
            $cekTerima = $request->terima;

            $this->dosenService->acceptLogbook($logbook, $cekTerima);

            return redirect('/dosen/bimbingan/logbook');
        }
        abort(404);
    }
    public function acceptAllLogbook(Request $request)
    {
        if (Gate::allows('dosen_pembimbing')) {
            $data = $request->all();
            $rules = ['logbook' => 'required'];
            $messages = ['required' => 'Silahkan pilih logbook yang ingin diterima terlebih dahulu.'];
            $validated = Validator::make($data, $rules, $messages)->validate();
            foreach ($validated['logbook'] as $terima) {
                Logbook::where('id', '=', $terima)->update(['status' => 'Diterima']);
            }

            return redirect('/dosen/bimbingan/logbook');
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

    public function getPersetujuanSempro(PengajuanSempro $pengajuanSempro)
    {
        if (Gate::allows('dosen_pembimbing') && Auth::user()->id == $pengajuanSempro->dospem_id) {
            return view('dosen.bimbingan.persetujuanSidang.detailPersetujuanSempro', ['title' => 'bimbingan', 'pengajuanSempro' => $pengajuanSempro]);
        }
        abort(404);
    }

    public function acceptPersetujuanSidangSempro(Request $request, PengajuanSempro $pengajuanSempro)
    {
        if (Gate::allows('dosen_pembimbing') && Auth::user()->id == $pengajuanSempro->dospem_id) {
            $cekTerima = $request->terima;

            $this->dosenService->acceptPersetujuanSidangSempro($pengajuanSempro, $cekTerima);

            return redirect('/dosen/bimbingan/persetujuanSidang');
        }
        abort(404);
    }
    public function getPersetujuanSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::allows('dosen_pembimbing') && (Auth::user()->id == $pengajuanSkripsi->dospem_id || Auth::user()->id == $pengajuanSkripsi->dospem2_id)) {
            return view('dosen.bimbingan.persetujuanSidang.detailPersetujuanSkripsi', ['title' => 'bimbingan', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function acceptPersetujuanSidangSkripsi(Request $request, PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::allows('dosen_pembimbing') && (Auth::user()->id == $pengajuanSkripsi->dospem_id || Auth::user()->id == $pengajuanSkripsi->dospem2_id)) {
            $cekTerima = $request->terima;

            $this->dosenService->acceptPersetujuanSidangSkripsi($pengajuanSkripsi, $cekTerima);

            return redirect('/dosen/bimbingan/persetujuanSidang');
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
        if (Gate::allows('dosen_pembimbing') && (Auth::user()->id == $bimbingan->dosen_id || Auth::user()->id == $bimbingan->dosen2_id)) {
            return view('dosen.bimbingan.ListMahasiswa.detailMahasiswa', ['title' => 'bimbingan', 'bimbingan' => $bimbingan]);
        }
        abort(404);
    }

    //pengujian sempro
    public function getAllPengujianSempro(Request $request)
    {
        if (Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            if (Auth::user()->dosen->tanda_tangan == null) {
                return redirect('/dosen/profile')->with('messages', 'Silahkan isi tanda tangan terlebih dahulu.');
            }

            $prodi = ProgramStudi::get();

            $query = PengajuanSempro::where(function ($query) {
                $query->where('penguji1_id', Auth::user()->id)
                    ->orWhere('penguji2_id', Auth::user()->id)
                    ->orWhere('penguji3_id', Auth::user()->id)
                    ->orWhere('dospem_id', Auth::user()->id);
            })
                ->whereIn('status', ['Menunggu sidang']);

            if ($request->filled('cari_nama')) {
                $cari_nama = $request->input('cari_nama');
                $query->whereHas('pengajuanSemproMahasiswa', function ($query) use ($cari_nama) {
                    $query->where('nama', 'like', '%' . $cari_nama . '%');
                });
            }
            if ($request->filled('cari_prodi')) {
                $cari_prodi = $request->input('cari_prodi');
                $query->whereHas('pengajuanSemproMahasiswa.mahasiswa', function ($query) use ($cari_prodi) {
                    $query->where('prodi_id', $cari_prodi);
                });
            }
            if ($request->filled('cari_bimbingan')) {
                $cari_bimbingan = $request->input('cari_bimbingan');
                if ($cari_bimbingan == 'mahasiswa_bimbingan') {
                    $query->where('dospem_id', '=', Auth::user()->id);
                } elseif ($cari_bimbingan == 'mahasiswa_teruji') {
                    $query->where('dospem_id', '!=', Auth::user()->id);
                }
            }

            $data = $query->get();

            return view('dosen.pengujian.sempro.index', [
                'title' => 'pengujian',
                'data' => $data,
                'prodi' => $prodi,
            ]);
        }
        abort(404);
    }

    public function getPengujianSempro(PengajuanSempro $pengajuanSempro)
    {
        if (
            Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing']) && (
                Auth::user()->id == $pengajuanSempro->dospem_id
                || Auth::user()->id == $pengajuanSempro->penguji1_id
                || Auth::user()->id == $pengajuanSempro->penguji2_id
                || Auth::user()->id == $pengajuanSempro->penguji3_id)
        ) {
            return view('dosen.pengujian.sempro.detail', ['title' => 'pengujian', 'pengajuanSempro' => $pengajuanSempro]);
        }
        abort(404);
    }

    public function penilaianSempro(PengajuanSempro $pengajuanSempro)
    {
        if (Gate::allows('ketua_penguji') && Auth::user()->id == $pengajuanSempro->penguji1_id) {
            $role = Role::get();
            $dosen_pembimbing = $role[4]->users;

            return view('dosen.pengujian.sempro.penilaian', ['title' => 'pengujian', 'pengajuanSempro' => $pengajuanSempro, 'dosenPembimbing' => $dosen_pembimbing]);
        }
        abort(404);
    }

    public function nilaiSempro(Request $request, PengajuanSempro $pengajuanSempro)
    {
        if (Gate::allows('ketua_penguji') && Auth::user()->id == $pengajuanSempro->penguji1_id) {
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
            $validator = Validator::make($data, $rules, $messages)->validate();

            $dospem2_id = $request->dospem2_id;

            $this->dosenService->nilaiSempro($pengajuanSempro, $validator, $dospem2_id);

            return redirect('/dosen/pengujian/sempro');
        }
        abort(404);
    }

    //pengujian skripsi
    public function getAllPengujianSkripsi(Request $request)
    {
        if (Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            if (Auth::user()->dosen->tanda_tangan == null) {
                return redirect('/dosen/profile')->with('messages', 'Silahkan isi tanda tangan terlebih dahulu.');
            }
            $prodi = ProgramStudi::get();
            $query = PengajuanSkripsi::where(function ($query) {
                $query->where('penguji1_id', Auth::user()->id)
                    ->orWhere('penguji2_id', Auth::user()->id)
                    ->orWhere('penguji3_id', Auth::user()->id)
                    ->orWhere('dospem_id', Auth::user()->id)
                    ->orWhere('dospem2_id', Auth::user()->id);
            })
                ->whereIn('status', ['Menunggu sidang', 'Menunggu penilaian']);

            if ($request->filled('cari_nama')) {
                $cari_nama = $request->input('cari_nama');
                $query->whereHas('pengajuanSkripsiMahasiswa', function ($query) use ($cari_nama) {
                    $query->where('nama', 'like', '%' . $cari_nama . '%');
                });
            }
            if ($request->filled('cari_prodi')) {
                $cari_prodi = $request->input('cari_prodi');
                $query->whereHas('pengajuanSkripsiMahasiswa.mahasiswa', function ($query) use ($cari_prodi) {
                    $query->where('prodi_id', $cari_prodi);
                });
            }
            if ($request->filled('cari_bimbingan')) {
                $cari_bimbingan = $request->input('cari_bimbingan');
                if ($cari_bimbingan == 'mahasiswa_bimbingan') {
                    $query->where(function ($query) {
                        $query->where('dospem_id', '=', Auth::user()->id)
                            ->orWhere('dospem2_id', '=', Auth::user()->id);
                    });
                } elseif ($cari_bimbingan == 'mahasiswa_teruji') {
                    $query->where(function ($query) {
                        $query->whereNotNull('dospem2_id')
                            ->where('dospem_id', '!=', Auth::user()->id)
                            ->where('dospem2_id', '!=', Auth::user()->id);
                    })->orWhere(function ($query) {
                        $query->where('dospem2_id', '=', null)
                            ->where('dospem_id', '!=', Auth::user()->id);
                    });
                }
            }
            $data = $query->get();
            return view('dosen.pengujian.skripsi.index', [
                'title' => 'pengujian',
                'data' => $data,
                'prodi' => $prodi,
            ]);
        }
        abort(404);
    }
    public function getPengujianSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (
            Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing']) && (
                Auth::user()->id == $pengajuanSkripsi->dospem_id
                || Auth::user()->id == $pengajuanSkripsi->penguji1_id
                || Auth::user()->id == $pengajuanSkripsi->penguji2_id
                || Auth::user()->id == $pengajuanSkripsi->penguji3_id
                || Auth::user()->id == $pengajuanSkripsi->dospem2_id)
        ) {
            return view('dosen.pengujian.skripsi.detail', ['title' => 'pengujian', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function penilaianSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (
            Gate::any(['ketua_penguji', 'dosen_penguji']) && (
                Auth::user()->id == $pengajuanSkripsi->penguji1_id
                || Auth::user()->id == $pengajuanSkripsi->penguji2_id
                || Auth::user()->id == $pengajuanSkripsi->penguji3_id
            )
        ) {
            return view('dosen.pengujian.skripsi.penilaian', ['title' => 'pengujian', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function nilaiSkripsi(Request $request, PengajuanSkripsi $pengajuanSkripsi)
    {
        if (
            Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing']) && (
                Auth::user()->id == $pengajuanSkripsi->dospem_id
                || Auth::user()->id == $pengajuanSkripsi->penguji1_id
                || Auth::user()->id == $pengajuanSkripsi->penguji2_id
                || Auth::user()->id == $pengajuanSkripsi->penguji3_id
                || Auth::user()->id == $pengajuanSkripsi->dospem2_id)
        ) {
            if (
                $pengajuanSkripsi->penguji1_id == Auth::user()->id ||
                $pengajuanSkripsi->penguji2_id == Auth::user()->id ||
                $pengajuanSkripsi->penguji3_id == Auth::user()->id
            ) {

                $data = $request->all();
                $rules = [
                    'a1' => 'required|numeric|between:4.5,10',
                    'a2' => 'required|numeric|between:4.5,15',
                    'a3' => 'required|numeric|between:4.5,10',
                    'b1' => 'required|numeric|between:5.5,15',
                    'b2' => 'required|numeric|between:5.5,15',
                    'b3' => 'required|numeric|between:5.5,10',
                    'b4' => 'required|numeric|between:5.5,10',
                    'b5' => 'required|numeric|between:5.5,15',
                    'total_nilai' => 'required',
                ];
                $messages = [
                    'required' => 'Nilai tidak boleh kosong.',
                    'numeric' => 'Nilai harus berupa angka',
                    'between' => 'Nilai harus bernilai antara :min hingga :max',
                ];
                $validated = Validator::make($data, $rules, $messages)->validate();
                $this->dosenService->nilaiSkripsiPenguji($pengajuanSkripsi, $validated);
            } elseif ($pengajuanSkripsi->dospem_id == Auth::user()->id || $pengajuanSkripsi->dospem2_id == Auth::user()->id) {
                $data = $request->all();
                $rules = [
                    'a1' => 'required|numeric|between:4.5,10',
                    'a2' => 'required|numeric|between:4.5,15',
                    'a3' => 'required|numeric|between:4.5,10',
                    'b1' => 'required|numeric|between:4.5,15',
                    'b2' => 'required|numeric|between:4.5,10',
                    'b3' => 'required|numeric|between:4.5,10',
                    'b4' => 'required|numeric|between:4.5,15',
                    'c1' => 'required|numeric|between:1.5,4',
                    'c2' => 'required|numeric|between:1.5,4',
                    'c3' => 'required|numeric|between:1,3',
                    'c4' => 'required|numeric|between:1,4',
                    'total_nilai' => 'required',
                ];
                $messages = [
                    'required' => 'Nilai tidak boleh kosong.',
                    'numeric' => 'Nilai harus berupa angka',
                    'between' => 'Nilai harus bernilai antara :min hingga :max',
                ];
                $validated = Validator::make($data, $rules, $messages)->validate();
                $this->dosenService->nilaiSkripsiPembimbing($pengajuanSkripsi, $validated);
            }
            return redirect('/dosen/pengujian/skripsi');
        }
        abort(404);
    }
    public function penilaianTerbimbing(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::allows('dosen_pembimbing') && (Auth::user()->id == $pengajuanSkripsi->dospem_id || Auth::user()->id == $pengajuanSkripsi->dospem2_id)) {
            return view('dosen.pengujian.terbimbing.penilaian', ['title' => 'pengujian', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }


    //rekapitulasi nilai
    public function getAllRekapitulasi()
    {
        if (Gate::allows('ketua_penguji')) {
            $pengajuanSkripsi = PengajuanSkripsi::where('penguji1_id', '=', Auth::user()->id)
                ->where('status', '=', 'Menunggu penilaian')->where('nilai_total', '=', null)->get();
            return view('dosen.rekapitulasi.index', ['title' => 'rekapitulasi', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }

    public function getRekapitulasi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::allows('ketua_penguji') && Auth::user()->id == $pengajuanSkripsi->penguji1_id) {
            return view('dosen.rekapitulasi.detail', ['title' => 'rekapitulasi', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }

    public function rekapNilai(Request $request, PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::allows('ketua_penguji') && Auth::user()->id == $pengajuanSkripsi->penguji1_id) {
            $data = $request->all();
            $rules = [
                'nilai_pembimbing' => 'required|numeric',
                'nilai_pembimbing2' => 'nullable|numeric',
                'nilai1' => 'required|numeric',
                'nilai2' => 'required|numeric',
                'nilai3' => 'required|numeric',
                'nilai_total' => 'required',
            ];
            $messages = [
                'required' => 'Nilai tidak boleh kosong',
                'numeric' => 'Nilai harus berupa angka',
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            $this->dosenService->rekapNilai($pengajuanSkripsi, $validated);

            return redirect('/dosen/rekapitulasi');
        }
        abort(404);
    }

    //kelulusan
    public function getAllKelulusan()
    {
        if (Gate::allows('ketua_penguji')) {
            $pengajuanSkripsi = PengajuanSkripsi::where('penguji1_id', '=', Auth::user()->id)->where('status', '=', 'Menunggu kelulusan')->get();
            return view('dosen.kelulusan.index', ['title' => 'kelulusan', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }

    public function getKelulusan(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::allows('ketua_penguji') && Auth::user()->id == $pengajuanSkripsi->penguji1_id) {
            return view('dosen.kelulusan.detail', ['title' => 'kelulusan', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }

    public function luluskanSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::allows('ketua_penguji') && Auth::user()->id == $pengajuanSkripsi->penguji1_id) {
            $pengajuanSkripsi->update(['status' => 'Lulus']);
            $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->update(['status' => 'Lulus']);

            return redirect('/dosen/kelulusan');
        }
        abort(404);
    }
    public function tolakSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::allows('ketua_penguji') && Auth::user()->id == $pengajuanSkripsi->penguji1_id) {
            $pengajuanSkripsi->update(['status' => 'Tidak lulus']);

            return redirect('/dosen/kelulusan');
        }
        abort(404);
    }

    public function revisiSkripsi(Request $request, PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::allows('ketua_penguji') && Auth::user()->id == $pengajuanSkripsi->penguji1_id) {
            $data = $request->all();
            $rules = [
                'revisi_alat' => 'nullable|required_without_all:revisi_laporan',
                'revisi_laporan' => 'nullable|required_without_all:revisi_alat',
            ];
            $messages = [
                'revisi_alat.required_without_all' => 'Pastikan terisi salah satu antara revisi alat atau revisi laporan.',
                'revisi_laporan.required_without_all' => 'Pastikan terisi salah satu antara revisi alat atau revisi laporan.',
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            $this->dosenService->revisiSkripsi($pengajuanSkripsi, $validated);

            return redirect('/dosen/kelulusan');
        }
        abort(404);
    }

    //pengajuan revisi
    public function getAllRevisi()
    {
        if (Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            $terima_penguji1 = PengajuanSkripsi::where('penguji1_id', '=', Auth::user()->id)
                ->where('status', '=', 'Menunggu persetujuan revisi')->whereHas('pengajuanRevisi', function ($query) {
                    $query->where('terima_penguji1', '=', null);
                })->get();
            $terima_penguji2 = PengajuanSkripsi::where('penguji2_id', '=', Auth::user()->id)->where('status', '=', 'Menunggu persetujuan revisi')
                ->whereHas('pengajuanRevisi', function ($query) {
                    $query->where('terima_penguji2', '=', null);
                })->get();
            $terima_penguji3 = PengajuanSkripsi::where('penguji3_id', '=', Auth::user()->id)->where('status', '=', 'Menunggu persetujuan revisi')
                ->whereHas('pengajuanRevisi', function ($query) {
                    $query->where('terima_penguji3', '=', null);
                })->get();
            $terima_pembimbing = PengajuanSkripsi::where('dospem_id', '=', Auth::user()->id)->where('status', '=', 'Menunggu persetujuan revisi')
                ->whereHas('pengajuanRevisi', function ($query) {
                    $query->where('terima_pembimbing', '=', null);
                })->get();
            $terima_pembimbing2 = PengajuanSkripsi::where('dospem2_id', '=', Auth::user()->id)->where('status', '=', 'Menunggu persetujuan revisi')
                ->whereHas('pengajuanRevisi', function ($query) {
                    $query->where('terima_pembimbing2', '=', null);
                })->get();
            return view('dosen.revisi.index', [
                'title' => 'revisi',
                'terima_penguji1' => $terima_penguji1,
                'terima_penguji2' => $terima_penguji2,
                'terima_penguji3' => $terima_penguji3,
                'terima_pembimbing' => $terima_pembimbing,
                'terima_pembimbing2' => $terima_pembimbing2,
            ]);
        }
        abort(404);
    }

    public function getRevisi(PengajuanRevisi $pengajuanRevisi)
    {
        if (
            Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing']) && (
                Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->dospem_id
                || Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji1_id
                || Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji2_id
                || Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji3_id
                || Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->dospem2_id)
        ) {
            return view('dosen.revisi.detail', ['title' => 'revisi', 'pengajuanRevisi' => $pengajuanRevisi]);
        } elseif (Gate::allows('komite')) {
            return view('dosen.revisi.detail', ['title' => 'revisi', 'pengajuanRevisi' => $pengajuanRevisi]);
        }
        abort(404);
    }

    public function keputusanRevisi(Request $request, PengajuanRevisi $pengajuanRevisi)
    {
        if (
            Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing']) && (
                Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->dospem_id
                || Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji1_id
                || Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji2_id
                || Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji3_id
                || Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->dospem2_id)
        ) {
            if ($request->terima) {
                $this->dosenService->terimaRevisi($pengajuanRevisi);
            } else {
                $data = $request->all();
                $rules = ['keterangan_revisi' => 'required'];
                $messages = ['required' => 'Jika melakukan revisi ulang, silahkan mengisi keterangan revisi terlebih dahulu.'];
                $validated = Validator::make($data, $rules, $messages)->validate();

                $this->dosenService->revisiUlang($pengajuanRevisi, $validated);
            }
            return redirect('/dosen/revisi');
        }
        abort(404);
    }

    //history
    public function historySempro(Request $request)
    {
        if (Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            $prodi = ProgramStudi::get();

            $query = PengajuanSempro::where(function ($query) {
                $query->where('penguji1_id', Auth::user()->id)
                    ->orWhere('penguji2_id', Auth::user()->id)
                    ->orWhere('penguji3_id', Auth::user()->id)
                    ->orWhere('dospem_id', Auth::user()->id);
            })
                ->whereIn('status', ['Ditolak', 'Lulus', 'Tidak Lulus']);

            if ($request->filled('cari_nama')) {
                $cari_nama = $request->input('cari_nama');
                $query->whereHas('pengajuanSemproMahasiswa', function ($query) use ($cari_nama) {
                    $query->where('nama', 'like', '%' . $cari_nama . '%');
                });
            }
            if ($request->filled('cari_prodi')) {
                $cari_prodi = $request->input('cari_prodi');
                $query->whereHas('pengajuanSemproMahasiswa.mahasiswa', function ($query) use ($cari_prodi) {
                    $query->where('prodi_id', $cari_prodi);
                });
            }
            if ($request->filled('cari_bimbingan')) {
                $cari_bimbingan = $request->input('cari_bimbingan');
                if ($cari_bimbingan == 'mahasiswa_bimbingan') {
                    $query->where('dospem_id', '=', Auth::user()->id);
                } elseif ($cari_bimbingan == 'mahasiswa_teruji') {
                    $query->where('dospem_id', '!=', Auth::user()->id);
                }
            }
            if ($request->filled('cari_status')) {
                $cari_status = $request->input('cari_status');
                $query->where('status', 'like', '%' . $cari_status . '%');
            }

            $data = $query->latest()->paginate(30);

            return view('dosen.history.sempro', [
                'title' => 'history',
                'data' => $data,
                'prodi' => $prodi,
            ]);
        }
        abort(404);
    }
    public function historySemproDetail(PengajuanSempro $pengajuanSempro)
    {
        if (Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            return view('dosen.history.detailSempro', ['title' => 'history', 'pengajuanSempro' => $pengajuanSempro]);
        }
        abort(404);
    }
    public function historySkripsi(Request $request)
    {
        if (Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            if (Auth::user()->dosen->tanda_tangan == null) {
                return redirect('/dosen/profile')->with('messages', 'Silahkan isi tanda tangan terlebih dahulu.');
            }
            $prodi = ProgramStudi::get();
            $query = PengajuanSkripsi::where(function ($query) {
                $query->where('penguji1_id', Auth::user()->id)
                    ->orWhere('penguji2_id', Auth::user()->id)
                    ->orWhere('penguji3_id', Auth::user()->id)
                    ->orWhere('dospem_id', Auth::user()->id)
                    ->orWhere('dospem2_id', Auth::user()->id);
            })
                ->whereIn('status', ['Ditolak', 'Lulus', 'Tidak Lulus', 'Revisi']);

            if ($request->filled('cari_nama')) {
                $cari_nama = $request->input('cari_nama');
                $query->whereHas('pengajuanSkripsiMahasiswa', function ($query) use ($cari_nama) {
                    $query->where('nama', 'like', '%' . $cari_nama . '%');
                });
            }
            if ($request->filled('cari_prodi')) {
                $cari_prodi = $request->input('cari_prodi');
                $query->whereHas('pengajuanSkripsiMahasiswa.mahasiswa', function ($query) use ($cari_prodi) {
                    $query->where('prodi_id', $cari_prodi);
                });
            }
            if ($request->filled('cari_bimbingan')) {
                $cari_bimbingan = $request->input('cari_bimbingan');
                if ($cari_bimbingan == 'mahasiswa_bimbingan') {
                    $query->where(function ($query) {
                        $query->where('dospem_id', '=', Auth::user()->id)
                            ->orWhere('dospem2_id', '=', Auth::user()->id);
                    });
                } elseif ($cari_bimbingan == 'mahasiswa_teruji') {
                    $query->where(function ($query) {
                        $query->whereNotNull('dospem2_id')
                            ->where('dospem_id', '!=', Auth::user()->id)
                            ->where('dospem2_id', '!=', Auth::user()->id);
                    })->orWhere(function ($query) {
                        $query->where('dospem2_id', '=', null)
                            ->where('dospem_id', '!=', Auth::user()->id);
                    });
                }
            }
            if ($request->filled('cari_status')) {
                $cari_status = $request->input('cari_status');
                $query->where('status', 'like', '%' . $cari_status . '%');
            }

            $data = $query->latest()->paginate(30);

            return view('dosen.history.skripsi', [
                'title' => 'history',
                'data' => $data,
                'prodi' => $prodi,
            ]);
        }
        abort(404);
    }
    public function historySkripsiDetail(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            return view('dosen.history.detailSkripsi', ['title' => 'history', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function historyLogbook(Request $request)
    {
        if (Gate::allows('dosen_pembimbing')) {
            if (Auth::user()->dosen->tanda_tangan == null) {
                return redirect('/dosen/profile')->with('messages', 'Silahkan isi tanda tangan terlebih dahulu.');
            }

            $query = Logbook::query();
            if ($request->filled('cari_nama')) {
                $cari_nama = $request->input('cari_nama');
                $query->whereHas('bimbingan.bimbinganMahasiswa', function ($query) use ($cari_nama) {
                    $query->where('nama', 'like', '%' . $cari_nama . '%');
                });
            }
            if ($request->filled('cari_status')) {
                $cari_status = $request->input('cari_status');
                $query->where('status', '=', $cari_status);
            }
            $logbook = $query->latest()->paginate(30);
            return view('dosen.history.logbook', ['title' => 'history', 'data' => $logbook]);
        }
        abort(404);
    }
    public function historyLogbookDetail(Logbook $logbook)
    {
        if (Gate::allows('dosen_pembimbing') && (Auth::user()->id == $logbook->bimbingan->dosen_id || Auth::user()->id == $logbook->bimbingan->dosen2_id)) {
            return view('dosen.history.detailLogbook', ['title' => 'history', 'logbook' => $logbook]);
        }
        abort(404);
    }
}
