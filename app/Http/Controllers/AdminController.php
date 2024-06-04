<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Konten;
use App\Models\Mahasiswa;
use App\Models\PengajuanAlat;
use App\Models\PengajuanJudul;
use App\Models\PengajuanRevisi;
use App\Models\PengajuanSempro;
use App\Models\PengajuanSkripsi;
use App\Models\Role;
use App\Models\User;
use App\Services\AdminService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AdminController extends Controller
{
    public function __construct(protected AdminService $adminService)
    {
    }

    //konten
    public function index()
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            $konten = Konten::get();
            return view('admin.index', ['title' => 'index', 'konten' => $konten]);
        }
        abort(404);
    }

    //profile
    public function getProfile()
    {
        if (Gate::forUser(Auth::user())->any(['komite', 'ketua_komite'])) {
            return view('admin.profile.index', ['title' => 'profile']);
        }
        abort(404);
    }

    public function updateProfile(Request $request, User $user)
    {
        if (Gate::forUser($user)->any(['komite', 'ketua_komite'])) {
            $photo_profil = $request->photo_profil;
            $tanda_tangan = $request->tanda_tangan;

            $this->adminService->updateProfile($user, $photo_profil, $tanda_tangan);

            return back();
        }
        abort(404);
    }

    public function updateKonten(Request $request)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            $konten = new Konten;

            $data = $request->all();
            $rules = [
                'timeline_skripsi' => 'nullable|mimes:jpg,jpeg,png',
                'alur_skripsi' => 'nullable|mimes:jpg,jpeg,png',
            ];
            $messages = [
                'mimes' => ':attribute harus berupa gambar dengan format (jpg, jpeg, png).',
            ];
            $validator = Validator::make($data, $rules, $messages)->validate();

            if ($request->timeline_skripsi) {
                $timeline_skripsi = $validator['timeline_skripsi'];
            } else {
                $timeline_skripsi = null;
            }

            if ($request->alur_skripsi) {
                $alur_skripsi = $validator['alur_skripsi'];
            } else {
                $alur_skripsi = null;
            }

            $this->adminService->updateKonten($konten, $timeline_skripsi, $alur_skripsi);

            return redirect('/');
        }
        abort(404);
    }

    // mahasiswa
    public function getStudents(Request $request)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            $query = Mahasiswa::query();

            if ($request->filled('cari_nama')) {
                $cari_nama = $request->input('cari_nama');
                $query->whereHas('user', function ($query) use ($cari_nama) {
                    $query->where('nama', 'like', '%' . $cari_nama . '%');
                });
            }

            if ($request->filled('cari_prodi')) {
                $cari_prodi = $request->input('cari_prodi');
                $query->where('prodi', 'like', '%' . $cari_prodi . '%');
            }

            if ($request->filled('cari_status')) {
                $cari_status = $request->input('cari_status');
                $query->where('status', $cari_status);
            }

            $data = $query->paginate(30);

            return view('admin.mahasiswa.index', ['title' => 'mahasiswa', 'data' => $data]);
        }
        abort(404);
    }

    public function getStudent(Mahasiswa $mahasiswa)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            $bimbingan = Bimbingan::where('mahasiswa_id', '=', $mahasiswa->user_id)->first();
            return view('admin.mahasiswa.detailMahasiswa', ['title' => 'mahasiswa', 'mahasiswa' => $mahasiswa, 'bimbingan' => $bimbingan]);
        }
        abort(404);
    }

    public function createStudent()
    {
        if (Gate::forUser(Auth::user())->allows('admin')) {
            return view('admin.mahasiswa.createMahasiswa', ['title' => 'mahasiswa']);
        }
        abort(404);
    }
    public function storeStudent(Request $request)
    {
        if (Gate::forUser(Auth::user())->allows('admin')) {
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

    public function storeStudentExcel(Request $request)
    {
        if (Gate::forUser(Auth::user())->allows('admin')) {
            if ($request->file('excel')) {
                $file = $request->file('excel');
                $path = $file->getRealPath();
                $extension = $file->getClientOriginalExtension();

                $reader = IOFactory::createReader(ucfirst($extension));
                $spreadsheet = $reader->load($path);

                DB::beginTransaction();

                foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();

                    for ($row = 2; $row <= $highestRow; $row++) {
                        $email = $worksheet->getCell('A' . $row)->getValue();
                        $password = $worksheet->getCell('B' . $row)->getValue();
                        $nama = $worksheet->getCell('C' . $row)->getValue();
                        $nim = $worksheet->getCell('D' . $row)->getValue();
                        $kelas = $worksheet->getCell('E' . $row)->getValue();
                        $prodi = $worksheet->getCell('F' . $row)->getValue();
                        $tahunAjaran = $worksheet->getCell('G' . $row)->getValue();

                        $data = [
                            'email' => $email,
                            'password' => $password,
                            'nama' => $nama,
                            'nim' => $nim,
                            'kelas' => $kelas,
                            'prodi' => $prodi,
                            'tahun_ajaran' => $tahunAjaran,
                        ];

                        $rules = [
                            'email' => 'required|email|unique:users,email',
                            'password' => 'required',
                            'nama' => 'required',
                            'nim' => 'required|integer|unique:mahasiswas,nim',
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

                        $validator = Validator::make($data, $rules, $messages);

                        if ($validator->fails()) {
                            DB::rollBack();
                            $errorMessage = 'Validasi data pada baris ' . $row . ': ' . $validator->errors()->first();
                            return redirect('/admin/mahasiswa/create')->with('error', $errorMessage);
                        }

                        $user = new User;
                        $user->email = $email;
                        $user->password = $password;
                        $user->nama = $nama;
                        $user->save();
                        $user->roles()->sync([6]);

                        $mahasiswa = new Mahasiswa;
                        $mahasiswa->nim = $nim;
                        $mahasiswa->kelas = $kelas;
                        $mahasiswa->prodi = $prodi;
                        $mahasiswa->tahun_ajaran = $tahunAjaran;
                        $mahasiswa->status = 'Belum mengajukan judul';
                        $mahasiswa->user_id = $user->id;
                        $mahasiswa->save();
                    }
                }
                DB::commit();
                return redirect('/admin/mahasiswa/create')->with('success', 'Data berhasil ditambahkan.');

            } else {
                return redirect('/admin/mahasiswa/create')->with('error', 'Pastikan sudah memasukkan file yang benar');
            }
        }
        abort(404);
    }

    public function editStudent(Mahasiswa $mahasiswa)
    {
        if (Gate::forUser(Auth::user())->allows('admin')) {
            return view('admin.mahasiswa.editMahasiswa', ['title' => 'mahasiswa', 'mahasiswa' => $mahasiswa]);
        }
        abort(404);
    }

    public function updateStudent(Request $request, Mahasiswa $mahasiswa)
    {
        if (Gate::forUser(Auth::user())->allows('admin')) {
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
        if (Gate::forUser(Auth::user())->allows('admin')) {
            $mahasiswa->delete();

            return redirect('/admin/mahasiswa')->with('success', 'Data berhasil dihapus.');
        }
        abort(404);
    }

    // dosen
    public function getLecturers(Request $request)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            $query = Dosen::query();

            if ($request->filled('cari_nama')) {
                $cari_nama = $request->input('cari_nama');
                $query->whereHas('user', function ($query) use ($cari_nama) {
                    $query->where('nama', 'like', '%' . $cari_nama . '%');
                });
            }
            if ($request->filled('cari_role')) {
                $cari_role = $request->input('cari_role');
                $query->whereHas('user.roles', function ($query) use ($cari_role) {
                    $query->where('nama', 'like', '%' . $cari_role . '%');
                });
            }

            $data = $query->paginate(30);

            return view('admin.dosen.index', ['title' => 'dosen', 'data' => $data]);
        }
        abort(404);
    }

    public function getLecturer(Dosen $dosen)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            return view('admin.dosen.detailDosen', ['title' => 'dosen', 'dosen' => $dosen]);
        }
        abort(404);
    }

    public function createLecturer()
    {
        if (Gate::forUser(Auth::user())->allows('admin')) {
            return view('admin.dosen.createDosen', ['title' => 'dosen']);
        }
        abort(404);
    }

    public function storeLecturer(Request $request)
    {
        if (Gate::forUser(Auth::user())->allows('admin')) {
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

            if (in_array(7, $validated_role['role'])) {
                $KetuaKomiteCheck = DB::table('role_user')->where('role_id', 7)->exists();
                if ($KetuaKomiteCheck) {
                    return redirect('/admin/dosen/create')->with(['error' => 'Role Ketua Komite sudah dimiliki oleh dosen lain.']);
                }
            }

            $this->adminService->storeLecturer($validated_user, $validated_dosen, $validated_role, $user, $dosen);

            return redirect('/admin/dosen/create')->with('success', 'Data berhasil ditambahkan.');
        }
        abort(404);
    }

    public function editLecturer(Dosen $dosen)
    {
        if (Gate::forUser(Auth::user())->allows('admin')) {
            return view('admin.dosen.editDosen', ['title' => 'dosen', 'dosen' => $dosen]);
        }
        abort(404);
    }

    public function updateLecturer(Request $request, Dosen $dosen)
    {
        if (Gate::forUser(Auth::user())->allows('admin')) {
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

            if (in_array(7, $validated_role['role'])) {
                $KetuaKomiteCheck = DB::table('role_user')->where('role_id', 7)->exists();
                if ($KetuaKomiteCheck) {
                    return redirect('/admin/dosen/' . $dosen->id . '/edit')->with(['error' => 'Role Ketua Komite sudah dimiliki oleh dosen lain.']);
                }
            }


            $this->adminService->updateLecturer($validated_user, $validated_dosen, $validated_role, $dosen);

            return redirect('/admin/dosen')->with('success', 'Data berhasil diubah.');
        }
        abort(404);
    }

    public function deleteLecturer(Dosen $dosen)
    {
        if (Gate::forUser(Auth::user())->allows('admin')) {
            $dosen->delete();
            $dosen->user->roles()->detach();

            return redirect('/admin/dosen')->with('success', 'Data berhasil dihapus.');
        }
        abort(404);
    }

    //pengajuan judul
    public function pengajuanJudul(Request $request)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            $query = PengajuanJudul::query()->where('status', '=', 'menunggu');

            if ($request->filled('cari_nama')) {
                $cari_nama = $request->input('cari_nama');
                $query->whereHas('user', function ($query) use ($cari_nama) {
                    $query->where('nama', 'like', '%' . $cari_nama . '%');
                });
            }
            if ($request->filled('cari_prodi')) {
                $cari_prodi = $request->input('cari_prodi');
                $query->whereHas('user.mahasiswa', function ($query) use ($cari_prodi) {
                    $query->where('prodi', 'like', '%' . $cari_prodi . '%');
                });
            }
            $pengajuanJudul = $query->paginate(30);

            return view('admin.pengajuan.judul.index', ['title' => 'pengajuan', 'pengajuanJudul' => $pengajuanJudul]);
        }
        abort(404);
    }

    public function terimaPengajuanJudul(Request $request, PengajuanJudul $pengajuanJudul)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            if ($request->input('action') == 'terima') {
                $dosen_pembimbing = $request->dosen_pembimbing;
                // $dosen_pembimbing2 = $request->dosen_pembimbing2;
                $user_dosen = User::where('nama', '=', $dosen_pembimbing)->first();

                // if ($dosen_pembimbing2) {
                //     if ($dosen_pembimbing == $dosen_pembimbing2) {
                //         return redirect('/admin/pengajuan/judul/' . $pengajuanJudul->id)->with('error', 'Pilihan dosen pembimbing 1 dan 2 tidak boleh sama');
                //     }

                //     $user_dosen2 = User::where('nama', '=', $dosen_pembimbing2)->first();

                //     $pengajuanJudul->update([
                //         'dosen_terpilih' => $dosen_pembimbing,
                //         'dosen_terpilih2' => $dosen_pembimbing2,
                //         'status' => 'Diterima'
                //     ]);

                //     Bimbingan::create([
                //         'dosen_id' => $user_dosen->id,
                //         'dosen2_id' => $user_dosen2->id,
                //         'mahasiswa_id' => $pengajuanJudul->user->id,
                //     ]);
                // } else {
                $pengajuanJudul->update([
                    // 'dosen_terpilih' => $dosen_pembimbing,
                    'status' => 'Diterima'
                ]);

                Bimbingan::create([
                    'dosen_id' => $user_dosen->id,
                    'mahasiswa_id' => $pengajuanJudul->user->id,
                ]);
                // }

                $pengajuanJudul->user->mahasiswa->update([
                    'status' => 'Bimbingan sempro'
                ]);
            }
            if ($request->input('action') == 'tolak') {
                $pengajuanJudul->update([
                    'status' => 'Ditolak'
                ]);
            }

            return redirect('/admin/pengajuan/judul');
        }
        abort(404);
    }

    public function getPengajuanJudul(PengajuanJudul $pengajuanJudul)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            $role = Role::get();
            $dosen_pembimbing = $role[4]->users;

            $dosen_pilihan = explode('-', $pengajuanJudul->dosen_pilihan);

            return view('admin.pengajuan.judul.detailPengajuan', ['title' => 'pengajuan', 'pengajuanJudul' => $pengajuanJudul, 'dosenPembimbing' => $dosen_pembimbing, 'dosen_pilihan' => $dosen_pilihan]);
        }
        abort(404);
    }

    //pengajuan sempro
    public function pengajuanSempro(Request $request)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            // $pengajuanSempro = PengajuanSempro::get();

            $query = PengajuanSempro::query()->where('status', '=', 'Menunggu pembagian jadwal');

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
            $data = $query->paginate(30);

            return view('admin.pengajuan.sempro.index', ['title' => 'pengajuan', 'data' => $data]);
        }
        abort(404);
    }

    public function getPengajuanSempro(PengajuanSempro $pengajuanSempro)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            $role_ketua = Role::with('users')->find(3);
            $role_penguji = Role::with('users')->find(4);
            return view('admin.pengajuan.sempro.detailPengajuan', ['title' => 'pengajuan', 'pengajuanSempro' => $pengajuanSempro, 'role_ketua' => $role_ketua, 'role_penguji' => $role_penguji]);
        }
        abort(404);
    }

    public function terimaPengajuanSempro(Request $request, PengajuanSempro $pengajuanSempro)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            if (isset($request->terima)) {
                $pembimbing1 = $pengajuanSempro->dospem_id;

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

                if (
                    $validator['penguji1_id'] == $pembimbing1 || $validator['penguji2_id'] == $pembimbing1 || $validator['penguji3_id'] == $pembimbing1

                ) {
                    return redirect('/admin/pengajuan/sempro/' . $pengajuanSempro->id)->with('error', 'Penguji tidak boleh sama dengan pembimbing.');
                }

                $tanggal = Carbon::createFromFormat('Y-m-d', $data['tanggal']);
                $validator['tanggal'] = $tanggal->translatedFormat('d F Y');

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
    public function pengajuanSkripsi(Request $request)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            $query = PengajuanSkripsi::query()->where('status', '=', 'Menunggu pembagian jadwal');

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
            $data = $query->paginate(30);

            return view('admin.pengajuan.skripsi.index', ['title' => 'pengajuan', 'data' => $data]);
        }
        abort(404);
    }
    public function getPengajuanSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            $role_ketua = Role::with('users')->find(3);
            $role_penguji = Role::with('users')->find(4);
            return view('admin.pengajuan.skripsi.detailPengajuan', ['title' => 'pengajuan', 'pengajuanSkripsi' => $pengajuanSkripsi, 'role_ketua' => $role_ketua, 'role_penguji' => $role_penguji]);
        }
        abort(404);
    }
    public function terimaPengajuanSkripsi(Request $request, PengajuanSkripsi $pengajuanSkripsi)
    {
        // dd($request->all());
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            if (isset($request->terima)) {
                $pembimbing1 = $pengajuanSkripsi->dospem_id;
                $pembimbing2 = $pengajuanSkripsi->dospem2_id;

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

                if (
                    $validator['penguji1_id'] == $pembimbing1 || $validator['penguji2_id'] == $pembimbing1 || $validator['penguji3_id'] == $pembimbing1
                    || $validator['penguji1_id'] == $pembimbing2 || $validator['penguji2_id'] == $pembimbing2 || $validator['penguji3_id'] == $pembimbing2
                ) {
                    return redirect('/admin/pengajuan/skripsi/' . $pengajuanSkripsi->id)->with('error', 'Penguji tidak boleh sama dengan pembimbing.');
                }

                $tanggal = Carbon::createFromFormat('Y-m-d', $data['tanggal']);
                $validator['tanggal'] = $tanggal->translatedFormat('d F Y');

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
    public function PengajuanAlat(Request $request)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            $query = PengajuanAlat::query()->where('status', '=', 'Menunggu persetujuan');

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
            $data = $query->paginate(30);

            return view('admin.pengajuan.alat.index', ['title' => 'pengajuan', 'data' => $data]);
        }
        abort(404);
    }

    public function getPengajuanAlat(PengajuanAlat $pengajuanAlat)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            return view('admin.pengajuan.alat.detail', ['title' => 'pengajuan', 'pengajuanAlat' => $pengajuanAlat]);
        }
        abort(404);
    }

    public function terimaPengajuanAlat(Request $request, PengajuanAlat $pengajuanAlat)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            if ($request->terima) {
                $pengajuanAlat->update(['status' => 'Diterima']);
                $pengajuanAlat->user->mahasiswa->update(['status' => 'Lulus']);

                return redirect('/admin/pengajuan/alat');
            } else {
                $data = $request->all();
                $rules = ['keterangan' => 'required'];
                $messages = ['required' => 'Keternagan tidak boleh kosong.'];
                $validated = Validator::make($data, $rules, $messages)->validate();

                $validated['status'] = 'Ditolak';
                $pengajuanAlat->update($validated);

                return redirect('/admin/pengajuan/alat');
            }
        }
        abort(404);
    }

    //pelaksanaan sidang
    public function getSempro(Request $request)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            $query = PengajuanSempro::query();

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
            if ($request->filled('cari_status')) {
                $cari_status = $request->input('cari_status');
                $query->where('status', 'like', '%' . $cari_status . '%');
            }

            $data = $query->paginate(30);

            return view('admin.sidang.sempro', ['title' => 'sidang', 'data' => $data]);
        }
        abort(404);
    }
    public function getSkripsi(Request $request)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            $query = PengajuanSkripsi::query();

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
            if ($request->filled('cari_status')) {
                $cari_status = $request->input('cari_status');
                $query->where('status', 'like', '%' . $cari_status . '%');
            }

            $data = $query->paginate(30);

            return view('admin.sidang.skripsi', ['title' => 'sidang', 'data' => $data]);
        }
        abort(404);
    }

    //revisi
    public function getAllRevisi(Request $request)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite'])) {
            // Query pertama untuk kondisi terima_pembimbing2 == null
            $query1 = PengajuanRevisi::query()->where('terima_penguji1', '!=', null)
                ->where('terima_penguji2', '!=', null)
                ->where('terima_penguji3', '!=', null)
                ->where('terima_pembimbing', '!=', null)
                ->where('terima_pembimbing2', '=', null)
                ->where('status', '!=', 'Diterima');

            $query2 = PengajuanRevisi::query()->where('terima_penguji1', '!=', null)
                ->where('terima_penguji2', '!=', null)
                ->where('terima_penguji3', '!=', null)
                ->where('terima_pembimbing', '!=', null)
                ->where('terima_pembimbing2', '!=', null)
                ->where('status', '!=', 'Diterima')
                ->whereHas('pengajuanSkripsi', function (Builder $query) {
                    $query->where('dospem2_id', '!=', null);
                });

            if ($request->filled('cari_nama')) {
                $cari_nama = $request->input('cari_nama');
                $query1->whereHas('pengajuanSkripsi.pengajuanSkripsiMahasiswa', function ($query) use ($cari_nama) {
                    $query->where('nama', 'like', '%' . $cari_nama . '%');
                });
                $query2->whereHas('pengajuanSkripsi.pengajuanSkripsiMahasiswa', function ($query) use ($cari_nama) {
                    $query->where('nama', 'like', '%' . $cari_nama . '%');
                });
            }
            if ($request->filled('cari_prodi')) {
                $cari_prodi = $request->input('cari_prodi');
                $query1->whereHas('pengajuanSkripsi.pengajuanSkripsiMahasiswa.mahasiswa', function ($query) use ($cari_prodi) {
                    $query->where('prodi', 'like', '%' . $cari_prodi . '%');
                });
                $query2->whereHas('pengajuanSkripsi.pengajuanSkripsiMahasiswa.mahasiswa', function ($query) use ($cari_prodi) {
                    $query->where('prodi', 'like', '%' . $cari_prodi . '%');
                });
            }

            $data1 = $query1->get();
            $data2 = $query2->get();
            $combined = $data1->merge($data2);

            $page = $request->input('page', 1);
            $perPage = 30;
            $offset = ($page - 1) * $perPage;
            $paginatedData = new LengthAwarePaginator(
                $combined->slice($offset, $perPage)->values(),
                $combined->count(),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );

            return view('admin.revisi.index', ['title' => 'revisi', 'data' => $paginatedData]);
        }
        abort(404);
    }

    public function getRevisi(PengajuanRevisi $pengajuanRevisi)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'komite', 'ketua_komite'])) {
            return view('admin.revisi.detail', ['title' => 'revisi', 'pengajuanRevisi' => $pengajuanRevisi]);
        }
        abort(404);
    }

    public function keputusanRevisi(Request $request, PengajuanRevisi $pengajuanRevisi)
    {
        if (Gate::forUser(Auth::user())->any(['admin', 'ketua_komite'])) {
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
                }
                if ($pengajuanRevisi->terima_penguji2 == 'Tidak') {
                    $pengajuanRevisi->update([
                        'terima_penguji2' => null,
                        'status' => 'Revisi'
                    ]);
                    $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Revisi']);
                }
                if ($pengajuanRevisi->terima_penguji3 == 'Tidak') {
                    $pengajuanRevisi->update([
                        'terima_penguji3' => null,
                        'status' => 'Revisi'
                    ]);
                    $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Revisi']);
                }
                if ($pengajuanRevisi->terima_pembimbing == 'Tidak') {
                    $pengajuanRevisi->update([
                        'terima_pembimbing' => null,
                        'status' => 'Revisi'
                    ]);
                    $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Revisi']);
                }
                if ($pengajuanRevisi->terima_pembimbing2 == 'Tidak') {
                    $pengajuanRevisi->update([
                        'terima_pembimbing2' => null,
                        'status' => 'Revisi'
                    ]);
                    $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Revisi']);
                }

                return redirect('/admin/revisi');
            } elseif (isset($request->terima)) {
                if (Auth::user()->dosen->tanda_tangan == null) {
                    return redirect('/admin/profile')->with('messages', 'Silahkan isi tanda tangan terlebih dahulu.');
                }

                $tanggal = Carbon::now()->translatedFormat('d F Y');
                $pengajuanRevisi->update([
                    'status' => 'Diterima',
                    'terima_ketua_komite' => Auth::user()->id,
                    'tanggal_revisi' => $tanggal,
                ]);
                $pengajuanRevisi->pengajuanSkripsi->update(['status' => 'Lulus']);
                $pengajuanRevisi->pengajuanSkripsi->pengajuanSkripsiMahasiswa->mahasiswa->update(['status' => 'Serah terima alat']);

                return redirect('/admin/revisi');
            }
        }
        abort(404);
    }
}
