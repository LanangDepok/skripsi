<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Konten;
use App\Models\Logbook;
use App\Models\PengajuanRevisi;
use App\Models\PengajuanSempro;
use App\Models\PengajuanSkripsi;
use App\Models\User;
use App\Services\DosenService;
use Carbon\Carbon;
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
        if (Gate::forUser(Auth::user())->allows('dosen_pembimbing')) {
            if (Auth::user()->dosen->tanda_tangan == null) {
                return redirect('/dosen/profile')->with('messages', 'Silahkan isi tanda tangan terlebih dahulu.');
            }
            $bimbingan = Auth::user()->bimbinganDosen;
            return view('dosen.bimbingan.logbook.index', ['title' => 'bimbingan', 'bimbingan' => $bimbingan]);
        }
        abort(404);
    }

    public function getLogbook(Logbook $logbook)
    {
        if (Gate::forUser(Auth::user())->allows('dosen_pembimbing')) {
            return view('dosen.bimbingan.logbook.detailLogbook', ['title' => 'bimbingan', 'logbook' => $logbook]);
        }
        abort(404);
    }

    public function acceptLogbook(Request $request, Logbook $logbook)
    {
        if (Gate::forUser(Auth::user())->allows('dosen_pembimbing')) {
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
        if (Gate::forUser(Auth::user())->allows('dosen_pembimbing')) {
            return view('dosen.bimbingan.persetujuanSidang.index', ['title' => 'bimbingan']);
        }
        abort(404);
    }

    public function getPersetujuanSempro(PengajuanSempro $pengajuanSempro)
    {
        if (Gate::forUser(Auth::user())->allows('dosen_pembimbing')) {
            return view('dosen.bimbingan.persetujuanSidang.detailPersetujuanSempro', ['title' => 'bimbingan', 'pengajuanSempro' => $pengajuanSempro]);
        }
        abort(404);
    }

    public function acceptPersetujuanSidangSempro(Request $request, PengajuanSempro $pengajuanSempro)
    {
        if (Gate::forUser(Auth::user())->allows('dosen_pembimbing')) {
            if (isset($request->terima)) {
                $tanggal = Carbon::now()->translatedFormat('d F Y');

                $pengajuanSempro->update([
                    'status' => 'Menunggu pembagian jadwal',
                    'acc_dospem' => $tanggal,
                ]);
                return redirect('/dosen/bimbingan/persetujuanSidang');
            } else {
                $pengajuanSempro->update(['status' => 'Ditolak']);
                return redirect('/dosen/bimbingan/persetujuanSidang');
            }
        }
        abort(404);
    }
    public function getPersetujuanSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::forUser(Auth::user())->allows('dosen_pembimbing')) {
            return view('dosen.bimbingan.persetujuanSidang.detailPersetujuanSkripsi', ['title' => 'bimbingan', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function acceptPersetujuanSidangSkripsi(Request $request, PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::forUser(Auth::user())->allows('dosen_pembimbing')) {
            if (isset($request->terima)) {
                $tanggal = Carbon::now()->translatedFormat('d F Y');

                $pengajuanSkripsi->update([
                    'status' => 'Menunggu pembagian jadwal',
                    'acc_dospem' => $tanggal,
                ]);
                return redirect('/dosen/bimbingan/persetujuanSidang');
            } else {
                $pengajuanSkripsi->update(['status' => 'Ditolak']);
                return redirect('/dosen/bimbingan/persetujuanSidang');
            }
        }
        abort(404);
    }

    //listMahasiswa
    public function getAllListMahasiswa()
    {
        if (Gate::forUser(Auth::user())->allows('dosen_pembimbing')) {
            return view('dosen.bimbingan.ListMahasiswa.index', ['title' => 'bimbingan']);
        }
        abort(404);
    }

    public function getListMahasiswa(Bimbingan $bimbingan)
    {
        if (Gate::forUser(Auth::user())->allows('dosen_pembimbing')) {
            return view('dosen.bimbingan.ListMahasiswa.detailMahasiswa', ['title' => 'bimbingan', 'bimbingan' => $bimbingan]);
        }
        abort(404);
    }


    //profile
    public function getProfile()
    {
        if (Gate::forUser(Auth::user())->any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
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
    public function getAllPengujianSempro(Request $request)
    {
        if (Gate::forUser(Auth::user())->any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            if (Auth::user()->dosen->tanda_tangan == null) {
                return redirect('/dosen/profile')->with('messages', 'Silahkan isi tanda tangan terlebih dahulu.');
            }

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
                    $query->where('prodi', 'like', '%' . $cari_prodi . '%');
                });
            }
            if ($request->filled('cari_bimbingan')) {
                $cari_bimbingan = $request->input('cari_bimbingan');
                if ($cari_bimbingan === 'mahasiswa_bimbingan') {
                    $query->where('dospem_id', '=', Auth::user()->id);
                } elseif ($cari_bimbingan === 'mahasiswa_teruji') {
                    $query->where('dospem_id', '!=', Auth::user()->id);
                }
            }

            $data = $query->paginate(30);

            return view('dosen.pengujian.sempro.index', [
                'title' => 'pengujian',
                'data' => $data,
            ]);
        }
        abort(404);
    }

    public function getPengujianSempro(PengajuanSempro $pengajuanSempro)
    {
        if (Gate::forUser(Auth::user())->any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            return view('dosen.pengujian.sempro.detail', ['title' => 'pengujian', 'pengajuanSempro' => $pengajuanSempro]);
        }
        abort(404);
    }

    public function penilaianSempro(PengajuanSempro $pengajuanSempro)
    {
        if (Gate::forUser(Auth::user())->allows('ketua_penguji')) {
            return view('dosen.pengujian.sempro.penilaian', ['title' => 'pengujian', 'pengajuanSempro' => $pengajuanSempro]);
        }
        abort(404);
    }

    public function nilaiSempro(Request $request, PengajuanSempro $pengajuanSempro)
    {
        if (Gate::forUser(Auth::user())->allows('ketua_penguji')) {
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
            // $data = $validator->safe()->only(['nilai', 'keterangan']);

            if ($validator['nilai'] >= 400) {
                $validator['status'] = 'Lulus';
                $pengajuanSempro->update($validator);
            } else {
                $validator['status'] = 'Tidak lulus';
                $pengajuanSempro->update($validator);
            }

            $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->update(['status' => 'Bimbingan Skripsi']);

            return redirect('/dosen/pengujian/sempro');
        }
        abort(404);
    }

    //pengujian skripsi
    public function getAllPengujianSkripsi(Request $request)
    {
        if (Gate::forUser(Auth::user())->any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            if (Auth::user()->dosen->tanda_tangan == null) {
                return redirect('/dosen/profile')->with('messages', 'Silahkan isi tanda tangan terlebih dahulu.');
            }

            $query = PengajuanSkripsi::where(function ($query) {
                $query->where('penguji1_id', Auth::user()->id)
                    ->orWhere('penguji2_id', Auth::user()->id)
                    ->orWhere('penguji3_id', Auth::user()->id)
                    ->orWhere('dospem_id', Auth::user()->id);
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
                    $query->where('prodi', 'like', '%' . $cari_prodi . '%');
                });
            }
            if ($request->filled('cari_bimbingan')) {
                $cari_bimbingan = $request->input('cari_bimbingan');
                if ($cari_bimbingan === 'mahasiswa_bimbingan') {
                    $query->where('dospem_id', '=', Auth::user()->id);
                } elseif ($cari_bimbingan === 'mahasiswa_teruji') {
                    $query->where('dospem_id', '!=', Auth::user()->id);
                }
            }

            $data = $query->paginate(30);

            return view('dosen.pengujian.skripsi.index', [
                'title' => 'pengujian',
                'data' => $data,
            ]);
        }
        abort(404);
    }

    public function getPengujianSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::forUser(Auth::user())->any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            return view('dosen.pengujian.skripsi.detail', ['title' => 'pengujian', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(403);
    }

    public function penilaianSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::forUser(Auth::user())->any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
            return view('dosen.pengujian.skripsi.penilaian', ['title' => 'pengujian', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(403);
    }

    public function nilaiSkripsi(Request $request, PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::forUser(Auth::user())->any(['ketua_penguji', 'dosen_penguji'])) {
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

            if (Auth::user()->id == $pengajuanSkripsi->penguji1_id) {
                $pengajuanSkripsi->update([
                    'nilai1' => $validated['total_nilai'],
                    'status' => 'Menunggu penilaian',
                    '1a1' => $validated['a1'],
                    '1a2' => $validated['a2'],
                    '1a3' => $validated['a3'],
                    '1b1' => $validated['b1'],
                    '1b2' => $validated['b2'],
                    '1b3' => $validated['b3'],
                    '1b4' => $validated['b4'],
                    '1b5' => $validated['b5'],
                ]);
                return redirect('/dosen/pengujian/skripsi');
            } elseif (Auth::user()->id == $pengajuanSkripsi->penguji2_id) {
                $pengajuanSkripsi->update([
                    'nilai2' => $validated['total_nilai'],
                    'status' => 'Menunggu penilaian',
                    '2a1' => $validated['a1'],
                    '2a2' => $validated['a2'],
                    '2a3' => $validated['a3'],
                    '2b1' => $validated['b1'],
                    '2b2' => $validated['b2'],
                    '2b3' => $validated['b3'],
                    '2b4' => $validated['b4'],
                    '2b5' => $validated['b5'],
                ]);
                return redirect('/dosen/pengujian/skripsi');
            } elseif (Auth::user()->id == $pengajuanSkripsi->penguji3_id) {
                $pengajuanSkripsi->update([
                    'nilai3' => $validated['total_nilai'],
                    'status' => 'Menunggu penilaian',
                    '3a1' => $validated['a1'],
                    '3a2' => $validated['a2'],
                    '3a3' => $validated['a3'],
                    '3b1' => $validated['b1'],
                    '3b2' => $validated['b2'],
                    '3b3' => $validated['b3'],
                    '3b4' => $validated['b4'],
                    '3b5' => $validated['b5'],
                ]);
                return redirect('/dosen/pengujian/skripsi');
            }
        } elseif (Gate::forUser(Auth::user())->allows('dosen_pembimbing')) {
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

            $pengajuanSkripsi->update([
                'nilai_pembimbing' => $request->total_nilai,
                'status' => 'Menunggu penilaian',
                '4a1' => $validated['a1'],
                '4a2' => $validated['a2'],
                '4a3' => $validated['a3'],
                '4b1' => $validated['b1'],
                '4b2' => $validated['b2'],
                '4b3' => $validated['b3'],
                '4b4' => $validated['b4'],
                '4c1' => $validated['c1'],
                '4c2' => $validated['c2'],
                '4c3' => $validated['c3'],
                '4c4' => $validated['c4'],
            ]);

            return redirect('/dosen/pengujian/skripsi');
        } else {
            abort(404);
        }
    }

    public function penilaianTerbimbing(PengajuanSkripsi $pengajuanSkripsi)
    {
        return view('dosen.pengujian.terbimbing.penilaian', ['title' => 'pengujian', 'pengajuanSkripsi' => $pengajuanSkripsi]);
    }


    //rekapitulasi nilai
    public function getAllRekapitulasi()
    {
        if (Gate::forUser(Auth::user())->allows('ketua_penguji')) {
            $pengajuanSkripsi = PengajuanSkripsi::where('penguji1_id', '=', Auth::user()->id)
                ->where('status', '=', 'Menunggu penilaian')->where('nilai_total', '=', null)->get();
            return view('dosen.rekapitulasi.index', ['title' => 'rekapitulasi', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }

    public function getRekapitulasi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::forUser(Auth::user())->allows('ketua_penguji')) {
            return view('dosen.rekapitulasi.detail', ['title' => 'rekapitulasi', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }

    public function rekapNilai(Request $request, PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::forUser(Auth::user())->allows('ketua_penguji')) {
            $data = $request->all();
            $rules = [
                'nilai_pembimbing' => 'required',
                'nilai1' => 'required',
                'nilai2' => 'required',
                'nilai3' => 'required',
                'nilai_total' => 'required',
            ];
            $messages = ['required' => 'Nilai tidak boleh kosong'];
            $validated = Validator::make($data, $rules, $messages)->validate();
            $validated['status'] = 'Menunggu kelulusan';

            $pengajuanSkripsi->update($validated);

            return redirect('/dosen/kelulusan');
        }
        abort(404);
    }

    //kelulusan
    public function getAllKelulusan()
    {
        if (Gate::forUser(Auth::user())->allows('ketua_penguji')) {
            $pengajuanSkripsi = PengajuanSkripsi::where('penguji1_id', '=', Auth::user()->id)->where('status', '=', 'Menunggu kelulusan')->get();
            return view('dosen.kelulusan.index', ['title' => 'kelulusan', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }

    public function getKelulusan(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::forUser(Auth::user())->allows('ketua_penguji')) {
            return view('dosen.kelulusan.detail', ['title' => 'kelulusan', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }

    public function luluskanSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::forUser(Auth::user())->allows('ketua_penguji')) {
            $pengajuanSkripsi->update(['status' => 'Lulus']);
            $pengajuanSkripsi->pengajuanSkripsiMahasiswa->skripsi->update(['status' => 'Lulus']);

            return redirect('/dosen/kelulusan');
        }
        abort(404);
    }
    public function tolakSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::forUser(Auth::user())->allows('ketua_penguji')) {
            $pengajuanSkripsi->update(['status' => 'Tidak lulus']);

            return redirect('/dosen/kelulusan');
        }
        abort(404);
    }

    public function revisiSkripsi(Request $request, PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::forUser(Auth::user())->allows('ketua_penguji')) {
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

            $validated['pengajuan_skripsi_id'] = $pengajuanSkripsi->id;
            $validated['status'] = 'Revisi';

            $deadline_timestamp = Carbon::now()->addDays(10)->translatedFormat('d F Y');
            $validated['deadline'] = $deadline_timestamp;

            PengajuanRevisi::create($validated);

            $pengajuanSkripsi->update(['status' => 'Revisi']);
            $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->update(['status' => 'Revisi']);

            return redirect('/dosen/kelulusan');
        }
        abort(404);
    }

    //pengajuan revisi
    public function getAllRevisi()
    {
        if (Gate::forUser(Auth::user())->any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing'])) {
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
            return view('dosen.revisi.index', [
                'title' => 'revisi',
                'terima_penguji1' => $terima_penguji1,
                'terima_penguji2' => $terima_penguji2,
                'terima_penguji3' => $terima_penguji3,
                'terima_pembimbing' => $terima_pembimbing,
            ]);
        }
        abort(404);
    }

    public function getRevisi(PengajuanRevisi $pengajuanRevisi)
    {
        if (Gate::forUser(Auth::user())->any(['ketua_penguji', 'dosen_penguji', 'dosen_pembimbing', 'komite'])) {
            return view('dosen.revisi.detail', ['title' => 'revisi', 'pengajuanRevisi' => $pengajuanRevisi]);
        }
        abort(404);
    }

    public function keputusanRevisi(Request $request, PengajuanRevisi $pengajuanRevisi)
    {
        if (isset($request->terima)) {
            if (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji1_id) {
                $pengajuanRevisi->update([
                    'terima_penguji1' => 'Ya',
                    'keterangan_penguji1' => 'Diterima'
                ]);
            } elseif (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji2_id) {
                $pengajuanRevisi->update([
                    'terima_penguji2' => 'Ya',
                    'keterangan_penguji2' => 'Diterima'
                ]);
            } else if (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji3_id) {
                $pengajuanRevisi->update([
                    'terima_penguji3' => 'Ya',
                    'keterangan_penguji3' => 'Diterima'
                ]);
            } else if (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->dospem_id) {
                $pengajuanRevisi->update([
                    'terima_pembimbing' => 'Ya',
                    'keterangan_pembimbing' => 'Diterima'
                ]);
            }
            return redirect('/dosen/revisi');
        } else {
            $data = $request->all();
            $rules = ['keterangan_revisi' => 'required'];
            $messages = ['required' => 'Jika melakukan revisi ulang, silahkan mengisi keterangan revisi terlebih dahulu.'];
            Validator::make($data, $rules, $messages)->validate();
            if (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji1_id) {
                $pengajuanRevisi->update([
                    'keterangan_penguji1' => $request->keterangan_revisi,
                    'terima_penguji1' => 'Tidak'
                ]);
            } elseif (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji2_id) {
                $pengajuanRevisi->update([
                    'keterangan_penguji2' => $request->keterangan_revisi,
                    'terima_penguji2' => 'Tidak'
                ]);
            } else if (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->penguji3_id) {
                $pengajuanRevisi->update([
                    'keterangan_penguji3' => $request->keterangan_revisi,
                    'terima_penguji3' => 'Tidak'
                ]);
            } else if (Auth::user()->id == $pengajuanRevisi->pengajuanSkripsi->dospem_id) {
                $pengajuanRevisi->update([
                    'keterangan_pembimbing' => $request->keterangan_revisi,
                    'terima_pembimbing' => 'Tidak'
                ]);
            }
            return redirect('/dosen/revisi');
        }
    }
}
