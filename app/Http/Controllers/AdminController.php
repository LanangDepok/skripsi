<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Jabatan;
use App\Models\JabatanFungsional;
use App\Models\Kelas;
use App\Models\Konten;
use App\Models\Mahasiswa;
use App\Models\PangkatGolongan;
use App\Models\PengajuanAlat;
use App\Models\PengajuanJudul;
use App\Models\PengajuanRevisi;
use App\Models\PengajuanSempro;
use App\Models\PengajuanSkripsi;
use App\Models\ProgramStudi;
use App\Models\Role;
use App\Models\TahunAjaran;
use App\Models\User;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

            $this->adminService->updateKonten($timeline_skripsi, $alur_skripsi);

            return redirect('/');
        }
        abort(404);
    }

    //profile
    public function getProfile()
    {
        if (Gate::allows('komite')) {
            return view('admin.profile.index', ['title' => 'profile']);
        }
        abort(404);
    }

    public function updateProfile(Request $request, User $user)
    {
        if (Gate::allows('komite')) {
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

            $this->adminService->updateProfile($user, $validated);

            return back();
        }
        abort(404);
    }

    // mahasiswa
    public function getStudents(Request $request)
    {
        if (Gate::any(['admin', 'komite'])) {
            $tahun = TahunAjaran::get();
            $prodi = ProgramStudi::get();

            $query = Mahasiswa::query();

            if ($request->filled('cari_nama')) {
                $cari_nama = $request->input('cari_nama');
                $query->whereHas('user', function ($query) use ($cari_nama) {
                    $query->where('nama', 'like', '%' . $cari_nama . '%');
                });
            }

            if ($request->filled('cari_prodi')) {
                $cari_prodi = $request->input('cari_prodi');
                $query->where('prodi_id', $cari_prodi);
            }

            if ($request->filled('cari_status')) {
                $cari_status = $request->input('cari_status');
                $query->where('status', $cari_status);
            }

            if ($request->filled('cari_tahun')) {
                $cari_tahun = $request->input('cari_tahun');
                $query->where('tahun_ajaran_id', $cari_tahun);
            }

            $data = $query->latest()->paginate(30);

            return view('admin.mahasiswa.index', ['title' => 'mahasiswa', 'data' => $data, 'tahun' => $tahun, 'prodi' => $prodi]);
        }
        abort(404);
    }

    public function getStudent(Mahasiswa $mahasiswa)
    {
        if (Gate::any(['admin', 'komite'])) {
            $bimbingan = Bimbingan::where('mahasiswa_id', '=', $mahasiswa->user_id)->first();
            return view('admin.mahasiswa.detailMahasiswa', ['title' => 'mahasiswa', 'mahasiswa' => $mahasiswa, 'bimbingan' => $bimbingan]);
        }
        abort(404);
    }

    public function createStudent()
    {
        if (Gate::allows('admin')) {
            $kelas = Kelas::get();
            $prodi = ProgramStudi::get();
            $tahun = TahunAjaran::get();
            return view('admin.mahasiswa.createMahasiswa', [
                'title' => 'mahasiswa',
                'kelas' => $kelas,
                'prodi' => $prodi,
                'tahun' => $tahun,
            ]);
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
                'nim' => 'required|regex:/^\d+$/|unique:mahasiswas,nim',
                'kelas_id' => 'required',
                'prodi_id' => 'required',
                'tahun_ajaran_id' => 'required',
                'status' => 'required'
            ];
            $messages = [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute sudah tersedia.',
                'email' => ':attribute tidak valid.',
                'regex' => ':attribute harus berupa angka.'
            ];
            $validator = Validator::make($data, $rules, $messages);
            $validated_user = $validator->safe()->only(['email', 'password', 'nama']);
            $validated_mahasiswa = $validator->safe()->only(['nim', 'kelas_id', 'prodi_id', 'tahun_ajaran_id', 'status']);

            $this->adminService->storeStudent($validated_user, $validated_mahasiswa, $user, $mahasiswa);

            return redirect()->route('adm.createStudent')->with('success', 'Data berhasil ditambahkan.');
        }
        abort(404);
    }

    public function storeStudentExcel(Request $request)
    {
        if (Gate::allows('admin')) {
            ini_set('max_execution_time', 300);
            $kelasCheck = Kelas::pluck('id')->toArray();
            $prodiCheck = ProgramStudi::pluck('id')->toArray();
            $tahunAjaranCheck = TahunAjaran::pluck('id')->toArray();
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
                        $kelas_id = $worksheet->getCell('E' . $row)->getValue();
                        $prodi_id = $worksheet->getCell('F' . $row)->getValue();
                        $tahunAjaran_id = $worksheet->getCell('G' . $row)->getValue();
                        if (!in_array($kelas_id, $kelasCheck)) {
                            DB::rollBack();
                            return redirect()->route('adm.createStudent')->with('error', 'ID Kelas pada baris ' . $row . ' tidak tersedia di database.');
                        }
                        if (!in_array($prodi_id, $prodiCheck)) {
                            DB::rollBack();
                            return redirect()->route('adm.createStudent')->with('error', 'ID Prodi pada baris ' . $row . ' tidak tersedia di database.');
                        }
                        if (!in_array($tahunAjaran_id, $tahunAjaranCheck)) {
                            DB::rollBack();
                            return redirect()->route('adm.createStudent')->with('error', 'ID Tahun Ajaran pada baris ' . $row . ' tidak tersedia di database.');
                        }
                        $data = [
                            'email' => $email,
                            'password' => $password,
                            'nama' => $nama,
                            'nim' => $nim,
                            'kelas_id' => $kelas_id,
                            'prodi_id' => $prodi_id,
                            'tahun_ajaran_id' => $tahunAjaran_id,
                        ];
                        $rules = [
                            'email' => 'required|email|unique:users,email',
                            'password' => 'required',
                            'nama' => 'required',
                            'nim' => 'required|integer|unique:mahasiswas,nim',
                            'kelas_id' => 'required',
                            'prodi_id' => 'required',
                            'tahun_ajaran_id' => 'required',
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
                            return redirect()->route('adm.createStudent')->with('error', $errorMessage);
                        }
                        $user = new User;
                        $user->email = $email;
                        $user->password = $password;
                        $user->nama = $nama;
                        $user->save();
                        $user->roles()->sync([6]);
                        $mahasiswa = new Mahasiswa;
                        $mahasiswa->nim = $nim;
                        $mahasiswa->kelas_id = $kelas_id;
                        $mahasiswa->prodi_id = $prodi_id;
                        $mahasiswa->tahun_ajaran_id = $tahunAjaran_id;
                        $mahasiswa->status = 'Belum mengajukan judul';
                        $mahasiswa->user_id = $user->id;
                        $mahasiswa->save();
                    }
                }
                DB::commit();
                return redirect()->route('adm.createStudent')->with('success', 'Data berhasil ditambahkan.');

            } else {
                return redirect()->route('adm.createStudent')->with('error', 'Pastikan sudah memasukkan file yang benar');
            }
        }
        abort(404);
    }

    public function editStudent(Mahasiswa $mahasiswa)
    {
        if (Gate::allows('admin')) {
            $kelas = Kelas::get();
            $prodi = ProgramStudi::get();
            $tahun = TahunAjaran::get();
            return view('admin.mahasiswa.editMahasiswa', [
                'title' => 'mahasiswa',
                'mahasiswa' => $mahasiswa,
                'kelas' => $kelas,
                'prodi' => $prodi,
                'tahun' => $tahun,
            ]);
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
                'nim' => ['required', 'regex:/^\d+$/', Rule::unique('mahasiswas', 'nim')->ignore($mahasiswa)],
                'kelas_id' => 'required',
                'prodi_id' => 'required',
                'tahun_ajaran_id' => 'required',
            ];
            $messages = [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute sudah tersedia.',
                'email' => ':attribute tidak valid.',
                'regex' => ':attribute harus berupa angka.'
            ];

            if ($request->password) {
                $rules['password'] = 'required';
                $validator = Validator::make($data, $rules, $messages);
                $validated_user = $validator->safe()->only(['email', 'password', 'nama']);
            } else {
                $validator = Validator::make($data, $rules, $messages);
                $validated_user = $validator->safe()->only(['email', 'nama']);
            }

            $validated_mahasiswa = $validator->safe()->only(['nim', 'kelas_id', 'prodi_id', 'tahun_ajaran_id']);

            $this->adminService->updateStudent($validated_user, $validated_mahasiswa, $user, $mahasiswa);

            return redirect()->route('adm.getStudents')->with('success', 'Data berhasil diubah.');
        }
        abort(404);
    }

    public function deleteStudent(Mahasiswa $mahasiswa)
    {
        if (Gate::allows('admin')) {
            if ($mahasiswa->user->pengajuanAlat->isNotEmpty()) {
                return redirect()->route('adm.getStudents')->with('error', 'Tidak dapat menghapus data mahasiswa yang sudah melakukan pengajuan.');
            }
            $mahasiswa->delete();
            $mahasiswa->user->roles()->detach();
            $mahasiswa->user->delete();

            return redirect()->route('adm.getStudents')->with('success', 'Data berhasil dihapus.');
        }
        abort(404);
    }

    // dosen
    public function getLecturers(Request $request)
    {
        if (Gate::any(['admin', 'komite'])) {
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

            $data = $query->latest()->paginate(30);

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
            $jabatan = Jabatan::get();
            $fungsional = JabatanFungsional::get();
            $golongan = PangkatGolongan::get();
            return view('admin.dosen.createDosen', [
                'title' => 'dosen',
                'jabatan' => $jabatan,
                'fungsional' => $fungsional,
                'golongan' => $golongan,
            ]);
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
                'nip' => 'required|regex:/^\d+$/|unique:dosens,nip',
                'jabatan_id' => 'required',
                'fungsional_id' => 'required',
                'gol_pangkat_id' => 'required',
                'role' => 'required',
            ];
            $messages = [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute sudah tersedia.',
                'email' => ':attribute tidak valid.',
                'regex' => ':attribute harus berupa angka.'
            ];

            $validator = Validator::make($data, $rules, $messages);
            $validated_user = $validator->safe()->only(['email', 'password', 'nama']);
            $validated_dosen = $validator->safe()->only(['nip', 'jabatan_id', 'fungsional_id', 'gol_pangkat_id']);
            $validated_role = $validator->safe()->only(['role']);

            $this->adminService->storeLecturer($validated_user, $validated_dosen, $validated_role, $user, $dosen);

            return redirect()->route('adm.createLecturer')->with('success', 'Data berhasil ditambahkan.');
        }
        abort(404);
    }

    public function editLecturer(Dosen $dosen)
    {
        if (Gate::allows('admin')) {
            $jabatan = Jabatan::get();
            $fungsional = JabatanFungsional::get();
            $golongan = PangkatGolongan::get();
            return view('admin.dosen.editDosen', [
                'title' => 'dosen',
                'dosen' => $dosen,
                'jabatan' => $jabatan,
                'fungsional' => $fungsional,
                'golongan' => $golongan,
            ]);
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
                'nip' => ['required', 'regex:/^\d+$/', Rule::unique('dosens', 'nip')->ignore($dosen)],
                'jabatan_id' => 'required',
                'fungsional_id' => 'required',
                'gol_pangkat_id' => 'required',
                'role' => 'required',
            ];
            $messages = [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute sudah tersedia.',
                'email' => ':attribute tidak valid.',
                'regex' => ':attribute harus berupa angka.'
            ];

            if ($request->password) {
                $rules['password'] = 'required';
                $validator = Validator::make($data, $rules, $messages);
                $validated_user = $validator->safe()->only(['email', 'password', 'nama']);
            } else {
                $validator = Validator::make($data, $rules, $messages);
                $validated_user = $validator->safe()->only(['email', 'nama']);
            }

            $validated_dosen = $validator->safe()->only(['nip', 'jabatan_id', 'fungsional_id', 'gol_pangkat_id']);
            $validated_role = $validator->safe()->only(['role']);

            if (in_array(7, $validated_role['role'])) {
                $KetuaKomiteCheck = DB::table('role_user')->where('role_id', 7)->exists();
                if ($KetuaKomiteCheck) {
                    return redirect()->route('adm.editLecturer', ['dosen' => $dosen->id])->with(['error' => 'Role Ketua Komite sudah dimiliki oleh dosen lain.']);
                }
            }


            $this->adminService->updateLecturer($validated_user, $validated_dosen, $validated_role, $dosen);

            return redirect()->route('adm.getLecturers')->with('success', 'Data berhasil diubah.');
        }
        abort(404);
    }

    public function deleteLecturer(Dosen $dosen)
    {
        if (Gate::allows('admin')) {
            if ($dosen->user->bimbinganDosen->isNotEmpty()) {
                return redirect()->route('adm.getLecturers')->with('error', 'Tidak dapat menghapus data mahasiswa yang sudah memiliki mahasiswa bimbingan.');
            } elseif ($dosen->user->bimbinganDosen2->isNotEmpty()) {
                return redirect()->route('adm.getLecturers')->with('error', 'Tidak dapat menghapus data mahasiswa yang sudah memiliki mahasiswa bimbingan.');
            } elseif ($dosen->user->pengajuanSemproPenguji1->isNotEmpty()) {
                return redirect()->route('adm.getLecturers')->with('error', 'Tidak dapat menghapus data mahasiswa yang sudah memiliki mahasiswa teruji.');
            } elseif ($dosen->user->pengajuanSemproPenguji2->isNotEmpty()) {
                return redirect()->route('adm.getLecturers')->with('error', 'Tidak dapat menghapus data mahasiswa yang sudah memiliki mahasiswa teruji.');
            } elseif ($dosen->user->pengajuanSemproPenguji3->isNotEmpty()) {
                return redirect()->route('adm.getLecturers')->with('error', 'Tidak dapat menghapus data mahasiswa yang sudah memiliki mahasiswa teruji.');
            } elseif ($dosen->user->pengajuanSkripsiPenguji1->isNotEmpty()) {
                return redirect()->route('adm.getLecturers')->with('error', 'Tidak dapat menghapus data mahasiswa yang sudah memiliki mahasiswa teruji.');
            } elseif ($dosen->user->pengajuanSkripsiPenguji2->isNotEmpty()) {
                return redirect()->route('adm.getLecturers')->with('error', 'Tidak dapat menghapus data mahasiswa yang sudah memiliki mahasiswa teruji.');
            } elseif ($dosen->user->pengajuanSkripsiPenguji3->isNotEmpty()) {
                return redirect()->route('adm.getLecturers')->with('error', 'Tidak dapat menghapus data mahasiswa yang sudah memiliki mahasiswa teruji.');
            }

            $dosen->delete();
            $dosen->user->roles()->detach();
            $dosen->user->delete();

            return redirect()->route('adm.getLecturers')->with('success', 'Data berhasil dihapus.');
        }
        abort(404);
    }

    //pengajuan judul
    public function pengajuanJudul(Request $request)
    {
        if (Gate::any(['admin', 'komite'])) {
            $prodi = ProgramStudi::get();
            $tahun = TahunAjaran::get();

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
                    $query->where('prodi_id', $cari_prodi);
                });
            }
            if ($request->filled('cari_tahun')) {
                $cari_tahun = $request->input('cari_tahun');
                $query->whereHas('user.mahasiswa', function ($query) use ($cari_tahun) {
                    $query->where('tahun_ajaran_id', $cari_tahun);
                });
            }
            $pengajuanJudul = $query->latest()->paginate(30);

            return view('admin.pengajuan.judul.index', [
                'title' => 'pengajuan',
                'pengajuanJudul' => $pengajuanJudul,
                'prodi' => $prodi,
                'tahun' => $tahun
            ]);
        }
        abort(404);
    }

    public function terimaPengajuanJudul(Request $request, PengajuanJudul $pengajuanJudul)
    {
        if (Gate::any(['admin', 'komite'])) {
            if ($request->input('action') == 'terima') {
                $dosen_pembimbing = $request->dosen_pembimbing;
                $user_dosen = User::where('nama', '=', $dosen_pembimbing)->first();

                $pengajuanJudul->update([
                    'status' => 'Diterima'
                ]);

                Bimbingan::create([
                    'dosen_id' => $user_dosen->id,
                    'mahasiswa_id' => $pengajuanJudul->user->id,
                ]);

                $pengajuanJudul->user->mahasiswa->update([
                    'status' => 'Bimbingan sempro'
                ]);
            }
            if ($request->input('action') == 'tolak') {
                $pengajuanJudul->update([
                    'status' => 'Ditolak'
                ]);
            }

            return redirect()->route('adm.pengajuanJudul');
        }
        abort(404);
    }

    public function getPengajuanJudul(PengajuanJudul $pengajuanJudul)
    {
        if (Gate::any(['admin', 'komite'])) {
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
        if (Gate::any(['admin', 'komite'])) {
            $prodi = ProgramStudi::get();
            $tahun = TahunAjaran::get();

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
                    $query->where('prodi_id', $cari_prodi);
                });
            }
            if ($request->filled('cari_tahun')) {
                $cari_tahun = $request->input('cari_tahun');
                $query->whereHas('pengajuanSemproMahasiswa.mahasiswa', function ($query) use ($cari_tahun) {
                    $query->where('tahun_ajaran_id', $cari_tahun);
                });
            }
            $data = $query->latest()->paginate(30);

            return view(
                'admin.pengajuan.sempro.index',
                [
                    'title' => 'pengajuan',
                    'data' => $data,
                    'prodi' => $prodi,
                    'tahun' => $tahun
                ]
            );
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
                $validated = Validator::make($data, $rules, $messages)->validate();

                if (
                    $validated['penguji1_id'] == $pembimbing1 || $validated['penguji2_id'] == $pembimbing1 || $validated['penguji3_id'] == $pembimbing1

                ) {
                    return redirect()->route('adm.getPengajuanSempro', ['pengajuanSempro' => $pengajuanSempro->id])->with('error', 'Penguji tidak boleh sama dengan pembimbing.');
                }

                $this->adminService->terimaPengajuanSempro($pengajuanSempro, $validated);
            } else {
                $pengajuanSempro->update(['status' => 'Ditolak']);
            }
            return redirect()->route('adm.pengajuanSempro');
        }
        abort(404);
    }

    //pengajuan skripsi
    public function pengajuanSkripsi(Request $request)
    {
        if (Gate::any(['admin', 'komite'])) {
            $prodi = ProgramStudi::get();
            $tahun = TahunAjaran::get();

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
                    $query->where('prodi_id', $cari_prodi);
                });
            }
            if ($request->filled('cari_tahun')) {
                $cari_tahun = $request->input('cari_tahun');
                $query->whereHas('pengajuanSkripsiMahasiswa.mahasiswa', function ($query) use ($cari_tahun) {
                    $query->where('tahun_ajaran_id', $cari_tahun);
                });
            }
            $data = $query->latest()->paginate(30);

            return view('admin.pengajuan.skripsi.index', [
                'title' => 'pengajuan',
                'data' => $data,
                'prodi' => $prodi,
                'tahun' => $tahun
            ]);
        }
        abort(404);
    }
    public function getPengajuanSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::any(['admin', 'komite'])) {
            $role_ketua = Role::with('users')->find(3);
            $role_penguji = Role::with('users')->find(4);
            $penguji_sebelumnya = PengajuanSempro::where('mahasiswa_id', '=', $pengajuanSkripsi->mahasiswa_id)->latest()->first();
            return view('admin.pengajuan.skripsi.detailPengajuan', [
                'title' => 'pengajuan',
                'pengajuanSkripsi' => $pengajuanSkripsi,
                'role_ketua' => $role_ketua,
                'role_penguji' => $role_penguji,
                'penguji_sebelumnya' => $penguji_sebelumnya
            ]);
        }
        abort(404);
    }
    public function terimaPengajuanSkripsi(Request $request, PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::any(['admin', 'komite'])) {
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
                $validated = Validator::make($data, $rules, $messages)->validate();

                if (
                    $validated['penguji1_id'] == $pembimbing1 || $validated['penguji2_id'] == $pembimbing1 || $validated['penguji3_id'] == $pembimbing1
                    || $validated['penguji1_id'] == $pembimbing2 || $validated['penguji2_id'] == $pembimbing2 || $validated['penguji3_id'] == $pembimbing2
                ) {
                    return redirect()->route('adm.getPengajuanSkripsi', ['pengajuanSkripsi' => $pengajuanSkripsi->id])->with('error', 'Penguji tidak boleh sama dengan pembimbing.');
                }

                $this->adminService->terimaPengajuanSkripsi($pengajuanSkripsi, $validated);
            } else {
                $pengajuanSkripsi->update(['status' => 'Ditolak']);
            }
            return redirect()->route('adm.pengajuanSkripsi');
        }
        abort(404);
    }

    //pengajuan alat
    public function PengajuanAlat(Request $request)
    {
        if (Gate::any(['admin', 'komite'])) {
            $prodi = ProgramStudi::get();
            $tahun = TahunAjaran::get();

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
                    $query->where('prodi_id', $cari_prodi);
                });
            }
            if ($request->filled('cari_tahun')) {
                $cari_tahun = $request->input('cari_tahun');
                $query->whereHas('pengajuanSkripsiMahasiswa.mahasiswa', function ($query) use ($cari_tahun) {
                    $query->where('tahun_ajaran_id', $cari_tahun);
                });
            }
            $data = $query->latest()->paginate(30);

            return view('admin.pengajuan.alat.index', [
                'title' => 'pengajuan',
                'data' => $data,
                'prodi' => $prodi,
                'tahun' => $tahun
            ]);
        }
        abort(404);
    }

    public function getPengajuanAlat(PengajuanAlat $pengajuanAlat)
    {
        if (Gate::any(['admin', 'komite'])) {
            return view('admin.pengajuan.alat.detail', ['title' => 'pengajuan', 'pengajuanAlat' => $pengajuanAlat]);
        }
        abort(404);
    }

    public function terimaPengajuanAlat(Request $request, PengajuanAlat $pengajuanAlat)
    {
        if (Gate::any(['admin', 'komite'])) {
            if ($request->terima) {
                $this->adminService->terimaPengajuanAlat($pengajuanAlat);
            } else {
                $data = $request->all();
                $rules = ['keterangan' => 'required'];
                $messages = ['required' => 'Keterangan tidak boleh kosong.'];
                $validated = Validator::make($data, $rules, $messages)->validate();

                $this->adminService->tolakPengajuanAlat($pengajuanAlat, $validated);
            }
            return redirect()->route('adm.pengajuanAlat');
        }
        abort(404);
    }

    //monitoring pengajuan
    public function getAllSempro(Request $request)
    {
        if (Gate::any(['admin', 'komite'])) {
            $prodi = ProgramStudi::get();
            $tahun = TahunAjaran::get();
            $latestPengajuanSemproIds = DB::table('pengajuan_sempros')
                ->select(DB::raw('MAX(id) as id'))
                ->groupBy('mahasiswa_id');

            $query = PengajuanSempro::whereIn('id', $latestPengajuanSemproIds);

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
            if ($request->filled('cari_status')) {
                $cari_status = $request->input('cari_status');
                $query->where('status', 'like', '%' . $cari_status . '%');
            }
            if ($request->filled('cari_tahun')) {
                $cari_tahun = $request->input('cari_tahun');
                $query->whereHas('pengajuanSemproMahasiswa.mahasiswa', function ($query) use ($cari_tahun) {
                    $query->where('tahun_ajaran_id', $cari_tahun);
                });
            }

            $data = $query->latest()->paginate(30);

            return view('admin.sidang.sempro', [
                'title' => 'sidang',
                'data' => $data,
                'prodi' => $prodi,
                'tahun' => $tahun
            ]);
        }
        abort(404);
    }
    public function getSempro(PengajuanSempro $pengajuanSempro)
    {
        if (Gate::any(['admin', 'komite'])) {
            return view('admin.sidang.detailSempro', ['title' => 'sidang', 'pengajuanSempro' => $pengajuanSempro]);
        }
        abort(404);
    }
    public function getAllSkripsi(Request $request)
    {
        if (Gate::any(['admin', 'komite'])) {
            $prodi = ProgramStudi::get();
            $tahun = TahunAjaran::get();

            $latestPengajuanSkripsiIds = DB::table('pengajuan_skripsis')
                ->select(DB::raw('MAX(id) as id'))
                ->groupBy('mahasiswa_id');

            $query = PengajuanSkripsi::whereIn('id', $latestPengajuanSkripsiIds);

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
            if ($request->filled('cari_status')) {
                $cari_status = $request->input('cari_status');
                $query->where('status', $cari_status);
            }
            if ($request->filled('cari_tahun')) {
                $cari_tahun = $request->input('cari_tahun');
                $query->whereHas('pengajuanSkripsiMahasiswa.mahasiswa', function ($query) use ($cari_tahun) {
                    $query->where('tahun_ajaran_id', $cari_tahun);
                });
            }

            $data = $query->latest()->paginate(30);

            return view('admin.sidang.skripsi', [
                'title' => 'sidang',
                'data' => $data,
                'prodi' => $prodi,
                'tahun' => $tahun
            ]);
        }
        abort(404);
    }
    public function getSkripsi(PengajuanSkripsi $pengajuanSkripsi)
    {
        if (Gate::any(['admin', 'komite'])) {
            return view('admin.sidang.detailSkripsi', ['title' => 'sidang', 'pengajuanSkripsi' => $pengajuanSkripsi]);
        }
        abort(404);
    }
    public function getAllAlat(Request $request)
    {
        if (Gate::any(['admin', 'komite'])) {
            $prodi = ProgramStudi::get();
            $tahun = TahunAjaran::get();

            $latestPengajuanAlatIds = DB::table('pengajuan_skripsis')
                ->select(DB::raw('MAX(id) as id'))
                ->groupBy('mahasiswa_id');

            $query = PengajuanAlat::whereIn('id', $latestPengajuanAlatIds);

            if ($request->filled('cari_nama')) {
                $cari_nama = $request->input('cari_nama');
                $query->whereHas('user', function ($query) use ($cari_nama) {
                    $query->where('nama', 'like', '%' . $cari_nama . '%');
                });
            }
            if ($request->filled('cari_prodi')) {
                $cari_prodi = $request->input('cari_prodi');
                $query->whereHas('user.mahasiswa', function ($query) use ($cari_prodi) {
                    $query->where('prodi_id', $cari_prodi);
                });
            }
            if ($request->filled('cari_status')) {
                $cari_status = $request->input('cari_status');
                $query->where('status', $cari_status);
            }
            if ($request->filled('cari_tahun')) {
                $cari_tahun = $request->input('cari_tahun');
                $query->whereHas('user.mahasiswa', function ($query) use ($cari_tahun) {
                    $query->where('tahun_ajaran_id', $cari_tahun);
                });
            }

            $data = $query->latest()->paginate(30);

            return view('admin.sidang.alat', [
                'title' => 'sidang',
                'data' => $data,
                'prodi' => $prodi,
                'tahun' => $tahun
            ]);
        }
        abort(404);
    }
    public function getAlat(PengajuanAlat $pengajuanAlat)
    {
        if (Gate::any(['admin', 'komite'])) {
            return view('admin.sidang.detailAlat', ['title' => 'sidang', 'pengajuanAlat' => $pengajuanAlat]);
        }
        abort(404);
    }

    //revisi
    public function getAllRevisi(Request $request)
    {
        if (Gate::any(['admin', 'komite'])) {
            if (Gate::allows('komite') && Auth::user()->dosen->tanda_tangan == null) {
                return redirect()->route('adm.getProfile')->with('messages', 'Silahkan isi tanda tangan terlebih dahulu.');
            }
            $prodi = ProgramStudi::get();
            $tahun = TahunAjaran::get();
            $query = PengajuanRevisi::query()
                ->where('terima_penguji1', '!=', null)
                ->where('terima_penguji2', '!=', null)
                ->where('terima_penguji3', '!=', null)
                ->where('terima_pembimbing', '!=', null)
                ->where('status', '!=', 'Diterima');

            $query->whereHas('pengajuanSkripsi', function ($query) {
                $query->where(function ($query) {
                    $query->whereNull('dospem2_id')
                        ->orWhere(function ($query) {
                            $query->whereNotNull('dospem2_id')
                                ->where('terima_pembimbing2', '!=', null);
                        });
                });
            });

            if ($request->filled('cari_nama')) {
                $cari_nama = $request->input('cari_nama');
                $query->whereHas('pengajuanSkripsi.pengajuanSkripsiMahasiswa', function ($query) use ($cari_nama) {
                    $query->where('nama', 'like', '%' . $cari_nama . '%');
                });
            }
            if ($request->filled('cari_prodi')) {
                $cari_prodi = $request->input('cari_prodi');
                $query->whereHas('pengajuanSkripsi.pengajuanSkripsiMahasiswa.mahasiswa', function ($query) use ($cari_prodi) {
                    $query->where('prodi_id', $cari_prodi);
                });
            }
            if ($request->filled('cari_tahun')) {
                $cari_tahun = $request->input('cari_tahun');
                $query->whereHas('pengajuanSkripsi.pengajuanSkripsiMahasiswa.mahasiswa', function ($query) use ($cari_tahun) {
                    $query->where('tahun_ajaran_id', $cari_tahun);
                });
            }
            $data = $query->latest()->paginate(30);

            return view('admin.revisi.index', [
                'title' => 'revisi',
                'data' => $data,
                'prodi' => $prodi,
                'tahun' => $tahun
            ]);
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
                $this->adminService->keputusanRevisiTolak($pengajuanRevisi);
            } elseif (isset($request->revisi)) {
                $this->adminService->keputusanRevisiUlang($pengajuanRevisi);
            } elseif (isset($request->terima)) {
                if (Auth::user()->dosen->tanda_tangan == null) {
                    return redirect()->route('adm.getProfile')->with('messages', 'Silahkan isi tanda tangan terlebih dahulu.');
                }
                $this->adminService->keputusanRevisiTerima($pengajuanRevisi);
            }

            return redirect()->route('adm.getAllRevisi');
        }
        abort(404);
    }

    //database
    public function getAllTahunAjaran()
    {
        if (Gate::allows('admin')) {
            $data = TahunAjaran::get();
            return view('admin.database.tahunAjaran.index', ['title' => 'database', 'data' => $data]);
        }
        abort(404);
    }
    public function createTahunAjaran()
    {
        if (Gate::allows('admin')) {
            return view('admin.database.tahunAjaran.create', ['title' => 'database']);
        }
        abort(404);
    }
    public function storeTahunAjaran(Request $request)
    {
        if (Gate::allows('admin')) {
            $data = $request->all();
            $rules = ['nama' => 'required|unique:tahun_ajarans,nama'];
            $messages = [
                'required' => 'Silahkan isi data terlebih dahulu.',
                'unique' => 'Data sudah ada sebelumnya.'
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            TahunAjaran::create($validated);
            return redirect('admin/database/tahun')->with('success', 'Berhasil menambahkan tahun ajaran.');
        }
        abort(404);
    }
    public function editTahunAjaran(TahunAjaran $tahunAjaran)
    {
        if (Gate::allows('admin')) {
            return view('admin.database.tahunAjaran.edit', ['title' => 'database', 'data' => $tahunAjaran]);
        }
        abort(404);
    }
    public function updateTahunAjaran(Request $request, TahunAjaran $tahunAjaran)
    {
        if (Gate::allows('admin')) {
            $data = $request->all();
            $rules = ['nama' => 'required|unique:tahun_ajarans,nama'];
            $messages = [
                'required' => 'Silahkan isi data terlebih dahulu.',
                'unique' => 'Data sudah ada sebelumnya.'
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            $tahunAjaran->update($validated);
            return redirect('admin/database/tahun')->with('success', 'Berhasil mengubah tahun ajaran.');
        }
        abort(404);
    }

    public function getAllKelas()
    {
        if (Gate::allows('admin')) {
            $data = Kelas::get();
            return view('admin.database.kelas.index', ['title' => 'database', 'data' => $data]);
        }
        abort(404);
    }
    public function createKelas()
    {
        if (Gate::allows('admin')) {
            return view('admin.database.kelas.create', ['title' => 'database']);
        }
        abort(404);
    }
    public function storeKelas(Request $request)
    {
        if (Gate::allows('admin')) {
            $data = $request->all();
            $rules = ['nama' => 'required|unique:kelas,nama'];
            $messages = [
                'required' => 'Silahkan isi data terlebih dahulu.',
                'unique' => 'Data sudah ada sebelumnya.'
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            Kelas::create($validated);
            return redirect('admin/database/kelas')->with('success', 'Berhasil menambahkan kelas.');
        }
        abort(404);
    }
    public function editKelas(Kelas $kelas)
    {
        if (Gate::allows('admin')) {
            return view('admin.database.kelas.edit', ['title' => 'database', 'data' => $kelas]);
        }
        abort(404);
    }
    public function updateKelas(Request $request, Kelas $kelas)
    {
        if (Gate::allows('admin')) {
            $data = $request->all();
            $rules = ['nama' => 'required|unique:kelas,nama'];
            $messages = [
                'required' => 'Silahkan isi data terlebih dahulu.',
                'unique' => 'Data sudah ada sebelumnya.'
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            $kelas->update($validated);
            return redirect('admin/database/kelas')->with('success', 'Berhasil mengubah kelas.');
        }
        abort(404);
    }

    public function getAllProgramStudi()
    {
        if (Gate::allows('admin')) {
            $data = ProgramStudi::get();
            return view('admin.database.prodi.index', ['title' => 'database', 'data' => $data]);
        }
        abort(404);
    }
    public function createProgramStudi()
    {
        if (Gate::allows('admin')) {
            return view('admin.database.prodi.create', ['title' => 'database']);
        }
        abort(404);
    }
    public function storeProgramStudi(Request $request)
    {
        if (Gate::allows('admin')) {
            $data = $request->all();
            $rules = ['nama' => 'required|unique:program_studis,nama'];
            $messages = [
                'required' => 'Silahkan isi data terlebih dahulu.',
                'unique' => 'Data sudah ada sebelumnya.'
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            ProgramStudi::create($validated);
            return redirect('admin/database/prodi')->with('success', 'Berhasil menambahkan prodi.');
        }
        abort(404);
    }
    public function editProgramStudi(ProgramStudi $programStudi)
    {
        if (Gate::allows('admin')) {
            return view('admin.database.prodi.edit', ['title' => 'database', 'data' => $programStudi]);
        }
        abort(404);
    }
    public function updateProgramStudi(Request $request, ProgramStudi $programStudi)
    {
        if (Gate::allows('admin')) {
            $data = $request->all();
            $rules = ['nama' => 'required|unique:program_studis,nama'];
            $messages = [
                'required' => 'Silahkan isi data terlebih dahulu.',
                'unique' => 'Data sudah ada sebelumnya.'
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            $programStudi->update($validated);
            return redirect('admin/database/prodi')->with('success', 'Berhasil mengubah prodi.');
        }
        abort(404);
    }

    public function getAllJabatan()
    {
        if (Gate::allows('admin')) {
            $data = Jabatan::get();
            return view('admin.database.jabatan.index', ['title' => 'database', 'data' => $data]);
        }
        abort(404);
    }
    public function createJabatan()
    {
        if (Gate::allows('admin')) {
            return view('admin.database.jabatan.create', ['title' => 'database']);
        }
        abort(404);
    }
    public function storeJabatan(Request $request)
    {
        if (Gate::allows('admin')) {
            $data = $request->all();
            $rules = ['nama' => 'required|unique:jabatans,nama'];
            $messages = [
                'required' => 'Silahkan isi data terlebih dahulu.',
                'unique' => 'Data sudah ada sebelumnya.'
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            Jabatan::create($validated);
            return redirect('admin/database/jabatan')->with('success', 'Berhasil menambahkan jabatan.');
        }
        abort(404);
    }
    public function editJabatan(Jabatan $jabatan)
    {
        if (Gate::allows('admin')) {
            return view('admin.database.jabatan.edit', ['title' => 'database', 'data' => $jabatan]);
        }
        abort(404);
    }
    public function updateJabatan(Request $request, Jabatan $jabatan)
    {
        if (Gate::allows('admin')) {
            $data = $request->all();
            $rules = ['nama' => 'required|unique:jabatans,nama'];
            $messages = [
                'required' => 'Silahkan isi data terlebih dahulu.',
                'unique' => 'Data sudah ada sebelumnya.'
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            $jabatan->update($validated);
            return redirect('admin/database/jabatan')->with('success', 'Berhasil mengubah jabatan.');
        }
        abort(404);
    }

    public function getAllJabatanFungsional()
    {
        if (Gate::allows('admin')) {
            $data = JabatanFungsional::get();
            return view('admin.database.fungsional.index', ['title' => 'database', 'data' => $data]);
        }
        abort(404);
    }
    public function createJabatanFungsional()
    {
        if (Gate::allows('admin')) {
            return view('admin.database.fungsional.create', ['title' => 'database']);
        }
        abort(404);
    }
    public function storeJabatanFungsional(Request $request)
    {
        if (Gate::allows('admin')) {
            $data = $request->all();
            $rules = ['nama' => 'required|unique:jabatan_fungsionals,nama'];
            $messages = [
                'required' => 'Silahkan isi data terlebih dahulu.',
                'unique' => 'Data sudah ada sebelumnya.'
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            JabatanFungsional::create($validated);
            return redirect('admin/database/fungsional')->with('success', 'Berhasil menambahkan jabatan fungsional.');
        }
        abort(404);
    }
    public function editJabatanFungsional(JabatanFungsional $jabatanFungsional)
    {
        if (Gate::allows('admin')) {
            return view('admin.database.fungsional.edit', ['title' => 'database', 'data' => $jabatanFungsional]);
        }
        abort(404);
    }
    public function updateJabatanFungsional(Request $request, JabatanFungsional $jabatanFungsional)
    {
        if (Gate::allows('admin')) {
            $data = $request->all();
            $rules = ['nama' => 'required|unique:jabatan_fungsionals,nama'];
            $messages = [
                'required' => 'Silahkan isi data terlebih dahulu.',
                'unique' => 'Data sudah ada sebelumnya.'
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            $jabatanFungsional->update($validated);
            return redirect('admin/database/fungsional')->with('success', 'Berhasil mengubah jabatan fungsional.');
        }
        abort(404);
    }

    public function getAllPangkatGolongan()
    {
        if (Gate::allows('admin')) {
            $data = PangkatGolongan::get();
            return view('admin.database.golongan.index', ['title' => 'database', 'data' => $data]);
        }
        abort(404);
    }
    public function createPangkatGolongan()
    {
        if (Gate::allows('admin')) {
            return view('admin.database.golongan.create', ['title' => 'database']);
        }
        abort(404);
    }
    public function storePangkatGolongan(Request $request)
    {
        if (Gate::allows('admin')) {
            $data = $request->all();
            $rules = ['nama' => 'required|unique:pangkat_golongans,nama'];
            $messages = [
                'required' => 'Silahkan isi data terlebih dahulu.',
                'unique' => 'Data sudah ada sebelumnya.'
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            PangkatGolongan::create($validated);
            return redirect('admin/database/golongan')->with('success', 'Berhasil menambahkan jabatan golongan.');
        }
        abort(404);
    }
    public function editPangkatGolongan(PangkatGolongan $pangkatGolongan, )
    {
        if (Gate::allows('admin')) {
            return view('admin.database.golongan.edit', ['title' => 'database', 'data' => $pangkatGolongan]);
        }
        abort(404);
    }
    public function updatePangkatGolongan(Request $request, PangkatGolongan $pangkatGolongan)
    {
        if (Gate::allows('admin')) {
            $data = $request->all();
            $rules = ['nama' => 'required|unique:pangkat_golongans,nama'];
            $messages = [
                'required' => 'Silahkan isi data terlebih dahulu.',
                'unique' => 'Data sudah ada sebelumnya.'
            ];
            $validated = Validator::make($data, $rules, $messages)->validate();

            $pangkatGolongan->update($validated);
            return redirect('admin/database/golongan')->with('success', 'Berhasil mengubah jabatan pangkat golongan.');
        }
        abort(404);
    }

    //report akhir
    public function reportAkhir()
    {
        if (Gate::any(['admin', 'komite'])) {
            $data = Mahasiswa::latest()->paginate(30);

            return view('admin.report.index', ['title' => 'report', 'data' => $data]);
        }
        abort(404);
    }
    public function exportReport()
    {
        if (Gate::any(['admin', 'komite'])) {
            $data = Mahasiswa::with(['user', 'kelas', 'prodi', 'tahun', 'user.pengajuanJudul', 'user.pengajuanSemproMahasiswa', 'user.pengajuanSkripsiMahasiswa', 'user.pengajuanAlat'])->get();

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set header
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'Nama Mahasiswa');
            $sheet->setCellValue('C1', 'NIM');
            $sheet->setCellValue('D1', 'Prodi');
            $sheet->setCellValue('E1', 'Kelas');
            $sheet->setCellValue('F1', 'Judul Skripsi');
            $sheet->setCellValue('G1', 'Sub Judul Skripsi');
            $sheet->setCellValue('H1', 'Tanggal Sidang/Lulus Sidang');
            $sheet->setCellValue('I1', 'Nama Dosen Pembimbing 1');
            $sheet->setCellValue('J1', 'Nama Dosen Pembimbing 2');
            $sheet->setCellValue('K1', 'Nama Dosen Penguji 1');
            $sheet->setCellValue('L1', 'Nama Dosen Penguji 2');
            $sheet->setCellValue('M1', 'Nama Dosen Penguji 3');
            $sheet->setCellValue('N1', 'Keterangan Revisi Alat');
            $sheet->setCellValue('O1', 'Keterangan Revisi Laporan');
            $sheet->setCellValue('P1', 'Tanggal Selesai Revisi');
            $sheet->setCellValue('Q1', 'Nilai Kelulusan Skripsi');
            $sheet->setCellValue('R1', 'Nilai Mutu Skripsi');
            $sheet->setCellValue('S1', 'No HP');
            $sheet->setCellValue('T1', 'Email');
            $sheet->setCellValue('U1', 'Sertifikat Lomba');
            $sheet->setCellValue('V1', 'Sertifikat TOEIC');
            $sheet->setCellValue('W1', 'Sertifikat Prestasi');
            $sheet->setCellValue('X1', 'Sertifikat PKKP');

            // Fill data
            $row = 2;
            foreach ($data as $index => $mhsw) {
                $sheet->setCellValue('A' . $row, $index + 1);
                $sheet->setCellValue('B' . $row, $mhsw->user->nama);
                $sheet->setCellValue('C' . $row, $mhsw->nim);
                $sheet->setCellValue('D' . $row, $mhsw->prodi->nama);
                $sheet->setCellValue('E' . $row, $mhsw->kelas->nama);
                $sheet->setCellValue('F' . $row, $mhsw->user->skripsi ? $mhsw->user->skripsi->judul : '-');
                $sheet->setCellValue('G' . $row, $mhsw->user->skripsi ? $mhsw->user->skripsi->sub_judul : '-');
                $sheet->setCellValue('H' . $row, $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->tanggal : '-');
                $sheet->setCellValue('I' . $row, $mhsw->user->bimbinganMahasiswa ? $mhsw->user->bimbinganMahasiswa->bimbinganDosen->nama : '-');
                $sheet->setCellValue('J' . $row, $mhsw->user->bimbinganMahasiswa ? ($mhsw->user->bimbinganMahasiswa->dosen2_id ? $mhsw->user->bimbinganMahasiswa->bimbinganDosen2->nama : '-') : '-');
                $sheet->setCellValue('K' . $row, $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanSkripsiPenguji1->nama : '-');
                $sheet->setCellValue('L' . $row, $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanSkripsiPenguji2->nama : '-');
                $sheet->setCellValue('M' . $row, $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanSkripsiPenguji3->nama : '-');
                $sheet->setCellValue('N' . $row, $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? ($mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanRevisi ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanRevisi->revisi_alat : 'Lulus tanpa revisi') : '-');
                $sheet->setCellValue('O' . $row, $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? ($mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanRevisi ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanRevisi->revisi_laporan : 'Lulus tanpa revisi') : '-');
                $sheet->setCellValue('P' . $row, $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? ($mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanRevisi ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->pengajuanRevisi->tanggal_revisi : 'Lulus tanpa revisi') : '-');
                $sheet->setCellValue('Q' . $row, $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->nilai_total : '-');
                $sheet->setCellValue('R' . $row, $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? $mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->nilai_mutu : '-');
                $sheet->setCellValue('S' . $row, $mhsw->no_kontak);
                $sheet->setCellValue('T' . $row, $mhsw->user->email);
                $sheet->setCellValue('U' . $row, $mhsw->user->pengajuanSkripsiMahasiswa->count() > 0 ? ($mhsw->user->pengajuanSkripsiMahasiswa->sortByDesc('created_at')->first()->status == 'Lulus' ? 'Lengkap' : '-') : '-');
                $sheet->setCellValue('V' . $row, $mhsw->user->pengajuanAlat->count() > 0 ? ($mhsw->user->pengajuanAlat->sortByDesc('created_at')->first()->status == 'Diterima' ? 'Lengkap' : '-') : '-');
                $sheet->setCellValue('W' . $row, $mhsw->user->pengajuanAlat->count() > 0 ? ($mhsw->user->pengajuanAlat->sortByDesc('created_at')->first()->status == 'Diterima' ? 'Lengkap' : '-') : '-');
                $sheet->setCellValue('X' . $row, $mhsw->user->pengajuanAlat->count() > 0 ? ($mhsw->user->pengajuanAlat->sortByDesc('created_at')->first()->status == 'Diterima' ? 'Lengkap' : '-') : '-');
                $row++;
            }

            $writer = new Xlsx($spreadsheet);
            $fileName = 'Report Akhir.xlsx';
            $temp_file = tempnam(sys_get_temp_dir(), $fileName);
            $writer->save($temp_file);

            return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
        }
        abort(404);
    }
}
