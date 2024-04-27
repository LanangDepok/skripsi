<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Konten;
use App\Models\Mahasiswa;
use App\Models\PengajuanJudul;
use App\Models\PengajuanRevisi;
use App\Models\PengajuanSempro;
use App\Models\PengajuanSkripsi;
use App\Models\Role;
use App\Models\User;
use App\Services\AdminService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct(protected AdminService $adminService)
    {
    }

    //konten
    public function index()
    {
        if (Gate::any(['admin', 'komite'])) {
            $konten = Konten::get();
            return view('admin.index', ['title' => 'index', 'konten' => $konten]);
        }
        abort(404);
    }

    public function updateKonten(Request $request)
    {
        if (Gate::any(['admin', 'komite'])) {
            $konten = new Konten;
            $timeline_skripsi = $request->timeline_skripsi;
            $alur_skripsi = $request->alur_skripsi;

            $this->adminService->updateKonten($konten, $timeline_skripsi, $alur_skripsi);

            return back();
        }
        abort(404);
    }

    // mahasiswa
    public function getStudents()
    {
        if (Gate::any(['admin', 'komite'])) {
            $data = Mahasiswa::get();
            return view('admin.mahasiswa.index', ['title' => 'mahasiswa', 'data' => $data]);
        }
        abort(404);
    }

    public function getStudent(Mahasiswa $mahasiswa)
    {
        if (Gate::any(['admin', 'komite'])) {
            return view('admin.mahasiswa.detailMahasiswa', ['title' => 'mahasiswa', 'mahasiswa' => $mahasiswa]);
        }
        abort(404);
    }

    public function createStudent()
    {
        if (Gate::allows('admin')) {
            return view('admin.mahasiswa.createMahasiswa', ['title' => 'mahasiswa']);
        }
        abort(404);
    }
    public function storeStudent(Request $request)
    {
        if (Gate::allows('admin')) {
            $user = new User;
            $mahasiswa = new Mahasiswa;

            $data = $request->all();
            $rules = [
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'nama' => 'required',
                'nim' => 'required|integer|unique:mahasiswas,nim',
                'kelas' => 'required',
                'prodi' => 'required',
                'tahun_ajaran' => 'required',
                'status' => 'required'
            ];
            $messages = [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute sudah tersedia.',
                'email' => ':attribute tidak valid.',
                'integer' => ':attribute harus berupa angka.'
            ];
            $validator = Validator::make($data, $rules, $messages);
            $validated_user = $validator->safe()->only(['email', 'password', 'nama']);
            $validated_mahasiswa = $validator->safe()->only(['nim', 'kelas', 'prodi', 'tahun_ajaran', 'status']);

            $this->adminService->storeStudent($validated_user, $validated_mahasiswa, $user, $mahasiswa);

            return redirect('/admin/mahasiswa/create')->with('success', 'Data berhasil ditambahkan.');
        }
        abort(404);
    }

    public function editStudent(Mahasiswa $mahasiswa)
    {
        if (Gate::allows('admin')) {
            return view('admin.mahasiswa.editMahasiswa', ['title' => 'mahasiswa', 'mahasiswa' => $mahasiswa]);
        }
        abort(404);
    }

    public function updateStudent(Request $request, Mahasiswa $mahasiswa)
    {
        if (Gate::allows('admin')) {
            $user = $mahasiswa->user;

            $data = $request->all();
            $rules = [
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user)],
                'nama' => 'required',
                'nim' => ['required', 'integer', Rule::unique('mahasiswas', 'nim')->ignore($mahasiswa)],
                'kelas' => 'required',
                'prodi' => 'required',
                'tahun_ajaran' => 'required',
            ];
            $messages = [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute sudah tersedia.',
                'email' => ':attribute tidak valid.',
                'integer' => ':attribute harus berupa angka.'
            ];

            if ($request->password) {
                $rules['password'] = 'required';
                $validator = Validator::make($data, $rules, $messages);
                $validated_user = $validator->safe()->only(['email', 'password', 'nama']);
            } else {
                $validator = Validator::make($data, $rules, $messages);
                $validated_user = $validator->safe()->only(['email', 'nama']);
            }

            $validated_mahasiswa = $validator->safe()->only(['nim', 'kelas', 'prodi', 'tahun_ajaran']);

            $this->adminService->updateStudent($validated_user, $validated_mahasiswa, $user, $mahasiswa);

            return redirect('/admin/mahasiswa')->with('success', 'Data berhasil diubah.');
        }
        abort(404);
    }

    public function deleteStudent(Mahasiswa $mahasiswa)
    {
        if (Gate::allows('admin')) {
            $mahasiswa->delete();

            return redirect('/admin/mahasiswa')->with('success', 'Data berhasil dihapus.');
        }
        abort(404);
    }

    // dosen
    public function getLecturers()
    {
        if (Gate::any(['admin', 'komite'])) {
            $data = Dosen::get();

            return view('admin.dosen.index', ['title' => 'dosen', 'data' => $data]);
        }
        abort(404);
    }

    public function getLecturer(Dosen $dosen)
    {
        if (Gate::any(['admin', 'komite'])) {
            return view('admin.dosen.detailDosen', ['title' => 'dosen', 'dosen' => $dosen]);
        }
        abort(404);
    }

    public function createLecturer()
    {
        if (Gate::allows('admin')) {
            return view('admin.dosen.createDosen', ['title' => 'dosen']);
        }
        abort(404);
    }

    public function storeLecturer(Request $request)
    {
        if (Gate::allows('admin')) {
            $user = new User;
            $dosen = new Dosen;

            $data = $request->all();
            $rules = [
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'nama' => 'required',
                'nip' => 'required|integer|unique:dosens,nip',
                'jabatan' => 'required',
                'fungsional' => 'required',
                'gol_pangkat' => 'required',
                'role' => 'required',
            ];
            $messages = [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute sudah tersedia.',
                'email' => ':attribute tidak valid.',
                'integer' => ':attribute harus berupa angka.'
            ];

            $validator = Validator::make($data, $rules, $messages);
            $validated_user = $validator->safe()->only(['email', 'password', 'nama']);
            $validated_dosen = $validator->safe()->only(['nip', 'jabatan', 'fungsional', 'gol_pangkat', 'role']);
            $validated_role = $validator->safe()->only(['role']);

            $this->adminService->storeLecturer($validated_user, $validated_dosen, $validated_role, $user, $dosen);

            return redirect('/admin/dosen/create')->with('success', 'Data berhasil ditambahkan.');
        }
        abort(404);
    }

    public function editLecturer(Dosen $dosen)
    {
        if (Gate::allows('admin')) {
            return view('admin.dosen.editDosen', ['title' => 'dosen', 'dosen' => $dosen]);
        }
        abort(404);
    }

    public function updateLecturer(Request $request, Dosen $dosen)
    {
        if (Gate::allows('admin')) {
            $data = $request->all();
            $rules = [
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($dosen->user)],
                'nama' => 'required',
                'nip' => ['required', 'integer', Rule::unique('dosens', 'nip')->ignore($dosen)],
                'jabatan' => 'required',
                'fungsional' => 'required',
                'gol_pangkat' => 'required',
                'role' => 'required',
            ];
            $messages = [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute sudah tersedia.',
                'email' => ':attribute tidak valid.',
                'integer' => ':attribute harus berupa angka.'
            ];

            if ($request->password) {
                $rules['password'] = 'required';
                $validator = Validator::make($data, $rules, $messages);
                $validated_user = $validator->safe()->only(['email', 'password', 'nama']);
            } else {
                $validator = Validator::make($data, $rules, $messages);
                $validated_user = $validator->safe()->only(['email', 'nama']);
            }

            $validated_dosen = $validator->safe()->only(['nip', 'jabatan', 'fungsional', 'gol_pangkat']);
            $validated_role = $validator->safe()->only(['role']);

            $this->adminService->updateLecturer($validated_user, $validated_dosen, $validated_role, $dosen);

            return redirect('/admin/dosen')->with('success', 'Data berhasil diubah.');
        }
        abort(404);
    }

    public function deleteLecturer(Dosen $dosen)
    {
        if (Gate::allows('admin')) {
            $dosen->delete();
            $dosen->user->roles()->detach();

            return redirect('/admin/dosen')->with('success', 'Data berhasil dihapus.');
        }
        abort(404);
    }

    //pengajuan judul
    public function pengajuanJudul()
    {
        if (Gate::any(['admin', 'komite'])) {
            $pengajuanJudul = PengajuanJudul::where('status', '=', 'menunggu')->get();
            // $pengajuanJudul = PengajuanJudul::get();

            return view('admin.pengajuan.judul.index', ['title' => 'pengajuan', 'pengajuanJudul' => $pengajuanJudul]);
        }
        abort(404);
    }

    public function terimaPengajuanJudul(Request $request, PengajuanJudul $pengajuanJudul)
    {
        if (Gate::any(['admin', 'komite'])) {
            if ($request->input('action') == 'terima') {
                $dosen_pembimbing = $request->dosen_pembimbing;
                $pengajuanJudul->update([
                    'dosen_terpilih' => $dosen_pembimbing,
                    'status' => 'diterima'
                ]);

                $pengajuanJudul->user->mahasiswa->update([
                    'status' => 'Bimbingan sempro'
                ]);

                $user_dosen = User::where('nama', '=', $dosen_pembimbing)->first();
                Bimbingan::create([
                    'dosen_id' => $user_dosen->id,
                    'mahasiswa_id' => $pengajuanJudul->user->id,
                ]);
            }
            if ($request->input('action') == 'tolak') {
                $pengajuanJudul->update([
                    'status' => 'ditolak'
                ]);
            }

            return redirect('/admin/pengajuan/judul');
        }
        abort(404);
    }

    public function getPengajuanJudul(PengajuanJudul $pengajuanJudul)
    {
        if (Gate::any(['admin', 'komite'])) {
            $role = Role::get();
            $dosen_pembimbing = $role[4]->users;

            return view('admin.pengajuan.judul.detailPengajuan', ['title' => 'pengajuan', 'pengajuanJudul' => $pengajuanJudul, 'dosenPembimbing' => $dosen_pembimbing]);
        }
        abort(404);
    }

    //pengajuan sempro
    public function pengajuanSempro()
    {
        if (Gate::any(['admin', 'komite'])) {
            $pengajuanSempro = PengajuanSempro::get();
            return view('admin.pengajuan.sempro.index', ['title' => 'pengajuan', 'pengajuanSempro' => $pengajuanSempro]);
        }
        abort(404);
    }

    public function getPengajuanSempro(PengajuanSempro $pengajuanSempro)
    {
        if (Gate::any(['admin', 'komite'])) {
            $role_ketua = Role::with('users')->find(3);
            $role_penguji = Role::with('users')->find(4);
            return view('admin.pengajuan.sempro.detailPengajuan', ['title' => 'pengajuan', 'pengajuanSempro' => $pengajuanSempro, 'role_ketua' => $role_ketua, 'role_penguji' => $role_penguji]);
        }
        abort(404);
    }

    public function terimaPengajuanSempro(Request $request, PengajuanSempro $pengajuanSempro)
    {
        if (Gate::any(['admin', 'komite'])) {
            if (isset($request->terima)) {
                $data = $request->all();
                $rules = [
                    'penguji1_id' => 'required|different:penguji2_id,penguji3_id',
                    'penguji2_id' => 'required|different:penguji1_id,penguji3_id',
                    'penguji3_id' => 'required|different:penguji2_id,penguji1_id',
                    'tanggal' => 'required'
                ];
                $messages = [
                    'required' => 'Silahkan pilih :attribute terlebih dahulu.',
                    'different' => 'Pilihan penguji tidak boleh sama.'
                ];
                $validator = Validator::make($data, $rules, $messages)->validate();
                $tanggal = Carbon::createFromFormat('Y-m-d', $validator['tanggal']);
                $validator['tanggal'] = $tanggal->format('d F Y');
                $validator['status'] = 'Menunggu sidang';

                $pengajuanSempro->update($validator);
                $pengajuanSempro->pengajuanSemproMahasiswa->mahasiswa->update(['status' => 'Sidang Sempro']);
                return redirect('/admin/pengajuan/sempro');
            } else {
                $pengajuanSempro->update(['status' => 'Ditolak']);
                return redirect('/admin/pengajuan/sempro');
            }
        }
        abort(404);
    }

    //pengajuan skripsi
    public function pengajuanSkripsi()
    {
        if (Gate::any(['admin', 'komite'])) {
            $pengajuanSkripsi = PengajuanSkripsi::get();
            return view('admin.pengajuan.skripsi.index', ['title' => 'pengajuan', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function getPengajuanSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::any(['admin', 'komite'])) {
            $role_ketua = Role::with('users')->find(3);
            $role_penguji = Role::with('users')->find(4);
            return view('admin.pengajuan.skripsi.detailPengajuan', ['title' => 'pengajuan', 'pengajuanSkripsi' => $pengajuanSkripsi, 'role_ketua' => $role_ketua, 'role_penguji' => $role_penguji]);
        }
        abort(404);
    }
    public function terimaPengajuanSkripsi(Request $request, PengajuanSkripsi $pengajuanSkripsi)
    {
        // dd($request->all());
        if (Gate::any(['admin', 'komite'])) {
            if (isset($request->terima)) {
                $data = $request->all();
                $rules = [
                    'penguji1_id' => 'required|different:penguji2_id,penguji3_id',
                    'penguji2_id' => 'required|different:penguji1_id,penguji3_id',
                    'penguji3_id' => 'required|different:penguji2_id,penguji1_id',
                    'tanggal' => 'required'
                ];
                $messages = [
                    'required' => 'Silahkan pilih :attribute terlebih dahulu.',
                    'different' => 'Pilihan penguji tidak boleh sama.'
                ];
                $validator = Validator::make($data, $rules, $messages)->validate();
                $tanggal = Carbon::createFromFormat('Y-m-d', $validator['tanggal']);
                $validator['tanggal'] = $tanggal->format('d F Y');
                $validator['status'] = 'Menunggu sidang';

                $pengajuanSkripsi->update($validator);
                $pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->update(['status' => 'Sidang Skripsi']);
                return redirect('/admin/pengajuan/skripsi');
            } else {
                $pengajuanSkripsi->update(['status' => 'Ditolak']);
                return redirect('/admin/pengajuan/skripsi');
            }
        }
        abort(404);
    }

    //pengajuan alat
    public function getAllPengajuanAlat()
    {
        if (Gate::any(['admin', 'komite'])) {
            return view('admin.pengajuan.alat.index', ['title' => 'pengajuan']);
        }
        abort(404);
    }

    public function getPengajuanAlat()
    {
        if (Gate::any(['admin', 'komite'])) {
            return view('admin.pengajuan.alat.detail', ['title' => 'pengajuan']);
        }
        abort(404);
    }

    //skripsi
    public function getSkripsian()
    {
        if (Gate::any(['admin', 'komite'])) {
            $sempro = PengajuanSempro::get();
            $skripsi = PengajuanSkripsi::get();
            return view('admin.skripsi.index', ['title' => 'skripsi', 'sempro' => $sempro, 'skripsi' => $skripsi]);
        }
        abort(404);
    }

    //revisi
    public function getAllRevisi()
    {
        if (Gate::any(['admin', 'komite'])) {
            $pengajuanRevisi = PengajuanRevisi::where('terima_penguji1', '!=', null)
                ->where('terima_penguji2', '!=', null)
                ->where('terima_penguji3', '!=', null)
                ->where('terima_pembimbing', '!=', null)
                ->get();
            return view('admin.revisi.index', ['title' => 'revisi', 'pengajuanRevisi' => $pengajuanRevisi]);
        }
        abort(404);
    }

    public function getRevisi(PengajuanRevisi $pengajuanRevisi)
    {
        if (Gate::any(['admin', 'komite'])) {
            return view('admin.revisi.detail', ['title' => 'revisi', 'pengajuanRevisi' => $pengajuanRevisi]);
        }
        abort(404);
    }

    public function keputusanRevisi(Request $request, PengajuanRevisi $pengajuanRevisi)
    {
        if (Gate::any(['admin', 'komite'])) {
            if (isset($request->tolak)) {
                $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Ditolak']);
                $pengajuanRevisi->update(['status' => 'Tidak lulus']);
                $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->update(['status' => 'Bimbingan Skripsi']);

                return redirect('/admin/revisi');
            } elseif (isset($request->revisi)) {
                if ($pengajuanRevisi->terima_penguji1 == 'Tidak') {
                    $pengajuanRevisi->update([
                        'terima_penguji1' => null,
                        'status' => 'Revisi'
                    ]);
                    $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Revisi']);

                    return redirect('/admin/revisi');
                }
                if ($pengajuanRevisi->terima_penguji2 == 'Tidak') {
                    $pengajuanRevisi->update([
                        'terima_penguji2' => null,
                        'status' => 'Revisi'
                    ]);
                    $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Revisi']);

                    return redirect('/admin/revisi');
                }
                if ($pengajuanRevisi->terima_penguji3 == 'Tidak') {
                    $pengajuanRevisi->update([
                        'terima_penguji3' => null,
                        'status' => 'Revisi'
                    ]);
                    $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Revisi']);

                    return redirect('/admin/revisi');
                }
                if ($pengajuanRevisi->terima_pembimbing == 'Tidak') {
                    $pengajuanRevisi->update([
                        'terima_pembimbing' => null,
                        'status' => 'Revisi'
                    ]);
                    $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Revisi']);

                    return redirect('/admin/revisi');
                }
            } elseif (isset($request->terima)) {
                $pengajuanRevisi->update([
                    'status' => 'Diterima',
                    'ttd_komite' => Auth::user()->dosen->tanda_tangan
                ]);
                $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Lulus']);
                $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->update(['status' => 'Serah terima alat']);

                return redirect('/admin/revisi');
            }
        }
        abort(404);
    }
}
